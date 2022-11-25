<?php

namespace App\Http\Controllers;

use App\Models\Deposit;
use App\Models\PaymentMethod;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class DepositController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $breadcrumbs = [
            ['link' => "/dashboard", 'name' => "Dashboard"], ['link' => "/deposit/history", 'name' => "Deposit"], ['name' => "Riwayat Deposit"]
        ];

        if (Auth::user()->role == 'Admin') {
            $deposits = Deposit::with('payment')->with('user')->orderByDesc('id')->get();
        } else {
            $deposits = Deposit::with('payment')->where('created_by', Auth::user()->id)->orderByDesc('id')->get();
        }

        return view('/content/deposit/history', [
            'breadcrumbs' => $breadcrumbs,
            'deposits' => $deposits
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $paymentMethods = PaymentMethod::where('active', 1)->where('gateway', 'TRIPAY')->get();
        $breadcrumbs = [
            ['link' => "/dashboard", 'name' => "Dashboard"], ['link' => "/deposit/add", 'name' => "Deposit"], ['name' => "Tambah Deposit"]
        ];

        return view('/content/deposit/add', [
            'breadcrumbs' => $breadcrumbs,
            'paymentMethods' => $paymentMethods
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'amount' => 'required',
            'method' => 'required',
        ], [
            'amount.required' => 'Anda wajib isi jumlah deposit!',
            // 'amount.min' => 'Minimal Deposit adalah Rp. 10.000',
            'method.required' => 'Anda wajib pilih metode pembayaran!',
        ]);

        // 1. Create Signature
        $privateKey = env('TRIPAY_PRIVATE_KEY');
        $merchantCode = env('TRIPAY_MERCHANT_CODE');
        $apiKey = env('TRIPAY_API_KEY');
        $apiUrl = env('TRIPAY_API_URL');
        $baseUrl = env('APP_URL');
        $amount =  (int)str_replace('.', '', $request->amount);
        $method = $request->method;
        $user = Auth::user();
        $depositId = Deposit::latest('id')->first() != null ? Deposit::latest('id')->first()->id + 1 : 1;
        $invoiceCode = 'DEPO' . '-' . $depositId . date("ymd"); //DPO-9210313
        $paymentMethod = PaymentMethod::where('code', $method)->first();

        $signature = hash_hmac('sha256', $merchantCode . $invoiceCode . $amount, $privateKey);

        // 2. Collect The Data
        $postData = [
            'method'            => $method,
            'merchant_ref'      => $invoiceCode,
            'amount'            => $amount,
            'customer_name'     => $user->name,
            'customer_email'    => $user->email,
            'customer_phone'    => $user->phone,
            'order_items'       => [
                [
                    'sku'       => 'Deposit',
                    'name'      => 'Deposit Rp. ' . ($amount),
                    'price'     => $amount,
                    'quantity'  => 1
                ]
            ],
            'callback_url'      => $baseUrl . '/payment/callback',
            'return_url'        => $baseUrl . '/deposit/history',
            'expired_time'      => (time() + (24 * 60 * 60)), // 24 jam
            'signature'         => $signature
        ];


        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $apiKey,
        ])->post($apiUrl . '/transaction/create', $postData);
        $responseJSON = $response->json();

        // 3.Insert Database and Response

        $deposit = Deposit::insertGetId([
            'payment_method_id' => $paymentMethod->id,
            'status' => 'PENDING',
            'amount' => $amount,
            'invoice_code' => $invoiceCode,
            'created_by' => $user->id,
            'created_at' => now(),
        ]);

        if ($responseJSON["success"] == true) {
            isset($responseJSON["data"]["qr_string"]) ? $qrString = $responseJSON["data"]["qr_string"] : $qrString = null;
            isset($responseJSON["data"]["qr_url"]) ? $qrUrl = $responseJSON["data"]["qr_url"] : $qrUrl = null;

            Deposit::where('id', $deposit)
                ->update([
                    'gateway_reference' => $responseJSON["data"]["reference"],
                    'checkout_url' => $responseJSON["data"]["checkout_url"],
                    'instructions' => $responseJSON["data"]["instructions"],
                    'status' => $responseJSON["data"]["status"],
                    'qr_string' => $qrString,
                    'qr_url' => $qrUrl,
                    'expired_time' => $responseJSON["data"]["expired_time"],
                    'pay_code' => $responseJSON["data"]["pay_code"],
                    'status' => $responseJSON["data"]["status"],
                ]);

            Log::channel('deposit')->info('Response: ' . $response);

            return redirect($responseJSON["data"]["checkout_url"]);
        } else {
            Deposit::where('id', $deposit)
                ->update([
                    'status' => 'ERROR',
                ]);

            Log::channel('deposit')->error('Response' . $response);

            return redirect('/deposit/history');
        }

        //     array:3 [▼
        //     "success" => true
        //     "message" => ""
        //     "data" => array:23 [▼
        //       "reference" => "DEV-T28209045VD5WR"
        //       "merchant_ref" => "DEPO-1210402"
        //       "payment_selection_type" => "static"
        //       "payment_method" => "QRIS"
        //       "payment_name" => "QRIS"
        //       "customer_name" => "admin"
        //       "customer_email" => "admin@admin.com"
        //       "customer_phone" => "08512345678900"
        //       "callback_url" => "http://localhost/tripay/callback.php"
        //       "return_url" => "http://localhost/tripay/redirect.php"
        //       "amount" => 101450
        //       "fee" => 1450
        //       "is_customer_fee" => 1
        //       "amount_received" => 100000
        //       "pay_code" => "103742218961047"
        //       "pay_url" => null
        //       "checkout_url" => "https://payment.tripay.co.id/checkout/DEV-T28209045VD5WR"
        //       "status" => "UNPAID"
        //       "expired_time" => 1617414608
        //       "order_items" => array:1 [▼
        //         0 => array:5 [▼
        //           "sku" => "Deposit"
        //           "name" => "Deposit Rp. 100000"
        //           "price" => 100000
        //           "quantity" => 1
        //           "subtotal" => 100000
        //         ]
        //       ]
        //       "instructions" => array:1 [▼
        //         0 => array:2 [▼
        //           "title" => "Pembayaran via QRIS"
        //           "steps" => array:5 [▶]
        //         ]
        //       ]
        //       "qr_string" => "SANDBOX MODE"
        //       "qr_url" => "https://payment.tripay.co.id/qr/DEV-T28209045VD5WR"
        //     ]
        //   ]

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function callback(Request $request)
    {
        $privateKey = env('TRIPAY_PRIVATE_KEY');
        // ambil callback signature
        $callbackSignature = $request->server('HTTP_X_CALLBACK_SIGNATURE') ?? '';

        // ambil data JSON
        $json = $request->getContent();

        // generate signature untuk dicocokkan dengan X-Callback-Signature
        $signature = hash_hmac('sha256', $json, $privateKey);

        // validasi signature
        if ($callbackSignature !== $signature) {
            return "Invalid Signature"; // signature tidak valid, hentikan proses
        }

        $data = json_decode($json);
        $event = $request->server('HTTP_X_CALLBACK_EVENT');

        if ($event == 'payment_status') {
            if ($data->status == 'PAID') {
                $merchantRef = $data->merchant_ref;

                // pembayaran sukses, lanjutkan proses sesuai sistem Anda, contoh:
                $deposit = Deposit::where('invoice_code', $merchantRef)->first();

                if (!$deposit) {
                    return "Deposit not found";
                }

                $deposit->update([
                    'status'    => 'SUCCESS'
                ]);

                // UPDATE BALANCE
                $user = User::where('id', $deposit->created_by)->first();
                $newBalance = $user->balance + $deposit->amount;
                $user->update([
                    'balance' => $newBalance
                ]);

                return response()->json([
                    'success' => true
                ]);
            }
        }

        return "No action was taken";
    }
}
