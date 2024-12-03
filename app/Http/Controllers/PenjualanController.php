<?php

namespace App\Http\Controllers;

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
        $penjualans = Penjualan::select('id', 'pemesanan_id', 'customer_id', 'total_harga', 'tanggal_jual', 'status_pembayaran')->get();
        $penjualanTrashedCount = Penjualan::onlyTrashed()->count();
        $pemesanans = Pemesanan::all();
        $customers = Customer::all();

        if (request()->ajax()) {
            return datatables()->of($penjualans)
                ->addIndexColumn()
                ->addColumn('customer_name', function ($penjualans) {
                    return $penjualans->customer ? $penjualans->customer->nama : 'No customer';
                })
                ->addColumn('pemesanan_id', function ($penjualans) {
                    return $penjualans->pemesanan ? $penjualans->pemesanan->id : 'No Pemesanan';
                })
                ->addColumn('status_pembayaran', function ($penjualans) {
                    $status = $penjualans->status_pembayaran;

                    if ($status == 'paid') {
                        return '<span class="badge bg-success">Paid</span>';
                    } else {
                        return '<span class="badge bg-danger">Unpaid</span>';
                    }
                })
                ->addColumn('action', 'penjualan.datatable.action')
                ->rawColumns(['status_pembayaran', 'action'])
                ->toJson();
        }

        return view('penjualan.index', compact('penjualans', 'penjualanTrashedCount', 'pemesanans', 'customers'));
    }

    /**
     * Store a newly created sale in the database.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'pemesanan_id' => 'required|exists:pemesanans,id',
            'customer_id' => 'required|exists:customers,id',
            'total_harga' => 'required|numeric|min:0',
            'status_pembayaran' => 'required|in:paid,unpaid',
        ]);

        Penjualan::create($validated);

        $pemesanan = Pemesanan::findOrFail($validated['pemesanan_id']);
        $pemesanan->status = 'sold';
        $pemesanan->save();

        return redirect()->route('penjualans.index')->with('success', 'Penjualan berhasil ditambahkan!');
    }

    /**
     * Update the specified sale in the database.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Penjualan  $penjualan
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Penjualan $penjualan): RedirectResponse
    {
        $validated = $request->validate([
            'pemesanan_id' => 'required|exists:pemesanans,id',
            'customer_id' => 'required|exists:customers,id',
            'total_harga' => 'required|numeric|min:0',
            'status_pembayaran' => 'required|in:paid,unpaid',
        ]);

        $penjualan->update($validated);

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
        $pemesanan = $penjualan->pemesanan;
        $pemesanan->status = 'confirmed';
        $pemesanan->save();

        $penjualan->delete();

        return redirect()->route('penjualans.index')->with('success', 'Penjualan berhasil dihapus!');
    }
}
