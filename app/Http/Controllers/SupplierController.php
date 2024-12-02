<?php

namespace App\Http\Controllers;

use App\Http\Requests\SupplierStoreRequest;
use App\Http\Requests\SupplierUpdateRequest;
use App\Models\Supplier;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View|\Illuminate\Http\JsonResponse
     */
    public function index(): View|JsonResponse
    {
        $suppliers = Supplier::select('id', 'nama', 'alamat', 'telepon')->orderBy('nama')->get();

        if (request()->ajax()) {
            return datatables()->of($suppliers)
                ->addIndexColumn()
                ->addColumn('action', 'supplier.datatable.action')
                ->rawColumns(['action'])
                ->toJson();
        }

        $supplierTrashedCount = Supplier::onlyTrashed()->count();

        return view('supplier.index', compact('supplierTrashedCount'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\SupplierStoreRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(SupplierStoreRequest $request): RedirectResponse
    {
        Supplier::create($request->validated());

        return redirect()->route('suppliers.index')->with('success', 'Data berhasil ditambahkan!');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\SupplierUpdateRequest  $request
     * @param  \App\Models\Supplier  $supplier
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(SupplierUpdateRequest $request, Supplier $supplier): RedirectResponse
    {
        $supplier->update($request->validated());

        return redirect()->route('suppliers.index')->with('success', 'Data berhasil diubah!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Supplier  $supplier
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Supplier $supplier): RedirectResponse
    {
        if ($supplier->barangs()->exists()) {
            return redirect()->route('suppliers.index')->with('warning', 'Data yang memiliki relasi tidak dapat dihapus!');
        }

        $supplier->delete();

        return redirect()->route('suppliers.index')->with('success', 'Data berhasil dihapus!');
    }
}
