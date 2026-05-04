{{-- script pemasukkan --}}
<script>
    function formatRupiah(input) {
        let value = input.value.replace(/[^0-9]/g, '');
        if (value) {
            value = parseInt(value).toLocaleString('id-ID');
        }
        input.value = value || '';
    }

    $(document).ready(function() {
        // Setup CSRF untuk request AJAX
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        // --- Modal 1 & 2: Toggle Bukti Transfer ---
        $(document).on('change', '#metode-pembayaran1, #metode-pembayaran2', function() {
            const targetId = this.id === 'metode-pembayaran1' ? '#bukti-transfer1' : '#bukti-transfer2';
            if ($(this).val() === 'transfer') {
                $(targetId).removeClass('hidden').addClass('animate-in zoom-in-95 duration-300');
            } else {
                $(targetId).addClass('hidden');
            }
        });

        // --- Preview Image (Delegated) ---
        $(document).on('change', '#unggah-bukti1, #unggah-bukti2', function(event) {
            const file = event.target.files[0];
            const previewId = this.id === 'unggah-bukti1' ? '#preview1' : '#preview2';
            const preview = document.querySelector(previewId);

            if (file && preview) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    preview.src = e.target.result;
                    preview.style.display = 'block';
                };
                reader.readAsDataURL(file);
            } else if(preview) {
                preview.style.display = 'none';
            }
        });

        // --- Handle Dropdown Anak -> fetch layanan AJAX (Delegated) ---
        $(document).on('change', '#anak_id', function() {
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
                        window.currentPaketTerbeli = response.paket_terbeli || [];
                        layananSelect.empty().append('<option value="">-- Pilih Layanan --</option>');
                        
                        // Group 1: Assessment Belum Lunas
                        if (response.assessments && response.assessments.length > 0) {
                            var optgroup = $('<optgroup label="Tagihan Assessment">');
                            response.assessments.forEach(function(item) {
                                optgroup.append(`<option value="assessment|${item.id}|0|1">${item.label} - ${item.tujuan}</option>`);
                            });
                            layananSelect.append(optgroup);
                        }
                        
                        // Group 2: Paket Tersedia (Beli Baru)
                        if (response.paket_tersedia && response.paket_tersedia.length > 0) {
                            var optgroup = $('<optgroup label="Pembelian Paket Baru">');
                            response.paket_tersedia.forEach(function(item) {
                                var opt = `<option value="paket_terapi|${item.id}|${item.tarif}|${item.jumlah_pertemuan}">${item.nama}</option>`;
                                optgroup.append(opt);
                            });
                            layananSelect.append(optgroup);
                        }

                        // Group 3: Paket Terbeli (Sisa Sesi)
                        if (response.paket_terbeli && response.paket_terbeli.length > 0) {
                            var optgroup = $('<optgroup label="Sisa Sesi Terbayar">');
                            response.paket_terbeli.forEach(function(item) {
                                var text = `${item.nama} - Sisa ${item.sisa} Sesi`;
                                var opt = `<option value="terbeli|${item.id}|0|${item.sisa}">${text}</option>`;
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

        // --- Ketika Layanan dipilih, update hidden inputs dan jumlah bayar (Delegated) ---
        $(document).on('change', '#layanan_select', function() {
            var selectElement = $(this);
            var val = selectElement.val();
            if (!val) {
                resetPricing();
                return;
            }
            
            var parts = val.split('|');
            var jenis = parts[0];  // assessment, paket_terapi, atau terbeli
            var id = parts[1];
            var tarif = parts[2];
            var sesi = parts[3];

            // Peringatan jika beli paket baru tapi masih ada paket yang aktif
            if (jenis === 'paket_terapi' && window.currentPaketTerbeli && window.currentPaketTerbeli.length > 0) {
                Swal.fire({
                    title: 'Paket Masih Aktif!',
                    html: `Anak ini terpantau masih memiliki sisa paket yang belum habis digunakan.<br><br>Apakah Anda yakin ingin melakukan <b>pembelian paket baru</b> dan menumpuk paket?`,
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#f59e0b', // amber
                    cancelButtonColor: '#f1f5f9',
                    confirmButtonText: 'Ya, Lanjutkan Beli',
                    cancelButtonText: 'Batal',
                    reverseButtons: true,
                    customClass: {
                        popup: 'rounded-[2.5rem] border-none shadow-2xl',
                        confirmButton: 'rounded-xl font-bold uppercase text-[10px] tracking-widest px-8 py-4',
                        cancelButton: 'rounded-xl font-bold uppercase text-[10px] tracking-widest px-8 py-4 text-slate-500'
                    }
                }).then((result) => {
                    if (!result.isConfirmed) {
                        selectElement.val(''); // Reset pilihan
                        resetPricing();
                        return;
                    }
                    prosesPilihLayanan(jenis, id, tarif, sesi);
                });
            } else {
                prosesPilihLayanan(jenis, id, tarif, sesi);
            }
        });

        function prosesPilihLayanan(jenis, id, tarif, sesi) {
            // Update hidden
            $('#hidden_jenis_layanan').val(jenis === 'terbeli' ? 'paket_terapi' : jenis);
            if (jenis === 'assessment') {
                $('#hidden_assessment_id').val(id);
                $('#hidden_tarif_id').val('');
            } else {
                $('#hidden_tarif_id').val(id);
                $('#hidden_assessment_id').val('');
            }
            
            // Setup visual
            if(jenis === 'paket_terapi' || jenis === 'terbeli') {
                $('#info_layanan').removeClass('hidden');
                $('#info_sesi').text(sesi);
            } else {
                $('#info_layanan').addClass('hidden');
            }
            
            // Format rupiah
            if(tarif > 0) {
                let formatted = parseInt(tarif).toString().replace(/\B(?=(\d{3})+(?!\d))/g, '.');
                $('#jumlah').val(formatted).prop('readonly', true);
            } else {
                $('#jumlah').val('').prop('readonly', false);
            }
        }

        function resetPricing() {
            $('#hidden_jenis_layanan, #hidden_assessment_id, #hidden_tarif_id').val('');
            $('#jumlah').val('').prop('readonly', false);
            $('#info_layanan').addClass('hidden');
        }
    });
</script>
