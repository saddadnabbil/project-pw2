<?php

namespace App\Http\Controllers;

use App\Contracts\HistoryInterface;
use App\Models\Pemesanan;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class PemesananHistoryController extends Controller implements HistoryInterface
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View|\Illuminate\Http\JsonResponse
     */
    public function index(): View|JsonResponse
    {
        $pemesanans = Pemesanan::select(
            'id',
            'user_id',
            'nama',
            'email',
            'alamat',
            'telepon'
        )->onlyTrashed()->get();

        if (request()->ajax()) {
            return datatables()->of($pemesanans)
                ->addIndexColumn()
                ->addColumn('action', 'pemesanan.history.datatable.action')
                ->rawColumns(['action'])
                ->toJson();
        }

        return view('pemesanan.history.index');
    }

    /**
     * Restore the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function restore(int $id): RedirectResponse
    {
        Pemesanan::onlyTrashed()->findOrFail($id)->restore();

        return redirect()->route('pemesanans.index.history')->with('success', 'Data berhasil dikembalikan!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(int $id): RedirectResponse
    {
        Pemesanan::onlyTrashed()->findOrFail($id)->forceDelete();

        return redirect()->route('pemesanans.index.history')->with('success', 'Data berhasil dihapus!');
    }
}
