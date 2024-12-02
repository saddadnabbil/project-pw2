@extends('layouts.main', ['title' => 'Supplier', 'page_heading' => 'Histori Daftar Supplier Yang Telah Dihapus'])

@section('content')
    <section class="row">
        <div class="col-md-12 card px-3 py-3 table-responsive">
            <div class="col-md-12 py-2">
                <a href="{{ route('suppliers.index') }}" class="btn btn-primary float-end mx-2">
                    <i class="bi bi-caret-left-square"></i> Kembali Ke Daftar Supplier
                </a>
            </div>
            <table class="table table-sm" id="datatable">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nama</th>
                        <th scope="col">Alamat</th>
                        <th scope="col">Telepon</th>
                        <th scope="col">Aksi</th>
                    </tr>
                </thead>
                <tbody>
            </table>
        </div>
    </section>
@endsection

@push('js')
    @include('supplier.history.script')
@endpush
