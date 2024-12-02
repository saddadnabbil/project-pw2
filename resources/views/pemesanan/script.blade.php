<script>
    $(function() {
        let loadingAlert = $('.modal-body #loading-alert');

        // When the product is selected, fetch the price for that product
        $('#barang_id').on('change', function() {
            let barangId = $(this).val();

            if (barangId) {
                // Fetch the price based on the selected product
                $.ajax({
                    url: '/barang/' + barangId + '/harga',
                    type: 'GET',
                    success: function(response) {
                        // Fill the harga_satuan field with the price of the selected product
                        $('#harga_satuan').val(response.harga);
                        calculateTotalHarga
                    (); // Recalculate the total price whenever harga_satuan changes
                    },
                    error: function() {
                        alert('Failed to fetch product price');
                    }
                });
            } else {
                $('#harga_satuan').val(''); // Clear the harga_satuan field if no product is selected
            }
        });

        // Calculate total price based on quantity and unit price
        $('#jumlah, #harga_satuan').on('input', function() {
            calculateTotalHarga();
        });

        function calculateTotalHarga() {
            let jumlah = parseInt($('#jumlah').val()) || 0;
            let hargaSatuan = parseFloat($('#harga_satuan').val()) || 0;
            let totalHarga = jumlah * hargaSatuan;
            $('#total_harga').val(totalHarga);
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
                    $('#showPemesananModal #harga_satuan').val(response.data.harga_satuan);
                    $('#showPemesananModal #total_harga').val(response.data.total_harga);
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
            formActionURL = formActionURL.replace('id', id)

            let editPemesananModalEveryInput = $('#editPemesananModal :input').not(
                    'button[type=button], input[name=_token], input[name=_method]')
                .each(function() {
                    $(this).not('select').val('Sedang mengambil data..');
                    $(this).prop('disabled', true);
                });

            $.ajax({
                url: url,
                headers: {
                    'Accept': 'application/json',
                },
                success: function(response) {
                    loadingAlert.slideUp();

                    editPemesananModalEveryInput.prop('disabled', false);

                    $('#editPemesananModal #edit-pemesanan-form').attr('action',
                        formActionURL);
                    $('#editPemesananModal #customer_id').val(response.data.customer_id);
                    $('#editPemesananModal #barang_id').val(response.data.barang_id);
                    $('#editPemesananModal #jumlah').val(response.data.jumlah);
                    $('#editPemesananModal #harga_satuan').val(response.data.harga_satuan);
                    $('#editPemesananModal #total_harga').val(response.data.total_harga);
                    $('#editPemesananModal #status').val(response.data.status);
                    $('#editPemesananModal #tanggal_pesan').val(response.data
                        .tanggal_pesan);
                }
            });
        });
    });
</script>
