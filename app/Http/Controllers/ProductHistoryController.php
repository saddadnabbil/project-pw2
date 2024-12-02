<?php

namespace App\Http\Controllers;

use App\Contracts\HistoryInterface;
use App\Http\Controllers\Controller;
use App\Models\Barang;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class ProductHistoryController extends Controller implements HistoryInterface
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View|\Illuminate\Http\JsonResponse
     */
    public function index(): View|JsonResponse
    {
        $products = Barang::select(
            'id',
            'nama',
            'kode',
            'stok',
            'harga',
            'supplier_id',
        )->onlyTrashed()->get();

        if (request()->ajax()) {
            return datatables()->of($products)
                ->addIndexColumn()
                ->addColumn('action', 'product.history.datatable.action')
                ->rawColumns(['action'])
                ->toJson();
        }

        return view('product.history.index');
    }

    /**
     * Restore the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function restore(int $id): RedirectResponse
    {
        Barang::onlyTrashed()->findOrFail($id)->restore();

        return redirect()->route('products.index.history')->with('success', 'Data berhasil dikembalikan!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(int $id): RedirectResponse
    {
        Barang::onlyTrashed()->findOrFail($id)->forceDelete();

        return redirect()->route('products.index.history')->with('success', 'Data berhasil dihapus!');
    }
}
