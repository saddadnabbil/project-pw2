@extends('layouts.main', ['title' => 'Product', 'page_heading' => 'Histori Daftar Product Yang Telah Dihapus'])

@section('content')
    <section class="row">
        <div class="col-md-12 card px-3 py-3 table-responsive">
            <div class="col-md-12 py-2">
                <a href="{{ route('pemesanans.index') }}" class="btn btn-primary float-end mx-2">
                    <i class="bi bi-caret-left-square"></i> Kembali Ke Daftar Product
                </a>
            </div>
            <table class="table table-sm" id="datatable">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nama</th>
                        <th scope="col">Kode</th>
                        <th scope="col">Stock</th>
                        <th scope="col">Harga</th>
                        <th scope="col">Supplier</th>
                        <th scope="col">Aksi</th>
                    </tr>
                </thead>
                <tbody>
            </table>
        </div>
    </section>
@endsection

@push('js')
    @include('pemesanan.history.script')
@endpush
