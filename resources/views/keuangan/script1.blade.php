@section('scripts')
    {{-- script pemasukkan --}}
    <script>
        function formatRupiah(input) {
            let value = input.value.replace(/[^0-9]/g, ''); // Hanya angka

            if (value) {
                value = parseInt(value).toLocaleString(
                    'id-ID'); // Format angka dengan titik pemisah
            }

            input.value = value || ''; // Set nilai input tanpa " Rupiah"
        }

        // modal 1
        document.addEventListener('DOMContentLoaded', () => {
            const metodePembayaran = document.getElementById('metode-pembayaran1');
            const buktiTransfer = document.getElementById('bukti-transfer1');

            // Pastikan form upload bukti transfer tersembunyi pada load awal
            buktiTransfer.style.display = 'none';

            // Tambahkan event listener pada dropdown metode pembayaran
            metodePembayaran.addEventListener('change', () => {
                if (metodePembayaran.value === 'transfer') {
                    buktiTransfer.style.display = 'block';
                } else {
                    buktiTransfer.style.display = 'none';
                }
            });
        });

        document.getElementById('unggah-bukti1').addEventListener('change', function(event) {
            const file = event.target.files[0];
            const preview = document.getElementById('preview1');

            if (file) {
                const reader = new FileReader();

                reader.onload = function(e) {
                    preview.src = e.target.result;
                    preview.style.display = 'block';
                };

                reader.readAsDataURL(file);
            } else {
                preview.style.display = 'none';
            }
        });

        // modal 2
        document.addEventListener('DOMContentLoaded', () => {
            const metodePembayaran = document.getElementById('metode-pembayaran2');
            const buktiTransfer = document.getElementById('bukti-transfer2');

            // Pastikan form upload bukti transfer tersembunyi pada load awal
            buktiTransfer.style.display = 'none';

            // Tambahkan event listener pada dropdown metode pembayaran
            metodePembayaran.addEventListener('change', () => {
                if (metodePembayaran.value === 'transfer') {
                    buktiTransfer.style.display = 'block';
                } else {
                    buktiTransfer.style.display = 'none';
                }
            });
        });

        document.getElementById('unggah-bukti2').addEventListener('change', function(event) {
            const file = event.target.files[0];
            const preview = document.getElementById('preview2');

            if (file) {
                const reader = new FileReader();

                reader.onload = function(e) {
                    preview.src = e.target.result;
                    preview.style.display = 'block';
                };

                reader.readAsDataURL(file);
            } else {
                preview.style.display = 'none';
            }
        });
    </script>
    {{-- script pemasukkan --}}
@endsection
