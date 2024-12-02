<script>
    $(function() {
        $('#datatable').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('pemesanans.index.history') }}",
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
                    data: 'supplier_id',
                    name: 'supplier_id'
                },
                {
                    data: 'action',
                    name: 'action'
                },
            ]
        });
    });
</script>
