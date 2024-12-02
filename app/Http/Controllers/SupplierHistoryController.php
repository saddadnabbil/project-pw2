<?php

namespace App\Http\Controllers;

use App\Contracts\HistoryInterface;
use App\Http\Controllers\Controller;
use App\Models\Supplier;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class SupplierHistoryController extends Controller implements HistoryInterface
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View|\Illuminate\Http\JsonResponse
     */
    public function index(): View|JsonResponse
    {
        $suppliers = Supplier::select('id', 'nama', 'alamat', 'telepon')->onlyTrashed()->get();

        if (request()->ajax()) {
            return datatables()->of($suppliers)
                ->addIndexColumn()
                ->addColumn('action', 'supplier.history.datatable.action')
                ->rawColumns(['action'])
                ->toJson();
        }

        return view('supplier.history.index');
    }

    /**
     * Restore the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function restore(int $id): RedirectResponse
    {
        Supplier::onlyTrashed()->findOrFail($id)->restore();

        return redirect()->route('suppliers.index.history')->with('success', 'Data berhasil dikembalikan!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(int $id): RedirectResponse
    {
        Supplier::onlyTrashed()->findOrFail($id)->forceDelete();

        return redirect()->route('suppliers.index.history')->with('success', 'Data berhasil dihapus!');
    }
}
