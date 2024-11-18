<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\API\BaseController;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SupplierController extends BaseController
{
    public function index()
    {
        $suppliers = Supplier::all();
        return $this->sendResponse($suppliers, 'Data Supplier retrieved successfully');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama' => 'required',
            'alamat' => 'required',
            'telepon' => 'required',
        ]);

        if ($validator->fails()) {
            return $this->sendValidationError($validator);
        }

        $supplier = Supplier::create($request->all());
        return $this->sendResponse($supplier, 'Supplier created successfully', 201);
    }

    public function show($id)
    {
        $supplier = Supplier::find($id);

        if (is_null($supplier)) {
            return $this->sendError('Supplier not found', 404);
        }

        return $this->sendResponse($supplier, 'Supplier retrieved successfully');
    }

    public function update(Request $request, $id)
    {
        $supplier = Supplier::find($id);

        $validator = Validator::make($request->all(), [
            'nama' => 'sometimes',
            'alamat' => 'sometimes',
            'telepon' => 'sometimes',
        ]);

        if ($validator->fails()) {
            return $this->sendValidationError($validator);
        }

        $supplier->update($validator->validated());
        return $this->sendResponse($supplier, 'Supplier updated successfully');
    }

    public function destroy($id)
    {
        $supplier = Supplier::find($id);

        if (is_null($supplier)) {
            return $this->sendError('Supplier not found', 404);
        }

        $supplier->delete();
        return $this->sendResponse(null, 'Supplier deleted successfully');
    }
}
