<div class="modal fade" id="addProductModal" data-bs-backdrop="static" data-bs-keyboard="false" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Data Product</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('products.store') }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label for="nama" class="form-label">Nama Product</label>
                                <input type="text" class="form-control @error('nama') is-invalid @enderror"
                                    name="nama" id="nama" value="{{ old('nama') }}"
                                    placeholder="Masukkan nama Product.." required>

                                <label for="kode" class="form-label">Kode Product</label>
                                <input type="text" class="form-control @error('kode') is-invalid @enderror"
                                    name="kode" id="kode" value="{{ old('kode') }}"
                                    placeholder="Masukkan kode Product.." required>

                                <label for="stok" class="form-label">Stok</label>
                                <input type="number" class="form-control @error('stok') is-invalid @enderror"
                                    name="stok" id="stok" value="{{ old('stok') }}"
                                    placeholder="Masukkan stok Product.." required>

                                <label for="harga" class="form-label">Harga</label>
                                <input type="text" class="form-control @error('harga') is-invalid @enderror"
                                    name="harga" id="harga" value="{{ old('harga') }}"
                                    placeholder="Masukkan harga Product.." required>

                                <label for="supplier_id" class="form-label">Supplier</label>
                                <select class="form-control @error('supplier_id') is-invalid @enderror"
                                    name="supplier_id" id="supplier_id" required>
                                    <option value="">Pilih Supplier</option>
                                    <!-- Loop through suppliers and display options -->
                                    @foreach ($suppliers as $supplier)
                                        <option value="{{ $supplier->id }}"
                                            {{ old('supplier_id') == $supplier->id ? 'selected' : '' }}>
                                            {{ $supplier->nama }}
                                        </option>
                                    @endforeach
                                </select>

                                @error('nama')
                                    <div class="invalid-feedback d-block">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
