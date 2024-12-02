<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use App\Http\Resources\CustomerResource;
use App\Http\Requests\CustomerStoreRequest;
use App\Http\Requests\CustomerUpdateRequest;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View|\Illuminate\Http\JsonResponse
     */
    public function index(): View|JsonResponse
    {
        // Ambil data customers beserta email user yang berelasi
        $customers = Customer::with('user')->select(
            'id',
            'nama',
            'email',
            'alamat',
            'telepon',
            'user_id' // Menyertakan user_id agar bisa diakses
        )->get();

        $users = User::whereNot('role', 'admin')->get();

        // Jika request ajax, kirim data dalam format JSON untuk DataTables
        if (request()->ajax()) {
            return datatables()->of($customers)
                ->addIndexColumn()
                ->addColumn('user_email', function ($customer) {
                    return $customer->user->email;
                })
                ->addColumn('action', 'customer.datatable.action')
                ->rawColumns(['action'])
                ->toJson();
        }

        // Trash: count customers that are soft deleted
        $customerTrashedCount = Customer::onlyTrashed()->count();

        // Jika bukan request ajax, tampilkan view biasa
        return view('customer.index', compact('customerTrashedCount', 'customers', 'users'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\CustomerStoreRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(CustomerStoreRequest $request): RedirectResponse
    {
        Customer::create($request->validated());

        return redirect()->route('customers.index')->with('success', 'Data berhasil ditambahkan!');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\CustomerUpdateRequest  $request
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(CustomerUpdateRequest $request, Customer $customer): RedirectResponse
    {
        $customer->update($request->validated());

        return redirect()->route('customers.index')->with('success', 'Data berhasil diubah!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Customer $customer): RedirectResponse
    {
        // Hapus data customer
        $customer->delete();

        return redirect()->route('customers.index')->with('success', 'Data berhasil dihapus!');
    }
}
