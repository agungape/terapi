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

        $(document).ready(function() {
            // Setup CSRF untuk request AJAX
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            // Handle dropdown Anak -> fetch layanan AJAX
            $('#anak_id').on('change', function() {
                var anakId = $(this).val();
                var anakNama = $(this).find('option:selected').data('nama');
                
                $('#hidden_deskripsi').val('Pembayaran Anak ' + (anakNama || ''));
                var layananSelect = $('#layanan_select');
                
                if (anakId) {
                    layananSelect.empty().append('<option value="">Memuat layanan...</option>').prop('disabled', true);
                    
                    $.ajax({
                        url: "/pemasukkan/layanan",
                        type: "GET",
                        data: { anak_id: anakId },
                        success: function(response) {
                            layananSelect.empty().append('<option value="">-- Pilih Layanan --</option>');
                            
                            // Group 1: Assessment Belum Lunas
                            if (response.assessments && response.assessments.length > 0) {
                                var optgroup = $('<optgroup label="Assessment Belum Lunas">');
                                response.assessments.forEach(function(item) {
                                    optgroup.append(`<option value="assessment|${item.id}|0|1">${item.label} - ${item.tujuan}</option>`);
                                });
                                layananSelect.append(optgroup);
                            }
                            
                            // Group 2: Paket Terapi
                            if (response.paket_terapi && response.paket_terapi.length > 0) {
                                var optgroup = $('<optgroup label="Paket Terapi">');
                                response.paket_terapi.forEach(function(item) {
                                    var text = `${item.nama} (${item.jumlah_pertemuan} Sesi) - sisa ${item.sisa}`;
                                    var opt = `<option value="paket_terapi|${item.id}|${item.tarif}|${item.jumlah_pertemuan}">${text}</option>`;
                                    optgroup.append(opt);
                                });
                                layananSelect.append(optgroup);
                            }
                            
                            layananSelect.prop('disabled', false).trigger('change');
                        },
                        error: function() {
                            layananSelect.empty().append('<option value="">Gagal memuat layanan</option>');
                        }
                    });
                } else {
                    layananSelect.empty().append('<option value="">-- Pilih Anak Terlebih Dahulu --</option>').prop('disabled', true);
                    resetPricing();
                }
            });

            // Ketika Layanan dipilih, update hidden inputs dan jumlah bayar
            $('#layanan_select').on('change', function() {
                var val = $(this).val();
                if (!val) {
                    resetPricing();
                    return;
                }
                
                var parts = val.split('|');
                var jenis = parts[0];  // assessment atau paket_terapi
                var id = parts[1];
                var tarif = parts[2];
                var sesi = parts[3];
                
                // Update hidden
                $('#hidden_jenis_layanan').val(jenis);
                if (jenis === 'assessment') {
                    $('#hidden_assessment_id').val(id);
                    $('#hidden_tarif_id').val('');
                } else {
                    $('#hidden_tarif_id').val(id);
                    $('#hidden_assessment_id').val('');
                }
                
                // Setup visual
                if(jenis === 'paket_terapi') {
                    $('#info_layanan').removeClass('d-none');
                    $('#info_sesi').text(sesi);
                } else {
                    $('#info_layanan').addClass('d-none');
                }
                
                // Format rupiah
                let formatted = parseInt(tarif).toString().replace(/\B(?=(\d{3})+(?!\d))/g, '.');
                // Asumsi untuk paket_terapi tarif sudah diset di controller. 
                if(tarif > 0) {
                    $('#jumlah').val(formatted).prop('readonly', true);
                } else {
                    $('#jumlah').val('').prop('readonly', false);
                }
            });

            function resetPricing() {
                $('#hidden_jenis_layanan, #hidden_assessment_id, #hidden_tarif_id').val('');
                $('#jumlah').val('').prop('readonly', false);
                $('#info_layanan').addClass('d-none');
            }
        });
    </script>
    {{-- script pemasukkan --}}
@endsection
