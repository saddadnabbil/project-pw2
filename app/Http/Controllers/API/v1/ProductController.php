<?php

namespace App\Http\Controllers\API\v1;

use App\Models\Barang;
use App\Contracts\APIInterface;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use App\Http\Resources\ProductEditResource;
use App\Http\Resources\ProductShowResource;
use Symfony\Component\HttpFoundation\Response;

class ProductController extends Controller implements APIInterface
{
    public function show(int $id): JsonResponse
    {
        $product = new ProductShowResource(Barang::findOrFail($id));

        return response()->json([
            'code' => Response::HTTP_OK,
            'data' => $product
        ]);
    }

    public function edit(int $id): JsonResponse
    {
        $product = new ProductEditResource(Barang::findOrFail($id));

        return response()->json([
            'code' => Response::HTTP_OK,
            'data' => $product
        ]);
    }
}
