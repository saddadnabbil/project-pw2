<div class="modal fade" id="addPemesananModal" data-bs-backdrop="static" data-bs-keyboard="false" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Data Pemesanan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('pemesanans.store') }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label for="customer_id" class="form-label">Nama Customer</label>
                                <select class="form-control @error('customer_id') is-invalid @enderror"
                                    name="customer_id" id="customer_id" required>
                                    <option value="">Pilih Customer</option>
                                    @foreach ($customers as $customer)
                                        <option value="{{ $customer->id }}"
                                            {{ old('customer_id') == $customer->id ? 'selected' : '' }}>
                                            {{ $customer->nama }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('customer_id')
                                    <div class="invalid-feedback d-block">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="barang_id" class="form-label">Nama Product</label>
                                <select class="form-control @error('barang_id') is-invalid @enderror" name="barang_id"
                                    id="barang_id" required>
                                    <option value="">Pilih Product</option>
                                    @foreach ($barangs as $barang)
                                        <option value="{{ $barang->id }}"
                                            {{ old('barang_id') == $barang->id ? 'selected' : '' }}>
                                            {{ $barang->nama }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('barang_id')
                                    <div class="invalid-feedback d-block">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="jumlah" class="form-label">Jumlah Barang</label>
                                <input type="number" class="form-control @error('jumlah') is-invalid @enderror"
                                    name="jumlah" id="jumlah" value="{{ old('jumlah') }}"
                                    placeholder="Masukkan jumlah.." required>
                                @error('jumlah')
                                    <div class="invalid-feedback d-block">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="harga_satuan" class="form-label">Harga Satuan</label>
                                <input type="number" class="form-control @error('harga_satuan') is-invalid @enderror"
                                    name="harga_satuan" id="harga_satuan" value="{{ old('harga_satuan') }}"
                                    placeholder="Masukkan harga satuan.." required readonly>
                                @error('harga_satuan')
                                    <div class="invalid-feedback d-block">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="total_harga" class="form-label">Total Harga</label>
                                <input type="number" class="form-control @error('total_harga') is-invalid @enderror"
                                    name="total_harga" id="total_harga" value="{{ old('total_harga') }}"
                                    placeholder="Total harga.." readonly>
                                @error('total_harga')
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
    