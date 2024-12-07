@extends('layouts.main', ['title' => 'Dashboard', 'page_heading' => 'Dashboard'])

@section('content')
    <section class="row">
        <div class="col-12 col-lg-12">
            <div class="row">
                <div class="col-6 col-lg-3 col-md-6">
                    <a href="{{ route('customers.index') }}">
                        <div class="card card-stat">
                            <div class="card-body px-3 py-4-5">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="stats-icon purple">
                                            <i class="iconly-boldProfile"></i>
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <h6 class="text-muted font-semibold">Customers</h6>
                                        <h6 class="font-extrabold {{ $totalCustomer <= 0 ? 'text-danger' : '' }} mb-0">
                                            {{ $totalCustomer }}
                                        </h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-6 col-lg-3 col-md-6">
                    <a href="{{ route('suppliers.index') }}">
                        <div class="card card-stat">
                            <div class="card-body px-3 py-4-5">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="stats-icon green">
                                            <i class="iconly-boldTicket"></i>
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <h6 class="text-muted font-semibold">Suppliers</h6>
                                        <h6 class="font-extrabold mb-0">{{ $totalSupplier }}</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-6 col-lg-3 col-md-6">
                    <a href="{{ route('administrators.index') }}">
                        <div class="card card-stat">
                            <div class="card-body px-3 py-4-5">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="stats-icon red">
                                            <i class="iconly-boldWork"></i>
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <h6 class="text-muted font-semibold">Total Administrator</h6>
                                        <h6 class="font-extrabold mb-0">
                                            <h6 class="font-extrabold mb-0">{{ $totalAdministrator }}
                                            </h6>
                                        </h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-6 col-lg-3 col-md-6">
                    <a href="{{ route('products.index') }}">
                        <div class="card card-stat">
                            <div class="card-body px-3 py-4-5">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="stats-icon blue">
                                            <i class="iconly-boldBookmark"></i>
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <h6 class="text-muted font-semibold">Total Barang</h6>
                                        <h6 class="font-extrabold mb-0">
                                            {{ $totalBarang }}
                                        </h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    @include('dashboard.charts.chart')
                </div>
            </div>
        </div>

        <div class="col-12 col-xl-12">
            <div class="card">
                <div class="card-header">
                    <h4>Customers</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover table-striped table-lg">
                            <thead>
                                <tr>
                                    <th>Nama</th>
                                    <th>Alamat</th>
                                    <th>Telepon</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($customers as $customer)
                                    <tr>
                                        <td class="col-5">
                                            <div class="d-flex align-items-center">
                                                <p class="font-bold ms-3 mb-0">
                                                    {{ $customer->nama }}
                                                </p>
                                            </div>
                                        </td>
                                        <td class="col-auto">
                                            <p class=" mb-0">
                                                {{ $customer->alamat }}
                                            </p>
                                        </td>
                                        <td class="col-auto">
                                            <p class=" mb-0">
                                                {{ $customer->telepon }}
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
    </section>
@endsection

{{-- @push('modal')
    @include('dashboard.modal.show')
    @include('dashboard.modal.look-more')
    @include('dashboard.modal.look-more-not-paid-last-month')
@endpush

@push('js')
    @include('dashboard.script')
@endpush --}}
