<?php

namespace App\Http\Controllers;

use App\Contracts\HistoryInterface;
use App\Models\Penjualan;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class PenjualanHistoryController extends Controller implements HistoryInterface
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View|\Illuminate\Http\JsonResponse
     */
    public function index(): View|JsonResponse
    {
        $penjualans = Penjualan::select(
            'id',
            'barang_id',
            'customer_id',
            'jumlah',
            'harga_satuan',
            'total_harga',
            'tanggal_jual',
            'status_pembayaran'
        )->onlyTrashed()->get();

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
                ->addColumn('action', 'penjualan.history.datatable.action')
                ->rawColumns([
                    'action',
                    'status_pembayaran',
                ])
                ->toJson();
        }

        return view('penjualan.history.index');
    }

    /**
     * Restore the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function restore(int $id): RedirectResponse
    {
        Penjualan::onlyTrashed()->findOrFail($id)->restore();

        return redirect()->route('penjualans.index.history')->with('success', 'Data berhasil dikembalikan!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(int $id): RedirectResponse
    {
        Penjualan::onlyTrashed()->findOrFail($id)->forceDelete();

        return redirect()->route('penjualans.index.history')->with('success', 'Data berhasil dihapus!');
    }
}
