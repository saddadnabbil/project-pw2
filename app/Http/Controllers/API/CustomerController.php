<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\API\BaseController;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CustomerController extends BaseController
{
    public function index()
    {
        $customers = Customer::all();
        return $this->sendResponse($customers, 'Data Customers retrieved successfully');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama' => 'required',
            'email' => 'required|email|unique:customers',
            'alamat' => 'required',
            'telepon' => 'required',
        ]);

        if ($validator->fails()) {
            return $this->sendValidationError($validator);
        }

        $customer = Customer::create($request->all());
        return $this->sendResponse($customer, 'Customer created successfully', 201);
    }

    public function show($id)
    {
        $customer = Customer::find($id);

        if (is_null($customer)) {
            return $this->sendError('Customer not found', 404);
        }

        return $this->sendResponse($customer, 'Customer retrieved successfully');
    }

    public function update(Request $request, $id)
    {
        $customer = Customer::find($id);

        if (is_null($customer)) {
            return $this->sendError('Customer not found', 404);
        }

        $validator = Validator::make($request->all(), [
            'nama' => 'sometimes',
            'email' => 'sometimes|email|unique:customers',
            'alamat' => 'sometimes',
            'telepon' => 'sometimes',
        ]);

        if ($validator->fails()) {
            return $this->sendValidationError($validator);
        }

        $customer->update($validator->validated());
        return $this->sendResponse($customer, 'Customer updated successfully');
    }

    public function destroy($id)
    {
        $customer = Customer::find($id);

        if (is_null($customer)) {
            return $this->sendError('Customer not found', 404);
        }

        $customer->delete();
        return $this->sendResponse(null, 'Customer deleted successfully');
    }
}
