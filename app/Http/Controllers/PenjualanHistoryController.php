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
            'pemesanan_id',
            'customer_id',
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
                ->addColumn('action', 'penjualan.history.datatable.action')
                ->rawColumns(['action'])
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
