<div class="modal fade" id="editPenjualanModal" data-bs-backdrop="static" data-bs-keyboard="false" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Ubah Penjualan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                @include('utilities.loading-alert')
                <form action="#" method="POST" id="edit-penjualan-form">
                    @csrf
                    @method('PUT') <!-- Method Spoofing for PUT Request -->
                    <div class="row">
                        <!-- Pemesanan ID Field (Select Dropdown) -->
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label for="pemesanan_id" class="form-label">Pemesanan</label>
                                <select class="form-control @error('pemesanan_id') is-invalid @enderror"
                                    name="pemesanan_id" id="pemesanan_id" required>
                                    <option value="">Pilih Pemesanan</option>
                                    <!-- Loop through pemesanan and display options -->
                                    @foreach ($pemesanans as $pemesanan)
                                        <option value="{{ $pemesanan->id }}" id="pemesanan_option_{{ $pemesanan->id }}"
                                            data-total-harga="{{ $pemesanan->total_harga }}"
                                            {{ old('pemesanan_id') == $pemesanan->id ? 'selected' : '' }}>
                                            {{ $pemesanan->id }} - {{ $pemesanan->customer->nama }} -
                                            {{ $pemesanan->total_harga }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('pemesanan_id')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Customer ID Field -->
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label for="customer_id" class="form-label">Customer</label>
                                <select class="form-control @error('customer_id') is-invalid @enderror"
                                    name="customer_id" id="customer_id" required>
                                    <option value="">Pilih Customer</option>
                                    <!-- Loop through customers and display options -->
                                    @foreach ($customers as $customer)
                                        <option value="{{ $customer->id }}"
                                            {{ old('customer_id') == $customer->id ? 'selected' : '' }}>
                                            {{ $customer->nama }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('customer_id')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Total Harga Field -->
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label for="total_harga" class="form-label">Total Harga</label>
                                <input type="text" class="form-control @error('total_harga') is-invalid @enderror"
                                    name="total_harga" id="total_harga" value="{{ old('total_harga') }}"
                                    placeholder="Masukkan total harga.." required>
                                @error('total_harga')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Tanggal Penjualan Field -->
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label for="tanggal_jual" class="form-label">Tanggal Penjualan</label>
                                <input type="date" class="form-control @error('tanggal_jual') is-invalid @enderror"
                                    name="tanggal_jual" id="tanggal_jual" value="{{ old('tanggal_jual') }}" required>
                                @error('tanggal_jual')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Status Pembayaran Field -->
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label for="status_pembayaran" class="form-label">Status Pembayaran</label>
                                <select class="form-control @error('status_pembayaran') is-invalid @enderror"
                                    name="status_pembayaran" id="status_pembayaran" required>
                                    <option value="paid" {{ old('status_pembayaran') == 'paid' ? 'selected' : '' }}>
                                        Paid</option>
                                    <option value="unpaid"
                                        {{ old('status_pembayaran') == 'unpaid' ? 'selected' : '' }}>
                                        unpaid</option>
                                </select>
                                @error('status_pembayaran')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-success">Ubah</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
