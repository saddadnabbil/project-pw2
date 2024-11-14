<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\API\BaseController;
use App\Models\Pemesanan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PemesananController extends BaseController
{
    public function index()
    {
        $pemesanans = Pemesanan::all();
        return $this->sendResponse($pemesanans, 'Data Pemesanan retrieved successfully');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'customer_id' => 'required|exists:customers,id',
            'barang_id' => 'required|exists:barangs,id',
            'jumlah' => 'required|integer',
            'tanggal_pemesanan' => 'required|date',
        ]);

        if ($validator->fails()) {
            return $this->sendValidationError($validator);
        }

        $pemesanan = Pemesanan::create($request->all());
        return $this->sendResponse($pemesanan, 'Pemesanan created successfully', 201);
    }

    public function show($id)
    {
        $pemesanan = Pemesanan::find($id);

        if (is_null($pemesanan)) {
            return $this->sendError('Pemesanan not found', 404);
        }

        return $this->sendResponse($pemesanan, 'Pemesanan retrieved successfully');
    }

    public function update(Request $request, $id)
    {
        $pemesanan = Pemesanan::find($id);

        if (is_null($pemesanan)) {
            return $this->sendError('Pemesanan not found', 404);
        }

        $validator = Validator::make($request->all(), [
            'customer_id' => 'required|exists:customers,id',
            'barang_id' => 'required|exists:barangs,id',
            'jumlah' => 'required|integer',
            'tanggal_pemesanan' => 'required|date',
        ]);

        if ($validator->fails()) {
            return $this->sendValidationError($validator);
        }

        $pemesanan->update($request->all());

        return $this->sendResponse($pemesanan, 'Pemesanan updated successfully');
    }


    public function destroy($id)
    {
        $pemesanan = Pemesanan::find($id);

        if (is_null($pemesanan)) {
            return $this->sendError('Pemesanan not found', 404);
        }

        $pemesanan->delete();
        return $this->sendResponse(null, 'Pemesanan deleted successfully');
    }
}
