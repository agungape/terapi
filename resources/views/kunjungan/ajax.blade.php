    <script>
        $('.kirim-data').click(function() {
            let id = $(this).data('id');
            let nama = $(this).data('nama');
            $('input:hidden[name=anak_id]').val(id);
            $('input:text[name=nama]').val(nama);
        });
    </script>
