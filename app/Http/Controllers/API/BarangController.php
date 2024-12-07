<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\API\BaseController;
use App\Models\Barang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BarangController extends BaseController
{
    public function index()
    {
        $barang = Barang::paginate(10);
        return $this->sendResponse($barang, 'Data Barang retrieved successfully');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'supplier_id' => 'required|exists:suppliers,id',
            'nama' => 'required',
            'kode' => 'required|unique:barangs',
            'stok' => 'required|integer',
            'harga' => 'required|numeric',
        ]);

        if ($validator->fails()) {
            return $this->sendValidationError($validator);
        }

        $barang = Barang::create($request->all());
        return $this->sendResponse($barang, 'Barang created successfully', 201);
    }

    public function show($id)
    {
        $barang = Barang::find($id);

        if (is_null($barang)) {
            return $this->sendError('Barang not found', 404);
        }

        return $this->sendResponse($barang, 'Barang retrieved successfully');
    }

    public function update(Request $request, $id)
    {
        $barang = Barang::find($id);

        if (is_null($barang)) {
            return $this->sendError('Barang not found', 404);
        }

        $validator = Validator::make($request->all(), [
            'supplier_id' => 'sometimes|exists:suppliers,id',
            'nama' => 'sometimes',
            'kode' => 'sometimes|unique:barangs',
            'stok' => 'sometimes|integer',
            'harga' => 'sometimes|numeric',
        ]);

        if ($validator->fails()) {
            return $this->sendValidationError($validator);
        }

        $barang->update($validator->validated());
        return $this->sendResponse($barang, 'Barang updated successfully');
    }

    public function destroy($id)
    {
        $barang = Barang::find($id);

        if (is_null($barang)) {
            return $this->sendError('Barang not found', 404);
        }

        $barang->delete();
        return $this->sendResponse(null, 'Barang deleted successfully');
    }

    public function getHarga($id)
    {
        $barang = Barang::findOrFail($id);
        return response()->json(['harga' => $barang->harga]);
    }
}
