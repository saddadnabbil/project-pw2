<script>
    $(function() {
        let loadingAlert = $('.modal-body #loading-alert');

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
                    data: 'customer_name', // Display customer name
                    name: 'customer_name'
                },
                {
                    data: 'pemesanan_id', // Display Pemesanan ID
                    name: 'pemesanan_id'
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
            let url = "{{ route('api.penjualans.show', 'id') }}";
            url = url.replace('id', id); // Replace with actual penjualan ID

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
                    $('#showPenjualanModal #pemesanan_id').val(response.data.pemesanan_id);
                    $('#showPenjualanModal #total_harga').val(response.data.total_harga);
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
            let url = "{{ route('api.penjualans.edit', 'id') }}";
            url = url.replace('id', id); // Replace with actual penjualan ID

            let formActionURL = "{{ route('penjualans.update', 'id') }}";
            formActionURL = formActionURL.replace('id', id); // Form submission URL

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
                    $('#editPenjualanModal #customer_name').val(response.data
                        .customer_name);
                    $('#editPenjualanModal #pemesanan_id').val(response.data.pemesanan_id);
                    $('#editPenjualanModal #total_harga').val(response.data.total_harga);
                    $('#editPenjualanModal #tanggal_jual').val(response.data.tanggal_jual);
                    $('#editPenjualanModal #status_pembayaran').val(response.data
                        .status_pembayaran);
                }
            });
        });
    });
</script>
