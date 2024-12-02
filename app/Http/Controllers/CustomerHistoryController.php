<?php

namespace App\Http\Controllers;

use App\Contracts\HistoryInterface;
use App\Models\Customer;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class CustomerHistoryController extends Controller implements HistoryInterface
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View|\Illuminate\Http\JsonResponse
     */
    public function index(): View|JsonResponse
    {
        $customers = Customer::select(
            'id',
            'user_id',
            'nama',
            'email',
            'alamat',
            'telepon'
        )->onlyTrashed()->get();

        if (request()->ajax()) {
            return datatables()->of($customers)
                ->addIndexColumn()
                ->addColumn('action', 'customer.history.datatable.action')
                ->rawColumns(['action'])
                ->toJson();
        }

        return view('customer.history.index');
    }

    /**
     * Restore the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function restore(int $id): RedirectResponse
    {
        Customer::onlyTrashed()->findOrFail($id)->restore();

        return redirect()->route('customers.index.history')->with('success', 'Data berhasil dikembalikan!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(int $id): RedirectResponse
    {
        Customer::onlyTrashed()->findOrFail($id)->forceDelete();

        return redirect()->route('customers.index.history')->with('success', 'Data berhasil dihapus!');
    }
}
