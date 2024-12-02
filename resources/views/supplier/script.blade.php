<script>
    $(function() {
        let loadingAlert = $('.modal-body #loading-alert');

        $('#datatable').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('suppliers.index') }}",
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

        $('#datatable').on('click', '.supplier-detail', function() {
            loadingAlert.show();

            let id = $(this).data('id');
            let url = "{{ route('api.suppliers.show', 'id') }}";
            url = url.replace('id', id);

            $('#showSupplierModal :input').val("Sedang mengambil data..");

            $.ajax({
                url: url,
                headers: {
                    'Accept': 'application/json',
                    'Content-Type': 'application/json'
                },
                success: function(response) {
                    loadingAlert.slideUp();

                    $('#showSupplierModal #nama').val(response.data.nama);
                    $('#showSupplierModal #alamat').val(response.data.alamat);
                    $('#showSupplierModal #telepon').val(response.data.telepon);
                }
            });
        });

        $('#datatable').on('click', '.supplier-edit', function() {
            loadingAlert.show();

            let id = $(this).data('id');
            let url = "{{ route('api.suppliers.edit', 'id') }}";
            url = url.replace('id', id);

            let formActionURL = "{{ route('suppliers.update', 'id') }}";
            formActionURL = formActionURL.replace('id', id)

            let editSupplierModalEveryInput = $('#editSupplierModal :input').not(
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

                    editSupplierModalEveryInput.prop('disabled', false);

                    $('#editSupplierModal #edit-supplier-form').attr('action',
                        formActionURL);
                    $('#editSupplierModal #nama').val(response.data.nama);
                    $('#editSupplierModal #alamat').val(response.data.alamat);
                    $('#editSupplierModal #telepon').val(response.data.telepon);
                }
            });
        });
    });
</script>
