@extends('layouts.main', ['title' => 'Dashboard', 'page_heading' => 'Dashboard'])

@section('content')
    {{-- <section class="row">
        <div class="col-12 col-lg-12">
            <div class="row">
                <div class="col-6 col-lg-3 col-md-6">
                    <a
                        href="@if (!Auth::guest()) {{ route('students.index') }} @else {{ route('guest.students.index') }} @endif">
                        <div class="card card-stat">
                            <div class="card-body px-3 py-4-5">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="stats-icon purple">
                                            <i class="iconly-boldProfile"></i>
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <h6 class="text-muted font-semibold">Warga</h6>
                                        <h6 class="font-extrabold {{ $studentCount <= 0 ? 'text-danger' : '' }} mb-0">
                                            {{ $studentCount }}
                                        </h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-6 col-lg-3 col-md-6">
                    <a href="@if (!Auth::guest()) /admin/cash-transactions @else /cash-transactions @endif">
                        <div class="card card-stat">
                            <div class="card-body px-3 py-4-5">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="stats-icon green">
                                            <i class="iconly-boldTicket"></i>
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <h6 class="text-muted font-semibold">Total Pemasukan Bulan lalu</h6>
                                        <h6 class="font-extrabold mb-0">{{ $amountCashTransactionLastMonth }}</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-6 col-lg-3 col-md-6">
                    <a
                        href="@if (!Auth::guest()) /admin/cash-transaction-expenditures @else /cash-transaction-expenditures @endif">
                        <div class="card card-stat">
                            <div class="card-body px-3 py-4-5">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="stats-icon red">
                                            <i class="iconly-boldWork"></i>
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <h6 class="text-muted font-semibold">Total Pengeluaran Bulan lalu</h6>
                                        <h6 class="font-extrabold {{ $schoolMajorCount <= 0 ? 'text-danger' : '' }} mb-0">
                                            <h6 class="font-extrabold mb-0">{{ $amountCashTransactionExpenditureLastMonth }}
                                            </h6>
                                        </h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-6 col-lg-3 col-md-6">
                    <div class="card card-stat">
                        <div class="card-body px-3 py-4-5">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="stats-icon blue">
                                        <i class="iconly-boldBookmark"></i>
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <h6 class="text-muted font-semibold">Saldo Akhir</h6>
                                    <h6 class="font-extrabold mb-0">
                                        {{ $amountBalance }}
                                    </h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12 col-lg-6 col-md-6">
                    @include('dashboard.charts.chart')
                </div>
                <div class="col-sm-12 col-lg-6 col-md-6">
                    @include('dashboard.chart_expenditures.chart')
                </div>
            </div>

            <div class="col-12 col-xl-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Data Tunggakan</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-sm w-100" id="datatable">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Warga</th>
                                        <th>Jumlah Tunggakan</th>
                                        <th>Bulan Tertunggak</th>
                                    </tr>
                                </thead>
                                <tbody></tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12 col-lg-12 col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Belum Membayar Bulan Lalu </h4>
                    </div>
                    @if ($data['studentCountWho']['notPaidLastMonth'] > 0)
                        <div class="px-4">
                            <button type="button" class='btn btn-block btn-xl btn-light-danger font-bold mt-3'
                                data-bs-toggle="modal" data-bs-target="#lookMoreModal">Ada
                                <b>{{ $data['studentCountWho']['notPaidLastMonth'] }}</b> orang belum membayar pada bulan
                                lalu! <i class="bi bi-exclamation-triangle"></i></button>
                        </div>

                        <span class="badge w-100 rounded-pill bg-warning mb-3"></span>
                        <div class="card-content pb-4">
                            <div class="row">
                                @foreach ($data['students']['notPaidLastMonthLimit'] as $studentnotPaidLastMonth)
                                    <div class="col-sm-12 col-lg-6 col-md-6">
                                        <div class="recent-message d-flex px-4 py-3">
                                            <div class="name ms-4">
                                                <h5 class="mb-1">{{ $studentnotPaidLastMonth->name }}</h5>
                                                <h6 class="text-muted mb-0">
                                                    {{ $studentnotPaidLastMonth->student_identification_number }}</h6>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            <div class="px-4">
                                <button type="button" class='btn btn-block btn-xl btn-light-primary font-bold mt-3'
                                    data-bs-toggle="modal" data-bs-target="#lookMoreModalNotPaidLastMonth">Lihat
                                    Selengkapnya</button>
                            </div>
                        </div>
                    @else
                        <div class="px-4">
                            <p class='btn btn-block btn-xl btn-light-success font-bold my-3'>Terima kasih! Semua sudah
                                membayar <i class="bi bi-emoji-laughing"></i></p>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <div class="col-12 col-xl-12">
            <div class="card">
                <div class="card-header">
                    <h4>5 Transaksi Terakhir</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover table-striped table-lg">
                            <thead>
                                <tr>
                                    <th>Nama Warga</th>
                                    <th>Total Bayar</th>
                                    <th>Tanggal</th>
                                    <th>Pencatat</th>
                                    <th>Detail</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($latestCashTransactions as $latestCashTransaction)
                                    <tr>
                                        <td class="col-5">
                                            <div class="d-flex align-items-center">
                                                <p class="font-bold ms-3 mb-0">
                                                    {{ $latestCashTransaction->students->name }}
                                                </p>
                                            </div>
                                        </td>
                                        <td class="col-auto">
                                            <p class=" mb-0">
                                                {{ indonesian_currency($latestCashTransaction->amount) }}
                                            </p>
                                        </td>
                                        <td class="col-auto">
                                            <p class=" mb-0">
                                                {{ date('d-m-Y', strtotime($latestCashTransaction->date)) }}
                                            </p>
                                        </td>
                                        <td class="col-auto">
                                            <p class=" mb-0">
                                                {{ $latestCashTransaction->users->name }}
                                            </p>
                                        </td>
                                        <td class="col-auto">
                                            <p class="mb-0">
                                                <button type="button" data-id="{{ $latestCashTransaction->id }}"
                                                    class="btn btn-primary btn-sm cash-transaction-detail"
                                                    data-bs-toggle="modal" data-bs-target="#showCashTransactionModal">
                                                    <i class="bi bi-search"></i>
                                                </button>
                                            </p>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5">
                                            <p class="fw-bold text-danger text-center text-uppercase">Data kosong!</p>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </section> --}}
@endsection

@push('modal')
    @include('dashboard.modal.show')
    @include('dashboard.modal.look-more')
    @include('dashboard.modal.look-more-not-paid-last-month')
@endpush

@push('js')
    @include('dashboard.script')
@endpush
