<?php

// app/Http/Controllers/PemesananController.php
namespace App\Http\Controllers;

use App\Models\Pemesanan;
use App\Models\Customer;
use App\Models\Barang;
use App\Http\Requests\PemesananStoreRequest;
use App\Http\Requests\PemesananUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class PemesananController extends Controller
{
    /**
     * Display a listing of the orders.
     *
     * @return \Illuminate\View\View|\Illuminate\Http\JsonResponse
     */
    public function index(): View|JsonResponse
    {
        $pemesanans = Pemesanan::with(['customer', 'barang'])->get();
        $customers = Customer::all(); // Get all customers
        $barangs = Barang::all(); // Get all products

        // If request is ajax, return JSON for DataTables
        if (request()->ajax()) {
            return datatables()->of($pemesanans)
                ->addIndexColumn()
                ->addColumn('customer_name', function ($pemesanans) {
                    return $pemesanans->customer->nama;
                })
                ->addColumn('barang_name', function ($pemesanans) {
                    return $pemesanans->barang->nama;
                })
                ->addColumn('action', 'pemesanan.datatable.action')
                ->rawColumns(['action'])
                ->toJson();
        }

        $pemesananTrashedCount = Pemesanan::onlyTrashed()->count();

        return view('pemesanan.index', compact('pemesananTrashedCount', 'pemesanans', 'customers', 'barangs'));
    }

    /**
     * Show the form for creating a new order.
     *
     * @return \Illuminate\View\View
     */
    public function create(): View
    {
        $customers = Customer::all();
        $barangs = Barang::all();

        return view('pemesanan.create', compact('customers', 'barangs'));
    }

    /**
     * Store a newly created order in the database.
     *
     * @param  \App\Http\Requests\PemesananStoreRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(PemesananStoreRequest $request): RedirectResponse
    {
        $validated = $request->validated();

        // Calculate total price
        $validated['total_harga'] = $validated['jumlah'] * $validated['harga_satuan'];

        // Create order
        Pemesanan::create($validated);

        return redirect()->route('pemesanans.index')->with('success', 'Order berhasil ditambahkan!');
    }

    /**
     * Show the form for editing the specified order.
     *
     * @param  \App\Models\Pemesanan  $pemesanans
     * @return \Illuminate\View\View
     */
    public function edit(Pemesanan $pemesanans): View
    {
        $customers = Customer::all();
        $barangs = Barang::all();

        return view('pemesanan.edit', compact('pemesanans', 'customers', 'barangs'));
    }

    /**
     * Update the specified order in the database.
     *
     * @param  \App\Http\Requests\PemesananUpdateRequest  $request
     * @param  \App\Models\Pemesanan  $pemesanans
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(PemesananUpdateRequest $request, Pemesanan $pemesanans): RedirectResponse
    {
        $validated = $request->validated();

        // Calculate total price
        $validated['total_harga'] = $validated['jumlah'] * $validated['harga_satuan'];

        $pemesanans->update($validated);

        return redirect()->route('pemesanans.index')->with('success', 'Order berhasil diperbarui!');
    }

    /**
     * Remove the specified order from storage.
     *
     * @param  \App\Models\Pemesanan  $pemesanans
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Pemesanan $pemesanans): RedirectResponse
    {
        $pemesanans->delete();

        return redirect()->route('pemesanans.index')->with('success', 'Order berhasil dihapus!');
    }

    public function getHarga($id)
    {
        $barang = Barang::findOrFail($id);
        return response()->json(['harga' => $barang->harga]);
    }
}
