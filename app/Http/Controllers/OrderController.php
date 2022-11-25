<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Provider;
use App\Models\Service;
use App\Models\ServiceCategory;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redirect;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $breadcrumbs = [
            ['link' => "/dashboard", 'name' => "Dashboard"], ['link' => "/order/history", 'name' => "Pesanan"], ['name' => "Riwayat Pesanan"]
        ];

        if (Auth::user()->role == 'Admin') {
            $orders = Order::orderByDesc('id')->with('service')->with('user')->get();
        } else {
            $orders = Order::orderByDesc('id')->where('created_by', Auth::user()->id)->with('service')->get();
        }

        return view('/content/order/history', [
            'breadcrumbs' => $breadcrumbs,
            'orders' => $orders
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $breadcrumbs = [
            ['link' => "/dashboard", 'name' => "Dashboard"], ['link' => "/order/new", 'name' => "Pesanan"], ['name' => "Pesanan Baru"]
        ];

        $services = Service::where('active', true)->get();
        $serviceCategories = ServiceCategory::where('active', true)->get();
        $baseUrl = env('APP_URL');
        return view('/content/order/new', [
            'breadcrumbs' => $breadcrumbs,
            'services' => $services,
            'serviceCategories' => $serviceCategories,
            'baseUrl' => $baseUrl
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
        $serviceId = $request->service;
        $quantity = $request->quantity;
        $link = $request->target;
        $price = $request->price;
        $serviceId = $request->service;



        if (Auth::user()->balance < $price) {
            return redirect()->back()->withErrors(['Maaf saldo anda tidak mencukupi. Silakan topup di menu deposit!']);
        }

        $user = Auth::user();
        $newId = Order::latest('id')->first() != null ? Order::latest('id')->first()->id + 1 : 1;
        $orderCode = 'INV' . '-' . $newId . date("ymd"); //DPO-9210313
        $service = Service::where('id', $serviceId)->first();
        $provider = Provider::where('id', $service->provider_id)->first();
        $providerServicePrice = ($service->provider_service_price / 1000) * $quantity;

        // INSERT DB
        $orderId = Order::insertGetId([
            'order_code' => $orderCode,
            'service_id' => $serviceId,
            'quantity' => $quantity,
            'link' => $link,
            'price' => $price,
            'provider_service_price' => $providerServicePrice,
            'status' => 'Pending',
            'created_by' => $user->id,
        ]);

        // SEND ORDER TO PROVIDER
        $postData = [
            'key' => $provider->api_key,
            'action' => 'add',
            'service' => $service->provider_service_id,
            'link' => $link,
            'quantity' => $quantity
        ];
        $response = Http::withHeaders([
            // 'Authorization' => 'Bearer ' . $apiKey,
        ])->post($provider->link, $postData);
        $responseJSON = $response->json();

        if (isset($responseJSON["error"])) {
            Log::channel('order')->error('Order ID: ' . $orderId . ' : Response' . $response);
            return Redirect::back()->withErrors(['Maaf ada masalah dengan sistem', 'Silakan kontak admin di tokofollowerdotcom@gmail.com']);
        }

        $providerOrderId = $responseJSON["order"];

        if (isset($providerOrderId)) { //SUCCESS AND GET ORDER ID
            $updateOrder = Order::where('id', $orderId)->first();
            $updateOrder->update([
                'provider_order_id' => $providerOrderId,
                'note' => $responseJSON
            ]);

            // UPDATE BALANCE
            $userUpdate = User::where('id', $user->id)->first();
            $newBalance = $user->balance - $price;
            $userUpdate->update([
                'balance' => $newBalance
            ]);

            Log::channel('order')->info('Response: ' . $response);
            return redirect('/order/history');
        } else { //ERROR
            $updateOrder = Order::where('id', $orderId)->first();
            $updateOrder->update([
                'status' => 'Error',
                'note' => $responseJSON
            ]);

            Log::channel('order')->error('Response' . $response);

            return Redirect::back()->withErrors(['Layanan ini sedang dalam perawatan server, silakan coba kembali nanti atau pilih layanan yang lain. 
            <br>Tenang saja saldo kamu tidak terpotong.<br>Terima kasih.']);
        }
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
}
