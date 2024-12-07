<script>
    $(function() {
        $('#datatable').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('penjualans.index.history') }}",
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
    });
</script>
