<div class="modal fade" id="showPenjualanModal" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Detail Penjualan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                @include('utilities.loading-alert')
                <div class="row">
                    <!-- Pemesanan ID -->
                    <div class="col-md-12">
                        <div class="mb-3">
                            <label for="pemesanan_id" class="form-label">Pemesanan</label>
                            <input type="text" class="form-control" id="pemesanan_id" disabled>
                        </div>
                    </div>

                    <!-- Customer Name -->
                    <div class="col-md-12">
                        <div class="mb-3">
                            <label for="customer_name" class="form-label">Customer</label>
                            <input type="text" class="form-control" id="customer_name" disabled>
                        </div>
                    </div>

                    <!-- Total Harga -->
                    <div class="col-md-12">
                        <div class="mb-3">
                            <label for="total_harga" class="form-label">Total Harga</label>
                            <input type="text" class="form-control" id="total_harga" disabled>
                        </div>
                    </div>

                    <!-- Tanggal Penjualan -->
                    <div class="col-md-12">
                        <div class="mb-3">
                            <label for="tanggal_jual" class="form-label">Tanggal Penjualan</label>
                            <input type="text" class="form-control" id="tanggal_jual" disabled>
                        </div>
                    </div>

                    <!-- Status Pembayaran -->
                    <div class="col-md-12">
                        <div class="mb-3">
                            <label for="status_pembayaran" class="form-label">Status Pembayaran</label>
                            <input type="text" class="form-control" id="status_pembayaran" disabled>
                        </div>
                    </div>

                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>
