@extends('layouts.main', ['title' => 'Customer', 'page_heading' => 'Data Customer'])

@section('content')
    <section class="row">
        <div class="col card px-3 py-3">
            @auth
                <div class="d-flex justify-content-end pb-3">
                    <div class="btn-group d-gap gap-2">
                        <a href="{{ route('customers.index.history') }}" class="btn btn-secondary">
                            <span class="badge">{{ $customerTrashedCount }}</span> Histori Data Customer
                        </a>
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addCustomerModal">
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
                            <th scope="col">Email User</th> <!-- Menambahkan kolom Email User -->
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
    @include('customer.modal.create')
    @include('customer.modal.show')
    @include('customer.modal.edit')
@endpush

@push('js')
    @include('customer.script')
@endpush
