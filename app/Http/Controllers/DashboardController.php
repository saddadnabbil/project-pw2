<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\View\View;
use App\Models\SchoolClass;
use App\Models\SchoolMajor;
use Yajra\DataTables\DataTables;
use Illuminate\Http\JsonResponse;
use App\Repositories\CashTransactionRepository;
use App\Repositories\CashTransactionExpenditureRepository;

class DashboardController extends Controller
{
    // private $cashTransactionRepository, $startOfMonth, $endOfMonth;

    public function __construct(
        // CashTransactionRepository $cashTransactionRepository,
        // private CashTransactionExpenditureRepository $cashTransactionExpenditureRepository,
    )
    {
        // $this->cashTransactionRepository = $cashTransactionRepository;
        // $this->startOfMonth = now()->startOfMonth()->format('Y-m-d');
        // $this->endOfMonth = now()->endOfMonth()->format('Y-m-d');
    }

    /**
     * Handle the incoming request.
     *
     * @return \Illuminate\View\View
     */
    public function __invoke(): View|JsonResponse
    {
        // $tunggakan = $this->cashTransactionRepository->results()['students']['haveTunggakan'];

        // if (request()->ajax()) {
        //     $tunggakan = $this->cashTransactionRepository->results()['students']['haveTunggakan'];

        //     return DataTables::of($tunggakan)
        //         ->addIndexColumn()
        //         ->editColumn('missing_months', function ($row) {
        //             // Ensure $row->missing_months is an array before calling implode
        //             if (is_array($row->missing_months)) {
        //                 return implode(', ', $row->missing_months);
        //             }
        //             return $row->missing_months; // Handle it if it's not an array
        //         })
        //         ->make(true);
        // }
        // // Operasi untuk Balance Kas Bulan sebelumnya
        // $lastMonth = date('m', strtotime('-1 month'));
        // $amountCashTransactionLastMonth = $this->cashTransactionRepository->sumAmountBy('month');
        // $amountCashTransactionExpenditureLastMonth = $this->cashTransactionExpenditureRepository->sumExpenditureBy('month');
        // $amountBalanceLastMonth = $amountCashTransactionLastMonth - $amountCashTransactionExpenditureLastMonth;

        // // Int ke Format Rupiah Indonesia Perbulan
        // $amountCashTransactionLastMonth = indonesian_currency($this->cashTransactionRepository->sumAmountBy('month'));
        // $amountCashTransactionExpenditureLastMonth = indonesian_currency($this->cashTransactionExpenditureRepository->sumExpenditureBy('month'));
        // $amountBalanceLastMonth = indonesian_currency($amountBalanceLastMonth);

        // // Operasi untuk Balance Total Kas
        // $amountCashTransaction = $this->cashTransactionRepository->sumAmount();
        // $amountCashTransactionExpenditure = $this->cashTransactionExpenditureRepository->sumExpenditure();
        // $amountBalance = $amountCashTransaction - $amountCashTransactionExpenditure;

        // // Int ke Format Rupiah Indonesia Total
        // $amountCashTransaction = indonesian_currency($this->cashTransactionRepository->sumAmount());
        // $amountCashTransactionExpenditure = indonesian_currency($this->cashTransactionExpenditureRepository->sumExpenditure());
        // $amountBalance = indonesian_currency($amountBalance);

        // $latestCashTransactions = $this->cashTransactionRepository
        //     ->cashTransactionLatest(['id', 'student_id', 'user_id', 'bill', 'amount', 'date'], 5);

        return view('dashboard.index', [
            // 'studentCount' => Student::count(),
            // 'schoolClassCount' => SchoolClass::count(),
            // 'schoolMajorCount' => SchoolMajor::count(),

            // // total 
            // 'amountCashTransaction' => $amountCashTransaction,
            // 'amountCashTransactionExpenditure' => $amountCashTransactionExpenditure,
            // 'amountBalance' => $amountBalance,

            // // perbulan
            // 'amountCashTransactionLastMonth' => $amountCashTransactionLastMonth,
            // 'amountCashTransactionExpenditureLastMonth' => $amountCashTransactionExpenditureLastMonth,

            // 'amountBalanceLastMonth' => $amountBalanceLastMonth,
            // 'latestCashTransactions' => $latestCashTransactions,

            // 'data' => $this->cashTransactionRepository->results(),
        ]);
    }
}
