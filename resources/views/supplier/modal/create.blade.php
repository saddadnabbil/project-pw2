<div class="modal fade" id="addSupplierModal" data-bs-backdrop="static" data-bs-keyboard="false" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Data Supplier</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('suppliers.store') }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label for="nama" class="form-label">Nama </label>
                                <input type="text" class="form-control @error('nama') is-invalid @enderror"
                                    name="nama" id="nama" value="{{ old('nama') }}"
                                    placeholder="Masukkan nama Supplier.." required>
                                <label for="alamat" class="form-label">Alamat </label>
                                <textarea rows="3" class="form-control @error('alamat') is-invalid @enderror" name="alamat" id="alamat"
                                    value="{{ old('alamat') }}" required></textarea>
                                <label for="telepon" class="form-label">Telepon </label>
                                <input type="text" rows="3"
                                    class="form-control @error('telepon') is-invalid @enderror" name="telepon"
                                    id="telepon" value="{{ old('telepon') }}"
                                    placeholder="Masukkan telepon Supplier.." required>


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
