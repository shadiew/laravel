<?php

namespace App\Http\Controllers;

use App\Models\Provider;
use App\Models\Service;
use App\Models\ServiceCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $breadcrumbs = [
            ['link' => "/dashboard", 'name' => "Dashboard"], ['link' => "/service/list", 'name' => "Layanan"], ['name' => "Daftar Layanan"]
        ];

        if (Auth::user()->role == 'Admin') {
            $services = Service::with('category')->get();
        } else {
            $services = Service::where('active', true)->with('category')->get();
        }
        return view('/content/service/list', [
            'breadcrumbs' => $breadcrumbs,
            'services' => $services
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
            ['link' => "/dashboard", 'name' => "Dashboard"]
        ];

        $providers = Provider::where('active', true)->get();

        return view('/content/service/grab', [
            'breadcrumbs' => $breadcrumbs,
            'providers' => $providers
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
        $providerId = $request->provider;
        $provider = Provider::where('id', $providerId)->first();
        $postData = [
            'key' => $provider->api_key,
            'action' => 'services'
        ];
        $markup = $request->markup;
        $convert = $request->convert;
        $price = 0;
        $response = Http::post($provider->link, $postData);
        $responseJSON = $response->json();
        // print_r($responseJSON);
        // die();

        // Service::query()->update(['active' => false]);

        foreach ($responseJSON as $key => $value) {
            if (isset($markup) && isset($convert)) {
                $price = (($value["rate"] * ($markup / 100)) + $value["rate"]) * $convert;
            } else if (isset($markup)) {
                $price = ($value["rate"] * ($markup / 100)) + $value["rate"];
            } else if (isset($convert)) {
                $price = $value["rate"] * $convert;
            } else {
                $price = $value["rate"];
            }

            $category = ServiceCategory::firstOrCreate(
                [
                    'name' => $value["category"],
                    'provider_id' => $providerId,
                    'active' => true
                ]
            );


            if ($value["type"] == "Default" || $value["type"] == "Package") {
                $active = true;
            } else {
                $active = false;
            }



            $service = Service::firstOrCreate(
                [
                    'provider_service_id' => $value["service"],
                    'name' => $value["name"],
                    'type' => $value["type"],
                    'category_id' => $category->id,
                    'provider_service_price' => $value["rate"],
                    'price' => $price,
                    'min' => $value["min"],
                    'max' => $value["max"],
                    'refill' => $value["refill"],
                    'dripfeed' => $value["dripfeed"],
                    'provider_id' => $providerId,
                    'active' => $active
                ]
            );
        }

        return redirect('/service/list');
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

    /**
     * List Services Per Category
     *
     * *@param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function servicePerCategoy(Request $request, $id)
    {
        $query = $request->query();
        $term = $request->query('term');
        $column = "name";
        $services = Service::where('category_id', $id)
            ->where('active', true)
            ->whereRaw("LOWER({$column}) LIKE '%" . strtolower($term) . "%'")
            ->get();

        $selectData = [];
        foreach ($services as $value) {
            if ($value->type == 'Package') {
                $text = $value->name . ' - Rp ' . number_format($value->price, 0, ',', '.') . ' / paket';
            } else {
                $text = $value->name . ' - Rp ' . number_format($value->price, 0, ',', '.') . ' / 1000';
            }

            array_push($selectData, ['id' => $value->id, 'text' => $text]);
        }
        return response()->json([
            'services' => $services,
            'selectData' => $selectData
        ]);
    }
}
