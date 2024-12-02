<div class="modal fade" id="editPemesananModal" data-bs-backdrop="static" data-bs-keyboard="false" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Ubah Pemesanan</h5>
                <button type="button" class="btn-close  " data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                @include('utilities.loading-alert')
                <form action="#" method="POST" id="edit-product-form">
                    @csrf @method('PUT')
                    <div class="row">
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label for="nama" class="form-label">Nama Pemesanan</label>
                                <input type="text" class="form-control" name="nama" id="nama"
                                    placeholder="Masukkan nama Pemesanan.." required>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="mb-3">
                                <label for="kode" class="form-label">Kode Pemesanan</label>
                                <input type="text" class="form-control" name="kode" id="kode"
                                    placeholder="Masukkan kode Pemesanan.." required>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="mb-3">
                                <label for="stok" class="form-label">Stok</label>
                                <input type="number" class="form-control" name="stok" id="stok"
                                    placeholder="Masukkan stok Pemesanan.." required>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="mb-3">
                                <label for="harga" class="form-label">Harga</label>
                                <input type="number" class="form-control" name="harga" id="harga"
                                    placeholder="Masukkan harga Pemesanan.." required>
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
