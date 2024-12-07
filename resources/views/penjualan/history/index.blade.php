@extends('layouts.main', ['title' => 'Penjualan', 'page_heading' => 'Histori Daftar Penjualan Yang Telah Dihapus'])

@section('content')
    <section class="row">
        <div class="col-md-12 card px-3 py-3 table-responsive">
            <div class="col-md-12 py-2">
                <a href="{{ route('penjualans.index') }}" class="btn btn-primary float-end mx-2">
                    <i class="bi bi-caret-left-square"></i> Kembali Ke Daftar Penjualan
                </a>
            </div>
            <table class="table table-sm" id="datatable">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Customer</th>
                        <th scope="col">Barang</th>
                        <th scope="col">Jumlah</th>
                        <th scope="col">Harga Satuan</th>
                        <th scope="col">Total Harga</th>
                        <th scope="col">Tanggal Penjualan</th>
                        <th scope="col">Status Pembayaran</th>
                        <th scope="col">Aksi</th>
                    </tr>
                </thead>
                <tbody>
            </table>
        </div>
    </section>
@endsection

@push('js')
    @include('penjualan.history.script')
@endpush
