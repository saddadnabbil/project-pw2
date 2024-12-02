@extends('layouts.main', ['title' => 'Supplier', 'page_heading' => 'Data Supplier'])

@section('content')
    <section class="row">
        <div class="col card px-3 py-3">
            @auth
                <div class="d-flex justify-content-end pb-3">
                    <div class="btn-group d-gap gap-2">
                        <a href="{{ route('suppliers.index.history') }}" class="btn btn-secondary">
                            <span class="badge">{{ $supplierTrashedCount }}</span> Histori Data Supplier
                        </a>
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addSupplierModal">
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
                            <th scope="col">Nama</th>
                            <th scope="col">Alamat</th>
                            <th scope="col">Telepon</th>
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
    @include('supplier.modal.create')
    @include('supplier.modal.show')
    @include('supplier.modal.edit')
@endpush

@push('js')
    @include('supplier.script')
@endpush
