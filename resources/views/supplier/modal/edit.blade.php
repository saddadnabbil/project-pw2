<div class="modal fade" id="editSupplierModal" data-bs-backdrop="static" data-bs-keyboard="false" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Ubah Supplier</h5>
                <button type="button" class="btn-close  " data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                @include('utilities.loading-alert')
                <form action="#" method="POST" id="edit-supplier-form">
                    @csrf @method('PUT')
                    <div class="row">
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label for="nama" class="form-label">Nama </label>
                                <input type="text" class="form-control @error('nama') is-invalid @enderror"
                                    name="nama" id="nama" placeholder="Masukkan nama Supplier.." required>
                                <label for="alamat" class="form-label">Alamat </label>
                                <textarea rows="3" class="form-control @error('alamat') is-invalid @enderror" name="alamat" id="alamat"
                                    required></textarea>
                                <label for="telepon" class="form-label">Telepon </label>
                                <input type="text" rows="3"
                                    class="form-control @error('telepon') is-invalid @enderror" name="telepon"
                                    id="telepon" placeholder="Masukkan telepon Supplier.." required>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary  " data-bs-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-success">Ubah</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
