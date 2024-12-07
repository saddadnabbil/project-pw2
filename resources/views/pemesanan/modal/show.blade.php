<div class="modal fade" id="showPemesananModal" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Detail Pemesanan</h5>
                <button type="button" class="btn-close  " data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                @include('utilities.loading-alert')
                <div class="row">
                    <div class="col-md-12">
                        <div class="mb-3">
                            <label for="customer_name" class="form-label">Nama Pemesanan</label>
                            <input type="text" class="form-control" name="customer_name" id="customer_name"
                                placeholder="Masukkan customer_name Pemesanan.." disabled>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="mb-3">
                    <div class="col-md-12">
                        <div class="mb-3">
                            <label for="jumlah" class="form-label">Jumlah Barang</label>
                            <input type="number" class="form-control" name="jumlah" id="jumlah" placeholder="Masukkan jumlah.."
                                disabled>
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
