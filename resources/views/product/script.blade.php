<script>
    $(function() {
        let loadingAlert = $('.modal-body #loading-alert');

        $('#datatable').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('products.index') }}",
            columns: [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex'
                },
                {
                    data: 'nama',
                    name: 'nama'
                },
                {
                    data: 'kode',
                    name: 'kode'
                },
                {
                    data: 'stok',
                    name: 'stok'
                },
                {
                    data: 'harga',
                    name: 'harga'
                },
                {
                    data: 'supplier_name',
                    name: 'supplier_name'
                },
                {
                    data: 'action',
                    name: 'action'
                },
            ]
        });

        $('#datatable').on('click', '.product-detail', function() {
            loadingAlert.show();

            let id = $(this).data('id');
            let url = "{{ route('api.products.show', ':id') }}";
            url = url.replace(':id', id);

            $('#showProductModal :input').val("Sedang mengambil data..");

            $.ajax({
                url: url,
                headers: {
                    'Accept': 'application/json',
                    'Content-Type': 'application/json'
                },
                success: function(response) {
                    loadingAlert.slideUp();

                    $('#showProductModal #nama').val(response.data.nama);
                    $('#showProductModal #kode').val(response.data.kode);
                    $('#showProductModal #stok').val(response.data.stok);
                    $('#showProductModal #harga').val(response.data.harga);
                    $('#showProductModal #supplier_id').val(response.data.supplier_id);
                }
            });
        });

        $('#datatable').on('click', '.product-edit', function() {
            loadingAlert.show();

            let id = $(this).data('id');
            let url = "{{ route('api.products.edit', ':id') }}";
            url = url.replace(':id', id);

            let formActionURL = "{{ route('products.update', ':id') }}";
            formActionURL = formActionURL.replace('id', id)

            let editProductModalEveryInput = $('#editProductModal :input').not(
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

                    editProductModalEveryInput.prop('disabled', false);

                    $('#editProductModal #edit-product-form').attr('action',
                        formActionURL);
                    $('#editProductModal #nama').val(response.data.nama);
                    $('#editProductModal #kode').val(response.data.kode);
                    $('#editProductModal #stok').val(response.data.stok);
                    $('#editProductModal #harga').val(response.data.harga);
                    $('#editProductModal #supplier_id').val(response.data.supplier_id);
                }
            });
        });
    });
</script>
