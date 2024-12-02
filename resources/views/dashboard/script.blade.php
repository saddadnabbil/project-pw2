{{-- <script>
    $(function() {
        $('.cash-transaction-detail').click(function() {
            let id = $(this).data('id');
            let url = "{{ route('api.cash-transaction.show', ':id') }}";
            url = url.replace(':id', id);

            $('#showCashTransactionModal input').val('Sedang mengambil data..');
            $('#showCashTransactionModal textarea').val('Sedang mengambil data..');
            $('#showCashTransactionModal input[type=number]').prop('type', 'text').val(
                'Sedang mengambil data..');

            $.ajax({
                url: url,
                success: function(res) {
                    $('#showCashTransactionModal #user_id').val(res.data.users.name);
                    $('#showCashTransactionModal #student_id').val(res.data.students.name);
                    $('#showCashTransactionModal #bill').val(res.data.bill);
                    $('#showCashTransactionModal #amount').val(res.data.amount);
                    $('#showCashTransactionModal #date').val(res.data.date);
                    $('#showCashTransactionModal #note').val(res.data.note);
                }
            });
        });
    });

    $('#datatable').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ route('dashboard.guest') }}",
        columns: [{
                data: 'DT_RowIndex',
                name: 'DT_RowIndex'
            },
            {
                data: 'name',
                name: 'name'
            },
            {
                data: 'jumlah_tunggakan',
                name: 'jumlah_tunggakan'
            },
            {
                data: 'bulan_tunggakan',
                name: 'bulan_tunggakan'
            } // Correct key
        ]
    });
</script> --}}
