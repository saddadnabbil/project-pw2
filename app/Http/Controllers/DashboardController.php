<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\User;
use App\Models\Student;
use App\Models\Customer;
use App\Models\Supplier;
use Illuminate\View\View;
use App\Models\SchoolClass;
use App\Models\SchoolMajor;
use Yajra\DataTables\DataTables;
use Illuminate\Http\JsonResponse;
use App\Repositories\CashTransactionRepository;
use App\Repositories\CashTransactionExpenditureRepository;

class DashboardController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @return \Illuminate\View\View
     */
    public function __invoke(): View|JsonResponse
    {
        $totalCustomer = Customer::count();
        $totalSupplier = Supplier::count();
        $totalAdministrator = User::count();
        $totalBarang = Barang::count();

        $customers = Customer::all();

        return view('dashboard.index', compact([
            'totalCustomer',
            'totalSupplier',
            'totalAdministrator',
            'totalBarang',
            'customers'
        ]));
    }
}
