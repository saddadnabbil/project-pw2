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
                    data: 'status_pembayaran', // Display status pembayaran
                    name: 'status_pembayaran'
                },
                {
                    data: 'action', // Action column (edit/delete buttons)
                    name: 'action'
                },
            ]
        });
    });
</script>
