@extends('layouts.main', ['title' => 'Pemesanan', 'page_heading' => 'Data Pemesanan'])

@section('content')
    <section class="row">
        <div class="col card px-3 py-3">
            @auth
                <div class="d-flex justify-content-end pb-3">
                    <div class="btn-group d-gap gap-2">
                        <a href="{{ route('pemesanans.index.history') }}" class="btn btn-secondary">
                            <span class="badge">{{ $pemesananTrashedCount }}</span> Histori Data Pemesanan
                        </a>
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addPemesananModal">
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
                            <th scope="col">Customer Name</th>
                            <th scope="col">Barang</th>
                            <th scope="col">Jumlah</th>
                            <th scope="col">Harga Satuan</th>
                            <th scope="col">Total</th>
                            <th scope="col">Status</th>
                            <th scope="col">Tanggal Pesan</th>
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
    @include('pemesanan.modal.create')
    @include('pemesanan.modal.show')
    @include('pemesanan.modal.edit')
@endpush

@push('js')
    @include('pemesanan.script')
@endpush
