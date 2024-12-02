@extends('layouts.main', ['title' => 'Product', 'page_heading' => 'Data Product'])

@section('content')
    <section class="row">
        <div class="col card px-3 py-3">
            @auth
                <div class="d-flex justify-content-end pb-3">
                    <div class="btn-group d-gap gap-2">
                        <a href="{{ route('products.index.history') }}" class="btn btn-secondary">
                            <span class="badge">{{ $productTrashedCount }}</span> Histori Data Product
                        </a>
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addProductModal">
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
                            <th scope="col">Kode</th>
                            <th scope="col">Stock</th>
                            <th scope="col">Harga</th>
                            <th scope="col">Supplier</th>
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
    @include('product.modal.create')
    @include('product.modal.show')
    @include('product.modal.edit')
@endpush

@push('js')
    @include('product.script')
@endpush
