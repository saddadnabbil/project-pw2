<?php

namespace App\Http\Controllers;

use App\Http\Requests\PenjualanStoreRequest;
use App\Http\Requests\PenjualanUpdateRequest;
use App\Models\Barang;
use App\Models\Customer;
use App\Models\Pemesanan;
use App\Models\Penjualan;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;

class PenjualanController extends Controller
{
    /**
     * Display a listing of the sales.
     *
     * @return \Illuminate\View\View|\Illuminate\Http\JsonResponse
     */
    public function index(): View|JsonResponse
    {
        $penjualans = Penjualan::select('id', 'barang_id', 'customer_id', 'jumlah', 'harga_satuan', 'total_harga', 'tanggal_jual', 'status_pembayaran')->get();
        $penjualanTrashedCount = Penjualan::onlyTrashed()->count();
        $barangs = Barang::all();
        $customers = Customer::all();

        if (request()->ajax()) {
            return datatables()->of($penjualans)
                ->addIndexColumn()
                ->addColumn('customer_name', function ($penjualans) {
                    return $penjualans->customer ? $penjualans->customer->nama : 'No customer';
                })
                ->addColumn('barang_name', function ($penjualans) {
                    return $penjualans->barang ? $penjualans->barang->nama : 'No Pemesanan';
                })
                ->addColumn('status_pembayaran', function ($penjualans) {
                    $status = $penjualans->status_pembayaran;

                    if ($status == 'paid') {
                        return '<span class="badge bg-success">Paid</span>';
                    } else {
                        return '<span class="badge bg-danger">Unpaid</span>';
                    }
                })
                ->addColumn('harga_satuan', function ($penjualans) {
                    return 'Rp ' . number_format($penjualans->harga_satuan, 0, ',', '.');
                })
                ->addColumn('total_harga', function ($penjualans) {
                    return 'Rp ' . number_format($penjualans->total_harga, 0, ',', '.');
                })
                ->addColumn('action', 'penjualan.datatable.action')
                ->rawColumns(['status_pembayaran', 'action'])
                ->toJson();
        }

        return view('penjualan.index', compact('penjualans', 'penjualanTrashedCount', 'barangs', 'customers'));
    }

    /**
     * Store a newly created sale in the database.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(PenjualanStoreRequest $request): RedirectResponse
    {
        Penjualan::create($request->validated());

        return redirect()->route('penjualans.index')->with('success', 'Penjualan berhasil ditambahkan!');
    }

    /**
     * Update the specified sale in the database.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Penjualan  $penjualan
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(PenjualanUpdateRequest $request, Penjualan $penjualan): RedirectResponse
    {
        $penjualan->update($request->validated());

        return redirect()->route('penjualans.index')->with('success', 'Penjualan berhasil diperbarui!');
    }

    /**
     * Remove the specified sale from storage.
     *
     * @param  \App\Models\Penjualan  $penjualan
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Penjualan $penjualan): RedirectResponse
    {
        $penjualan->delete();

        return redirect()->route('penjualans.index')->with('success', 'Penjualan berhasil dihapus!');
    }
}
