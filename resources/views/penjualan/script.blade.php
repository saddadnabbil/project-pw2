<script>
    $(function() {
        let loadingAlert = $('.modal-body #loading-alert');

        $('#addPenjualanModal #barang_id').on('change', function() {
            let barangId = $(this).val();

            if (barangId) {
                $.ajax({
                    url: '/barang/' + barangId + '/harga',
                    type: 'GET',
                    success: function(response) {
                        let harga = parseFloat(response.harga.replace(/[^\d,-]+/g, "")
                            .replace(/\./g, ""));

                        $('#addPenjualanModal #harga_satuan').val(harga);
                        calculateTotalHarga
                            ('#addPenjualanModal');
                    },
                    error: function() {
                        alert('Failed to fetch product price');
                    }
                });
            } else {
                $('#addPenjualanModal #harga_satuan').val('');
            }
        });

        $('#addPenjualanModal #jumlah, #addPenjualanModal #harga_satuan').on('input', function() {
            calculateTotalHarga('#addPenjualanModal');
        });
        $('#editPenjualanModal #jumlah, #editPenjualanModal #harga_satuan').on('input', function() {
            calculateTotalHarga('#editPenjualanModal');
        });

        function calculateTotalHarga(modalId) {
            let jumlah = parseInt($(modalId + ' #jumlah').val()) || 0;
            let hargaSatuan = parseFloat($(modalId + ' #harga_satuan').val()) || 0;

            console.log(modalId, jumlah, hargaSatuan);

            let totalHarga = jumlah * hargaSatuan;
            $(modalId + ' #total_harga').val(totalHarga.toFixed(
                0));
        }

        // Initialize DataTable
        $('#datatable').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('penjualans.index') }}", // Ensure this route is correct for the Penjualan index
            columns: [{
                    data: 'DT_RowIndex', // Automatic index column
                    name: 'DT_RowIndex'
                },
                {
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
                    data: 'total_harga', // Display total harga
                    name: 'total_harga'
                },
                {
                    data: 'tanggal_jual', // Display tanggal jual
                    name: 'tanggal_jual'
                },
                {
                    data: 'status_pembayaran', // Display status pembayaran with badge
                    name: 'status_pembayaran',
                    render: function(data) {
                        return data; // Return the raw HTML from the controller
                    }
                },
                {
                    data: 'action', // Action column (edit/delete buttons)
                    name: 'action'
                },
            ]
        });

        // Event listener for 'Detail' button click
        $('#datatable').on('click', '.penjualan-detail', function() {
            loadingAlert.show(); // Show loading alert

            let id = $(this).data('id');
            let url = "{{ route('api.penjualans.show', ':id') }}";
            url = url.replace(':id', id); // Replace with actual penjualan ID

            // Set the input fields to loading text
            $('#showPenjualanModal :input').val("Sedang mengambil data..");

            // AJAX request to get the details
            $.ajax({
                url: url,
                headers: {
                    'Accept': 'application/json',
                    'Content-Type': 'application/json'
                },
                success: function(response) {
                    loadingAlert.slideUp(); // Hide loading alert
                    // Fill the modal with fetched data
                    $('#showPenjualanModal #customer_name').val(response.data
                        .customer_name);
                    $('#showPenjualanModal #barang_name').val(response.data.barang_name);
                    $('#showPenjualanModal #jumlah').val(response.data.jumlah);
                    $('#showPenjualanModal #harga_satuan').val(parseInt(response
                        .data
                        .harga_satuan));
                    $('#showPenjualanModal #total_harga').val(parseInt(response
                        .data
                        .total_harga));
                    $('#showPenjualanModal #tanggal_jual').val(response.data.tanggal_jual);
                    $('#showPenjualanModal #status_pembayaran').val(response.data
                        .status_pembayaran);
                }
            });
        });

        // Event listener for 'Edit' button click
        $('#datatable').on('click', '.penjualan-edit', function() {
            loadingAlert.show(); // Show loading alert

            let id = $(this).data('id');
            let url = "{{ route('api.penjualans.edit', ':id') }}";
            url = url.replace(':id', id); // Replace with actual penjualan ID

            let formActionURL = "{{ route('penjualans.update', ':id') }}";
            formActionURL = formActionURL.replace(':id', id); // Form submission URL

            // Disable form fields while loading data
            let editPenjualanModalEveryInput = $('#editPenjualanModal :input').not(
                    'button[type=button], input[name=_token], input[name=_method]')
                .each(function() {
                    $(this).not('select').val('Sedang mengambil data..');
                    $(this).prop('disabled', true);
                });

            // AJAX request to get the data for editing
            $.ajax({
                url: url,
                headers: {
                    'Accept': 'application/json',
                },
                success: function(response) {
                    loadingAlert.slideUp(); // Hide loading alert

                    // Enable the form inputs after data is loaded
                    editPenjualanModalEveryInput.prop('disabled', false);

                    // Set the form action URL
                    $('#editPenjualanModal #edit-penjualan-form').attr('action',
                        formActionURL);

                    // Fill the form with fetched data
                    $('#editPenjualanModal #customer_id').val(response.data
                        .customer_id);
                    $('#editPenjualanModal #barang_id').val(response.data.barang_id);
                    $('#editPenjualanModal #jumlah').val(response.data.jumlah);
                    $('#editPenjualanModal #harga_satuan').val(parseInt(response
                        .data
                        .harga_satuan));
                    $('#editPenjualanModal #total_harga').val(parseInt(response
                        .data
                        .total_harga));
                    $('#editPenjualanModal #tanggal_jual').val(response.data.tanggal_jual);
                    $('#editPenjualanModal #status_pembayaran').val(response.data
                        .status_pembayaran);
                }
            });
        });
    });
</script>
