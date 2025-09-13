<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class RajaOngkirController extends Controller
{
    public function getProvinces()
    {
        //Mengambil data dari API Raja Ongkir
        $response = Http::withHeaders([
            'Accept' => 'application/json',
            'key' => config('rajaongkir.api_key'),

        ])->get('https://rajaongkir.komerce.id/api/v1/destination/province');

        return response()->json([
            'success' => true,
            'message' => "List Data Province",
            'data' => $response->json()['data'] ?? []
        ]);
    }

    public function getCities($provinceId)
    {
        //Mengambil data dari API Raja Ongkir
        $response = Http::withHeaders([
            'Accept' => 'application/json',
            'key' => config('rajaongkir.api_key'),

        ])->get("https://rajaongkir.komerce.id/api/v1/destination/city/{$provinceId}");

        return response()->json([
            'success' => true,
            'message' => "List Data Cities",
            'data' => $response->json()['data'] ?? []
        ]);
    }

    public function getDistricts($cityId)
    {
        //Mengambil data dari API Raja Ongkir
        $response = Http::withHeaders([
            'Accept' => 'application/json',
            'key' => config('rajaongkir.api_key'),

        ])->get("https://rajaongkir.komerce.id/api/v1/destination/district/{$cityId}");

        return response()->json([
            'success' => true,
            'message' => "List Data Districts",
            'data' => $response->json()['data'] ?? []
        ]);
    }

    public function checkOngkir(Request $request)
    {
        $response = Http::asForm()->withHeaders([
            'Accept' => 'application/json',
            'key' => config('rajaongkir.api_key'),

        ])->post("https://rajaongkir.komerce.id/api/v1/calculate/district/domestic-cost", [
            'origin' => 2609, //Banguntapan
            'destination' => $request->district_id,
            'weight' => $request->weight,
            'courier' => $request->courier,
        ]);

        return response()->json([
            'success' => true,
            'message' => "List Ongkir",
            'data' => $response->json()['data'] ?? []
        ]);
    }
}
