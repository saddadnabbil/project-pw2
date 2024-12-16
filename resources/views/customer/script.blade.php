<script>
    $(function() {
        let loadingAlert = $('.modal-body #loading-alert');

        $('#datatable').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('customers.index') }}",
            columns: [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex'
                },
                {
                    data: 'nama',
                    name: 'nama'
                },
                {
                    data: 'alamat',
                    name: 'alamat'
                },
                {
                    data: 'telepon',
                    name: 'telepon'
                },
                {
                    data: 'action',
                    name: 'action'
                },
            ]
        });

        // Menampilkan detail customer
        $('#datatable').on('click', '.customer-detail', function() {
            let id = $(this).data('id');
            let url = "{{ route('api.customers.show', 'id') }}";
            url = url.replace('id', id);

            console.log(url);

            $('#showCustomerModal :input').val("Sedang mengambil data..");

            $.ajax({
                url: url,
                headers: {
                    'Accept': 'application/json',
                    'Content-Type': 'application/json'
                },
                success: function(response) {
                    loadingAlert.slideUp();

                    $('#showCustomerModal #nama').val(response.data.nama);
                    $('#showCustomerModal #email').val(response.data.email);
                    $('#showCustomerModal #alamat').val(response.data.alamat);
                    $('#showCustomerModal #telepon').val(response.data.telepon);
                }
            });
        });

        // Menampilkan modal edit customer
        $('#datatable').on('click', '.customer-edit', function() {
            let id = $(this).data('id');
            let url = "{{ route('api.customers.edit', 'id') }}";
            url = url.replace('id', id);

            let formActionURL = "{{ route('customers.update', 'id') }}";
            formActionURL = formActionURL.replace('id', id)

            let editCustomerModalEveryInput = $('#editCustomerModal :input').not(
                'button[type=button], input[name=_token], input[name=_method]');

            $.ajax({
                url: url,
                headers: {
                    'Accept': 'application/json',
                },
                success: function(response) {
                    loadingAlert.slideUp();

                    editCustomerModalEveryInput.prop('disabled', false);

                    $('#editCustomerModal #edit-customer-form').attr('action',
                        formActionURL);
                    $('#editCustomerModal #nama').val(response.data.nama);
                    $('#editCustomerModal #email').val(response.data.email);
                    $('#editCustomerModal #alamat').val(response.data.alamat);
                    $('#editCustomerModal #telepon').val(response.data.telepon);
                }
            });
        });
    });
</script>
