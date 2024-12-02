<?php

namespace App\Http\Controllers\API\v1;

use App\Contracts\APIInterface;
use App\Http\Controllers\Controller;
use App\Http\Resources\SupplierEditResource;
use App\Http\Resources\SupplierShowResource;
use App\Models\Supplier;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class SupplierController extends Controller implements APIInterface
{
    public function show(int $id): JsonResponse
    {
        $supplier = new SupplierShowResource(Supplier::findOrFail($id));

        return response()->json([
            'code' => Response::HTTP_OK,
            'data' => $supplier
        ]);
    }

    public function edit(int $id): JsonResponse
    {
        $supplier = new SupplierEditResource(Supplier::findOrFail($id));

        return response()->json([
            'code' => Response::HTTP_OK,
            'data' => $supplier
        ]);
    }
}
