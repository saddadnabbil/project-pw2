<script>
    $(function() {
        let loadingAlert = $('.modal-body #loading-alert');

        $('#addPemesananModal #barang_id').on('change', function() {
            let barangId = $(this).val();

            if (barangId) {
                $.ajax({
                    url: '/barang/' + barangId + '/harga',
                    type: 'GET',
                    success: function(response) {
                        let harga = parseFloat(response.harga.replace(/[^\d,-]+/g, "")
                            .replace(/\./g, ""));

                        $('#addPemesananModal #harga_satuan').val(harga);
                        calculateTotalHarga
                            ('#addPemesananModal');
                    },
                    error: function() {
                        alert('Failed to fetch product price');
                    }
                });
            } else {
                $('#addPemesananModal #harga_satuan').val('');
            }
        });

        $('#addPemesananModal #jumlah, #addPemesananModal #harga_satuan').on('input', function() {
            calculateTotalHarga('#addPemesananModal');
        });
        $('#editPemesananModal #jumlah, #editPemesananModal #harga_satuan').on('input', function() {
            calculateTotalHarga('#editPemesananModal');
        });

        function calculateTotalHarga(modalId) {
            let jumlah = parseInt($(modalId + ' #jumlah').val()) || 0;
            let hargaSatuan = parseFloat($(modalId + ' #harga_satuan').val()) || 0;

            console.log(modalId, jumlah, hargaSatuan);

            let totalHarga = jumlah * hargaSatuan;
            $(modalId + ' #total_harga').val(totalHarga.toFixed(
                0));
        }

        function formatCurrency(value) {
            if (!value) return "Rp 0";
            return "Rp " + value.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
        }

        function unformatCurrency(value) {
            return value.replace(/[^\d]/g, '');
        }

        $('#datatable').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('pemesanans.index') }}",
            columns: [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex'
                }, {
                    data: 'customer_name',
                    name: 'customer_name'
                },
                {
                    data: 'barang_name',
                    name: 'barang_name'
                },
                {
                    data: 'jumlah',
                    name: 'jumlah'
                },
                {
                    data: 'harga_satuan',
                    name: 'harga_satuan'
                },
                {
                    data: 'total_harga',
                    name: 'total_harga'
                },
                {
                    data: 'status',
                    name: 'status'
                },
                {
                    data: 'tanggal_pesan',
                    name: 'tanggal_pesan'
                },
                {
                    data: 'action',
                    name: 'action'
                },
            ]
        });

        $('#datatable').on('click', '.pemesanan-detail', function() {
            loadingAlert.show();

            let id = $(this).data('id');
            let url = "{{ route('api.pemesanans.show', 'id') }}";
            url = url.replace('id', id);

            $('#showPemesananModal :input').val("Sedang mengambil data..");

            $.ajax({
                url: url,
                headers: {
                    'Accept': 'application/json',
                    'Content-Type': 'application/json'
                },
                success: function(response) {
                    loadingAlert.slideUp();

                    $('#showPemesananModal #customer_name').val(response.data
                        .customer_name);
                    $('#showPemesananModal #barang_name').val(response.data.barang_name);
                    $('#showPemesananModal #jumlah').val(response.data.jumlah);

                    $('#showPemesananModal #harga_satuan').val(unformatCurrency(response
                        .data
                        .harga_satuan));
                    $('#showPemesananModal #total_harga').val(unformatCurrency(response.data
                        .total_harga));

                    $('#showPemesananModal #status').val(response.data.status);
                    $('#showPemesananModal #tanggal_pesan').val(response.data
                        .tanggal_pesan);
                }
            });
        });

        $('#datatable').on('click', '.pemesanan-edit', function() {
            loadingAlert.show();

            let id = $(this).data('id');
            let url = "{{ route('api.pemesanans.edit', 'id') }}";
            url = url.replace('id', id);

            let formActionURL = "{{ route('pemesanans.update', 'id') }}";
            formActionURL = formActionURL.replace('id', id);

            let editPemesananModalEveryInput = $('#editPemesananModal :input').not(
                'button[type=button], input[name=_token], input[name=_method]'
            ).each(function() {
                $(this).not('select').val('Sedang mengambil data..');
                $(this).prop('disabled', true);
            });

            $.ajax({
                url: url,
                headers: {
                    'Accept': 'application/json',
                },
                success: function(response) {
                    console.log(response);
                    loadingAlert.slideUp();

                    editPemesananModalEveryInput.prop('disabled', false);

                    $('#editPemesananModal #edit-pemesanan-form').attr('action',
                        formActionURL);
                    $('#editPemesananModal #customer_id').val(response.data.customer_id);
                    $('#editPemesananModal #barang_id').val(response.data.barang_id);
                    $('#editPemesananModal #jumlah').val(response.data.jumlah);

                    $('#editPemesananModal #harga_satuan').val(unformatCurrency(response
                        .data
                        .harga_satuan));
                    $('#editPemesananModal #total_harga').val(unformatCurrency(response.data
                        .total_harga));

                    $('#editPemesananModal #status').val(response.data.status);
                    $('#editPemesananModal #tanggal_pesan').val(response.data
                        .tanggal_pesan);
                }
            });
        });
    });
</script>
