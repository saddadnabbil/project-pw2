<?php

// app/Http/Controllers/API/v1/CustomerController.php

namespace App\Http\Controllers\API\v1;

use App\Models\Customer;
use App\Http\Controllers\Controller;
use App\Http\Resources\CustomerResource;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Http\JsonResponse;

class CustomerController extends Controller
{
    /**
     * Show the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(int $id): JsonResponse
    {
        $customer = new CustomerResource(Customer::findOrFail($id));

        return response()->json([
            'code' => Response::HTTP_OK,
            'data' => $customer
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function edit(int $id): JsonResponse
    {
        $customer = new CustomerResource(Customer::findOrFail($id));

        return response()->json([
            'code' => Response::HTTP_OK,
            'data' => $customer
        ]);
    }
}
