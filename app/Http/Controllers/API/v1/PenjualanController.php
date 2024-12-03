<?php

namespace App\Http\Controllers\API\v1;

use App\Models\Barang;
use App\Models\Pemesanan;
use App\Models\Penjualan;
use App\Contracts\APIInterface;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use App\Http\Resources\PemesananResource;
use App\Http\Resources\PenjualanResource;
use App\Http\Resources\PemesananEditResource;
use App\Http\Resources\PemesananShowResource;
use Symfony\Component\HttpFoundation\Response;

class PenjualanController extends Controller implements APIInterface
{
    public function show(int $id): JsonResponse
    {
        $pemesanan = new PenjualanResource(Penjualan::findOrFail($id));

        return response()->json([
            'code' => Response::HTTP_OK,
            'data' => $pemesanan
        ]);
    }

    public function edit(int $id): JsonResponse
    {
        $pemesanan = new PenjualanResource(Penjualan::findOrFail($id));

        return response()->json([
            'code' => Response::HTTP_OK,
            'data' => $pemesanan
        ]);
    }
}
