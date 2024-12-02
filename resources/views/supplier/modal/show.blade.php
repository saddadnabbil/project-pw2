<div class="modal fade" id="showSupplierModal" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Detail Supplier</h5>
                <button type="button" class="btn-close  " data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                @include('utilities.loading-alert')
                <div class="row">
                    <div class="col-md-12">
                        <div class="mb-3">
                            <label for="name" class="form-label">Nama Supplier</label>
                            <input type="text" class="form-control" id="name" disabled>
                            <label for="nama" class="form-label">Nama </label>
                            <input type="text" class="form-control " name="nama" id="nama" disabled>
                            <label for="alamat" class="form-label">Alamat </label>
                            <textarea rows="3" class="form-control " name="alamat" id="alamat" disabled></textarea>
                            <label for="telepon" class="form-label">Telepon </label>
                            <input type="text" rows="3" class="form-control " name="telepon" id="telepon"
                                value="{{ old('telepon') }}" disabled>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary  " data-bs-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>
</div>
