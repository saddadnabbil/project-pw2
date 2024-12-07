<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Product;
use App\Models\Supplier;
use Illuminate\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\ProductStoreRequest;
use App\Http\Requests\ProductUpdateRequest;

class ProductController extends Controller
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
        )->orderBy('nama')->get();

        $suppliers = Supplier::orderBy('nama')->get();

        if (request()->ajax()) {
            return datatables()->of($products)
                ->addIndexColumn()
                ->addColumn('supplier_name', function ($customer) {
                    return $customer->supplier->nama; // Mengambil email dari relasi User
                })
                ->addColumn('harga', function ($products) {
                    return 'Rp ' . number_format($products->harga, 0, ',', '.');
                })
                ->addColumn('action', 'product.datatable.action')
                ->rawColumns(['action'])
                ->toJson();
        }

        $productTrashedCount = Barang::onlyTrashed()->count();

        return view('product.index', compact('productTrashedCount', 'suppliers'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\ProductStoreRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(ProductStoreRequest $request): RedirectResponse
    {
        Barang::create($request->validated());

        return redirect()->route('products.index')->with('success', 'Data berhasil ditambahkan!');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\ProductUpdateRequest  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(ProductUpdateRequest $request, Barang $product): RedirectResponse
    {
        $product->update($request->validated());

        return redirect()->route('products.index')->with('success', 'Data berhasil diubah!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Barang $product): RedirectResponse
    {
        if ($product->penjualan()->exists()) {
            return redirect()->route('products.index')->with('warning', 'Data yang memiliki relasi tidak dapat dihapus!');
        }

        $product->delete();

        return redirect()->route('products.index')->with('success', 'Data berhasil dihapus!');
    }
}
