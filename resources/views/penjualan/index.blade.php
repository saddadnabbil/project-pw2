@extends('layouts.main', ['title' => 'Penjualan', 'page_heading' => 'Data Penjualan'])

@section('content')
    <section class="row">
        <div class="col card px-3 py-3">
            @auth
                <div class="d-flex justify-content-end pb-3">
                    <div class="btn-group d-gap gap-2">
                        <a href="{{ route('penjualans.index.history') }}" class="btn btn-secondary">
                            <span class="badge">{{ $penjualanTrashedCount }}</span> Histori Data Penjualan
                        </a>
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addPenjualanModal">
                            <i class="bi bi-plus-circle"></i> Tambah Data
                        </button>
                    </div>
                </div>
            @endauth

            <div class="table-responsive">
                <table class="table table-sm w-100" id="datatable">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Customer</th>
                            <th scope="col">ID Pemesanan</th>
                            <th scope="col">Total Harga</th>
                            <th scope="col">Tanggal Penjualan</th>
                            <th scope="col">Status Pembayaran</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </section>
@endsection

@push('modal')
    @include('penjualan.modal.create')
    @include('penjualan.modal.show')
    @include('penjualan.modal.edit')
@endpush

@push('js')
    @include('penjualan.script')
@endpush
