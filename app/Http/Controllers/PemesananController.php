<?php

// app/Http/Controllers/PemesananController.php
namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Customer;
use App\Models\Pemesanan;
use Illuminate\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\PemesananStoreRequest;
use App\Http\Requests\PemesananUpdateRequest;
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
     * Store a newly created order in the database.
     *
     * @param  \App\Http\Requests\PemesananStoreRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(PemesananStoreRequest $request): RedirectResponse
    {
        $validated = $request->validated();
        $validated['tanggal_pesan'] = \Carbon\Carbon::createFromFormat('d-m-Y', $validated['tanggal_pesan'])->format('Y-m-d');
        $validated['total_harga'] = $validated['jumlah'] * $validated['harga_satuan'];

        Pemesanan::create($validated);

        return redirect()->route('pemesanans.index')->with('success', 'Pemesanan berhasil ditambahkan!');
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
        $validated['total_harga'] = $validated['jumlah'] * $validated['harga_satuan'];

        // Debugging
        Log::debug('Updating Pemesanan with data: ', $validated);

        $updated = $pemesanans->update($validated);

        if ($updated) {
            Log::debug('Pemesanan updated successfully');
        } else {
            Log::error('Pemesanan update failed');
        }

        return redirect()->route('pemesanans.index')->with('success', 'Pemesanan berhasil diperbarui!');
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

        return redirect()->route('pemesanans.index')->with('success', 'Pemesanan berhasil dihapus!');
    }

    public function getHarga($id)
    {
        $barang = Barang::findOrFail($id);
        return response()->json(['harga' => $barang->harga]);
    }
}
