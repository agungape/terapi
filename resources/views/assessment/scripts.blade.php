<script>
    // General scripts & Data Fetching
    $(document).ready(function() {
        // Init Icons
        if (typeof lucide !== 'undefined') {
            lucide.createIcons();
        }

        // Fetch Riwayat Wawancara (Anamnesa) from Observasi Module
        $('#nama_anak').on('change', function() {
            let anakId = $(this).val();
            let container = $('#wawancara-container');
            
            if (!anakId) {
                container.html('<div class="text-center text-slate-400 flex flex-col items-center justify-center h-full"><i data-lucide="info" class="w-6 h-6 mb-2 text-slate-300"></i>Pilih nama anak terlebih dahulu.</div>');
                if (typeof lucide !== 'undefined') lucide.createIcons();
                return;
            }

            container.html('<div class="text-center text-blue-500 flex flex-col items-center justify-center h-full"><i data-lucide="loader-2" class="w-6 h-6 mb-2 animate-spin"></i>Sedang menarik data riwayat klinis...</div>');
            if (typeof lucide !== 'undefined') lucide.createIcons();

            const baseUrl = window.location.origin + window.location.pathname.split('/assessment')[0];
            fetch(`${baseUrl}/history-wawancara/${anakId}`)
                .then(response => {
                    if (!response.ok) {
                        return response.text().then(text => { throw new Error(text) });
                    }
                    return response.json();
                })
                .then(data => {
                    if (data.error) {
                        throw new Error(data.message);
                    }
                    if (data.length === 0) {
                        container.html('<div class="text-amber-500 flex items-center gap-2 text-xs"><i data-lucide="alert-triangle" class="w-4 h-4"></i> Belum ada riwayat wawancara klinis.</div>');
                        if (typeof lucide !== 'undefined') lucide.createIcons();
                        return;
                    }

                    let html = '<div class="space-y-4 pr-2">';
                    
                    data.forEach((item, index) => {
                        let answer = item.answer ? item.answer.trim() : '';
                        
                        if (answer && answer !== '-' && answer !== '') {
                            let question = item.question_wawancara ? item.question_wawancara.question_text : 'Poin Riwayat';
                            
                            html += `
                                <div class="bg-white p-3 rounded-xl border border-slate-100 shadow-sm">
                                    <h6 class="text-xs font-bold text-slate-700 mb-1">${question}</h6>
                                    <div class="text-slate-500 text-[11px]">${answer}</div>
                                </div>
                            `;
                        }
                    });
                    
                    html += '</div>';
                    container.html(html);
                })
                .catch(error => {
                    container.html(`<div class="text-red-500 text-xs"><i data-lucide="x-circle" class="w-4 h-4 inline mr-1"></i> Gagal: ${error.message}</div>`);
                    if (typeof lucide !== 'undefined') lucide.createIcons();
                    console.error('AJAX Error:', error);
                });
        });

        if ($('#nama_anak').val()) {
            $('#nama_anak').trigger('change');
        }

        // Initialize Select2
        if (typeof $ !== 'undefined') {
            $('.select2').select2({
                theme: 'bootstrap4'
            });
        }

        // Modal handling or other scripts can go here

        // Generic Items Handler (Add/Remove) for Rujukan & Prioritas
        $(document).on('click', '.add-item', function() {
            const targetId = $(this).data('target');
            const container = $(targetId);
            const placeholder = container.find('input').first().attr('placeholder') || 'Tambahkan item...';
            
            const newItem = `
                <div class="input-group mb-2 relative flex items-center">
                    <input type="text" class="form-control w-full border border-slate-200 rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-amber-100 focus:border-amber-500 pr-12" placeholder="${placeholder}">
                    <button class="remove-item absolute right-2 w-8 h-8 flex items-center justify-center bg-red-50 text-red-500 rounded-lg hover:bg-red-500 hover:text-white" type="button">
                        <i data-lucide="x" class="w-4 h-4"></i>
                    </button>
                </div>`;
            container.append(newItem);
            if (typeof lucide !== 'undefined') lucide.createIcons();
        });

        $(document).on('click', '.remove-item', function() {
            $(this).closest('div.relative').remove();
        });

        // Form Submit Handler for all Combined Fields
        $('form').on('submit', function(e) {
            function syncContainer(containerId, hiddenFieldId) {
                const items = [];
                $(`${containerId} input`).each(function() {
                    const val = $(this).val().trim();
                    if (val) items.push(val);
                });
                $(`${hiddenFieldId}`).val(items.join('\n\n'));
            }

            syncContainer('#rujukan_container', '#saran_rujukan_combined');
            syncContainer('#prioritas_container', '#prioritas_terapi_combined');
        });

        // Other handlers
    });
</script>

<script>
    // Behavioral observation scripts
    $(document).ready(function() {
        const container = document.getElementById('perilaku-container');
        const addButton = document.getElementById('btn-tambah-perilaku');
        const combinedField = document.getElementById('perilaku_combined');

        if(container && addButton && combinedField){
            function updateRemoveButtons() {
                const fields = container.querySelectorAll('.relative');
                fields.forEach((field, index) => {
                    const btn = field.querySelector('.btn-remove');
                    if(btn) btn.disabled = index === 0;
                });
            }

            function updateCombinedField() {
                const inputs = container.querySelectorAll('.input-perilaku');
                const combinedText = Array.from(inputs)
                    .map(input => input.value.trim())
                    .filter(text => text !== '')
                    .join('\n\n');
                combinedField.value = combinedText;
            }

            addButton.addEventListener('click', function() {
                const newField = document.createElement('div');
                newField.className = 'relative mb-3 flex items-center';
                newField.innerHTML = `
                    <input type="text" class="form-control input-perilaku w-full border border-slate-200 rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-amber-100 focus:border-amber-500 pr-12"
                        name="perilaku[]" placeholder="Masukkan perilaku khas tambahan">
                    <button class="btn-remove absolute right-2 w-8 h-8 flex items-center justify-center bg-red-50 text-red-500 rounded-lg hover:bg-red-500 hover:text-white transition-colors" type="button">
                        <i data-lucide="x" class="w-4 h-4"></i>
                    </button>
                `;
                container.appendChild(newField);
                if (typeof lucide !== 'undefined') lucide.createIcons();
                updateRemoveButtons();
            });

            container.addEventListener('click', function(e) {
                const btn = e.target.closest('.btn-remove');
                if (btn) {
                    btn.closest('.relative').remove();
                    updateRemoveButtons();
                    updateCombinedField();
                }
            });

            container.addEventListener('input', function(e) {
                if (e.target.classList.contains('input-perilaku')) {
                    updateCombinedField();
                }
            });
        }
    });
</script>

<script>
    // Assessment source scripts
    $(document).ready(function() {
        const container = document.getElementById('sumber-asesmen-container');
        const addButton = document.getElementById('btn-tambah-sumber');
        const combinedField = document.getElementById('sumber_asesmen_combined');

        if(container && addButton && combinedField){
            function updateRemoveButtons() {
                const fields = container.querySelectorAll('.relative');
                fields.forEach((field, index) => {
                    const btn = field.querySelector('.btn-remove-sumber');
                    if(btn) btn.disabled = index === 0;
                });
            }

            function updateCombinedField() {
                const inputs = container.querySelectorAll('.input-sumber-asesmen');
                const combinedText = Array.from(inputs)
                    .map(input => input.value.trim())
                    .filter(text => text !== '')
                    .join('\n\n');
                combinedField.value = combinedText;
            }

            addButton.addEventListener('click', function() {
                const newField = document.createElement('div');
                newField.className = 'relative mb-3 flex items-center';
                newField.innerHTML = `
                    <input type="text" class="form-control input-sumber-asesmen w-full border border-slate-200 rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-amber-100 focus:border-amber-500 pr-12"
                        name="sumber_asesmen[]" placeholder="Tambahan sumber asesmen...">
                    <button class="btn-remove-sumber absolute right-2 w-8 h-8 flex items-center justify-center bg-red-50 text-red-500 rounded-lg hover:bg-red-500 hover:text-white transition-colors" type="button">
                        <i data-lucide="x" class="w-4 h-4"></i>
                    </button>
                `;
                container.appendChild(newField);
                if (typeof lucide !== 'undefined') lucide.createIcons();
                updateRemoveButtons();
            });

            container.addEventListener('click', function(e) {
                const btn = e.target.closest('.btn-remove-sumber');
                if (btn) {
                    btn.closest('.relative').remove();
                    updateRemoveButtons();
                    updateCombinedField();
                }
            });

            container.addEventListener('input', function(e) {
                if (e.target.classList.contains('input-sumber-asesmen')) {
                    updateCombinedField();
                }
            });
        }
    });
</script>

<script>
    // Examination result scripts
    $(document).ready(function() {
        const container = document.getElementById('hasil-pemeriksaan-container');
        const addButton = document.getElementById('btn-tambah-hasil');
        const combinedField = document.getElementById('hasil_pemeriksaan_combined');

        if(container && addButton && combinedField){
            function updateRemoveButtons() {
                const fields = container.querySelectorAll('.relative');
                fields.forEach((field, index) => {
                    const btn = field.querySelector('.btn-remove-hasil');
                    if(btn) btn.disabled = index === 0;
                });
            }

            function updateCombinedField() {
                const textareas = container.querySelectorAll('.input-hasil-pemeriksaan');
                const combinedText = Array.from(textareas)
                    .map(ta => ta.value.trim())
                    .filter(text => text !== '')
                    .join('\n\n');
                combinedField.value = combinedText;
            }

            addButton.addEventListener('click', function() {
                const newField = document.createElement('div');
                newField.className = 'relative mb-3 flex items-start';
                newField.innerHTML = `
                    <textarea class="form-control input-hasil-pemeriksaan w-full border border-slate-200 rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-amber-100 focus:border-amber-500 pr-12"
                        name="hasil_pemeriksaan[]" rows="2"
                        placeholder="Tambahan analisis hasil pemeriksaan..."></textarea>
                    <button class="btn-remove-hasil absolute right-2 top-2 w-8 h-8 flex items-center justify-center bg-red-50 text-red-500 rounded-lg hover:bg-red-500 hover:text-white transition-colors" type="button">
                        <i data-lucide="x" class="w-4 h-4"></i>
                    </button>
                `;
                container.appendChild(newField);
                if (typeof lucide !== 'undefined') lucide.createIcons();
                updateRemoveButtons();
            });

            container.addEventListener('click', function(e) {
                const btn = e.target.closest('.btn-remove-hasil');
                if (btn) {
                    btn.closest('.relative').remove();
                    updateRemoveButtons();
                    updateCombinedField();
                }
            });

            container.addEventListener('input', function(e) {
                if (e.target.classList.contains('input-hasil-pemeriksaan')) {
                    updateCombinedField();
                }
            });
        }
    });
</script>

<script>
    // Recommendation scripts
    $(document).ready(function() {
        function setupRekomendasi(containerId, addButtonId, combinedFieldId) {
            const container = document.getElementById(containerId);
            const addButton = document.getElementById(addButtonId);
            const combinedField = document.getElementById(combinedFieldId);

            if(container && addButton && combinedField){
                function updateRemoveButtons() {
                    const fields = container.querySelectorAll('.relative');
                    fields.forEach((field, index) => {
                        const btn = field.querySelector('.btn-remove-rekomendasi');
                        if(btn) btn.disabled = index === 0;
                    });
                }

                function updateCombinedField() {
                    const textareas = container.querySelectorAll('.input-rekomendasi');
                    const combinedText = Array.from(textareas)
                        .map(ta => ta.value.trim())
                        .filter(text => text !== '')
                        .join('\n\n');
                    combinedField.value = combinedText;
                }

                addButton.addEventListener('click', function() {
                    const newField = document.createElement('div');
                    newField.className = 'relative mb-3 flex items-start';
                    newField.innerHTML = `
                        <textarea class="form-control input-rekomendasi w-full border border-slate-200 rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-amber-100 focus:border-amber-500 pr-12"
                            name="${containerId.replace('-container', '')}[]" rows="2"
                            placeholder="Tambahan rekomendasi..."></textarea>
                        <button class="btn-remove-rekomendasi absolute right-2 top-2 w-8 h-8 flex items-center justify-center bg-red-50 text-red-500 rounded-lg hover:bg-red-500 hover:text-white transition-colors" type="button">
                            <i data-lucide="x" class="w-4 h-4"></i>
                        </button>
                    `;
                    container.appendChild(newField);
                    if (typeof lucide !== 'undefined') lucide.createIcons();
                    updateRemoveButtons();
                    updateCombinedField();
                });

                container.addEventListener('click', function(e) {
                    const btn = e.target.closest('.btn-remove-rekomendasi');
                    if(btn){
                        btn.closest('.relative').remove();
                        updateRemoveButtons();
                        updateCombinedField();
                    }
                });

                container.addEventListener('input', function(e) {
                    if (e.target.classList.contains('input-rekomendasi')) {
                        updateCombinedField();
                    }
                });
            }
        }

        // Setup both recommendation forms
        setupRekomendasi('rekomendasi-orangtua-container', 'btn-tambah-orangtua', 'rekomendasi_orangtua_combined');
        setupRekomendasi('rekomendasi-terapi-container', 'btn-tambah-terapi', 'rekomendasi_terapi_combined');
    });
</script>

<script>
    // Approval scripts
    $(document).ready(function() {
        const radioYa = document.getElementById('persetujuan_ya');
        const radioTidak = document.getElementById('persetujuan_tidak');
        const alasanGroup = document.getElementById('alasan-tidak-setuju-group');

        if(radioYa && radioTidak && alasanGroup){
            function toggleAlasanField() {
                if (radioTidak.checked) {
                    $('#alasan-tidak-setuju-group').slideDown(300);
                    document.getElementById('alasan_tidak_setuju').required = true;
                } else {
                    $('#alasan-tidak-setuju-group').slideUp(300);
                    document.getElementById('alasan_tidak_setuju').required = false;
                }
            }

            radioYa.addEventListener('change', toggleAlasanField);
            radioTidak.addEventListener('change', toggleAlasanField);

            document.querySelector('form').addEventListener('submit', function(e) {
                if (!radioYa.checked && !radioTidak.checked) {
                    e.preventDefault();
                    alert('Silakan pilih persetujuan terlebih dahulu');
                }
            });
            
            // Re-trigger on init to fix refresh states
            if(radioTidak.checked){
                $('#alasan-tidak-setuju-group').show();
            }
        }
    });
</script>

<script>
    // Alat Ukur Table Handler
    $(document).ready(function() {
        const body = document.getElementById('alat-ukur-body');
        const btnAdd = document.getElementById('btn-tambah-alat');
        let rowCount = body.querySelectorAll('tr').length;

        function updateRemoveButtons() {
            const rows = body.querySelectorAll('tr');
            rows.forEach((row, index) => {
                const btn = row.querySelector('.btn-remove-alat');
                if(btn) btn.disabled = rows.length === 1;
            });
        }

        if(btnAdd && body) {
            btnAdd.addEventListener('click', function() {
                const newRow = document.createElement('tr');
                newRow.className = 'alat-ukur-row group hover:bg-slate-50 transition-colors';
                
                // Build options from the first row's select if available
                const firstSelect = body.querySelector('select');
                let optionsHtml = '<option value="">-- Pilih Alat Ukur --</option>';
                if (firstSelect) {
                    optionsHtml = firstSelect.innerHTML;
                }

                newRow.innerHTML = `
                    <td class="px-2 py-3">
                        <select name="alat_ukur[${rowCount}][nama]" class="form-control w-full bg-transparent border-none px-2 py-1 text-xs font-bold focus:ring-0 appearance-none">
                            ${optionsHtml}
                        </select>
                    </td>
                    <td class="px-2 py-3">
                        <input type="text" name="alat_ukur[${rowCount}][skor_raw]" class="form-control w-full bg-transparent border-none px-2 py-1 text-xs focus:ring-0">
                    </td>
                    <td class="px-2 py-3">
                        <input type="text" name="alat_ukur[${rowCount}][skor_standar]" class="form-control w-full bg-transparent border-none px-2 py-1 text-xs focus:ring-0">
                    </td>
                    <td class="px-2 py-3">
                        <input type="text" name="alat_ukur[${rowCount}][persentil]" class="form-control w-full bg-transparent border-none px-2 py-1 text-xs focus:ring-0">
                    </td>
                    <td class="px-2 py-3">
                        <input type="text" name="alat_ukur[${rowCount}][klasifikasi]" class="form-control w-full bg-transparent border-none px-2 py-1 text-xs focus:ring-0" placeholder="...">
                    </td>
                    <td class="px-2 py-3">
                        <input type="text" name="alat_ukur[${rowCount}][catatan]" class="form-control w-full bg-transparent border-none px-2 py-1 text-xs focus:ring-0" placeholder="...">
                    </td>
                    <td class="px-2 py-3 text-center">
                        <button type="button" class="btn-remove-alat p-1.5 text-slate-300 hover:text-red-500 opacity-0 group-hover:opacity-100 transition-all font-black">
                            <i data-lucide="trash-2" class="w-4 h-4"></i>
                        </button>
                    </td>
                `;
                body.appendChild(newRow);
                rowCount++;
                if (typeof lucide !== 'undefined') lucide.createIcons();
                updateRemoveButtons();
            });

            body.addEventListener('click', function(e) {
                const btn = e.target.closest('.btn-remove-alat');
                if (btn && !btn.disabled) {
                    btn.closest('tr').remove();
                    updateRemoveButtons();
                }
            });
        }
    });
</script>
