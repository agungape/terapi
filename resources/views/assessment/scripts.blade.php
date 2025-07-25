<script>
    // General scripts
    document.addEventListener('DOMContentLoaded', function() {
        // File upload handling
        $('input[type="file"]').on('change', function() {
            let filenames = [];
            let files = this.files;

            for (let i in files) {
                if (files.hasOwnProperty(i)) {
                    filenames.push(files[i].name);
                }
            }

            $(this).next('.custom-file-label').addClass("selected").html(filenames.join(', '));
        });

        // Initialize Select2
        if (typeof $ !== 'undefined') {
            $('.select2').select2({
                theme: 'bootstrap4'
            });

            // Initialize custom file input
            if (typeof bsCustomFileInput !== 'undefined') {
                bsCustomFileInput.init();
            }
        }

        // Tab navigation
        function switchTab(targetTabId) {
            // Deactivate all tabs
            document.querySelectorAll('.tab-pane').forEach(tab => {
                tab.classList.remove('active');
                tab.classList.remove('show');
            });

            // Deactivate all nav links
            document.querySelectorAll('.nav-pills .nav-link').forEach(link => {
                link.classList.remove('active');
            });

            // Activate target tab
            document.getElementById(targetTabId).classList.add('active');
            document.getElementById(targetTabId).classList.add('show');
            document.querySelector(`.nav-pills a[href="#${targetTabId}"]`).classList.add('active');
        }

        // Next/Previous buttons
        document.querySelectorAll('.next-tab, .prev-tab').forEach(button => {
            button.addEventListener('click', function() {
                const targetTabId = this.classList.contains('next-tab') ?
                    this.getAttribute('data-next') :
                    this.getAttribute('data-prev');
                switchTab(targetTabId);
            });
        });

        // Tab links
        document.querySelectorAll('.nav-pills .nav-link').forEach(link => {
            link.addEventListener('click', function(e) {
                e.preventDefault();
                const targetTabId = this.getAttribute('href').substring(1);
                switchTab(targetTabId);
            });
        });
    });
</script>

<script>
    // Behavioral observation scripts
    document.addEventListener('DOMContentLoaded', function() {
        const container = document.getElementById('perilaku-container');
        const addButton = document.getElementById('btn-tambah-perilaku');
        const combinedField = document.getElementById('perilaku_combined');

        function updateRemoveButtons() {
            const fields = container.querySelectorAll('.mb-3');
            fields.forEach((field, index) => {
                const btn = field.querySelector('.btn-remove');
                btn.disabled = index === 0;
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
            const newIndex = container.querySelectorAll('.input-perilaku').length;
            const newField = document.createElement('div');
            newField.className = 'mb-3 position-relative';
            newField.innerHTML = `
                <input type="text" class="form-control input-perilaku"
                    name="perilaku[]" placeholder="Masukkan perilaku khas tambahan">
                <button class="btn btn-sm btn-outline-danger btn-remove position-absolute"
                    style="right: 5px; top: 5px;" type="button">
                    <i class="fas fa-times"></i>
                </button>
            `;
            container.appendChild(newField);
            updateRemoveButtons();
        });

        container.addEventListener('click', function(e) {
            if (e.target.classList.contains('btn-remove') ||
                e.target.parentElement.classList.contains('btn-remove')) {
                const btn = e.target.classList.contains('btn-remove') ?
                    e.target : e.target.parentElement;
                btn.closest('.mb-3').remove();
                updateRemoveButtons();
                updateCombinedField();
            }
        });

        container.addEventListener('input', function(e) {
            if (e.target.classList.contains('input-perilaku')) {
                updateCombinedField();
            }
        });

        // Initialize with existing data if any
        const initialData = `{{ old('perilaku_combined') }}`;
        if (initialData && initialData.trim() !== '') {
            const behaviors = initialData.split('\n\n');

            behaviors.forEach((behavior, index) => {
                if (index > 0) {
                    addButton.click();
                }
                container.querySelectorAll('.input-perilaku')[index].value = behavior;
            });
        }
    });
</script>

<script>
    // Assessment source scripts
    document.addEventListener('DOMContentLoaded', function() {
        const container = document.getElementById('sumber-asesmen-container');
        const addButton = document.getElementById('btn-tambah-sumber');
        const combinedField = document.getElementById('sumber_asesmen_combined');

        function updateRemoveButtons() {
            const fields = container.querySelectorAll('.mb-3');
            fields.forEach((field, index) => {
                const btn = field.querySelector('.btn-remove-sumber');
                btn.disabled = index === 0;
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
            const newIndex = container.querySelectorAll('.input-sumber-asesmen').length;
            const newField = document.createElement('div');
            newField.className = 'mb-3 position-relative';
            newField.innerHTML = `
                <input type="text" class="form-control input-sumber-asesmen"
                    name="sumber_asesmen[]" placeholder="Tambahan sumber asesmen...">
                <button class="btn btn-sm btn-outline-danger btn-remove-sumber position-absolute"
                    style="right: 5px; top: 5px;" type="button">
                    <i class="fas fa-times"></i>
                </button>
            `;
            container.appendChild(newField);
            updateRemoveButtons();
        });

        container.addEventListener('click', function(e) {
            if (e.target.classList.contains('btn-remove-sumber') ||
                e.target.parentElement.classList.contains('btn-remove-sumber')) {
                const btn = e.target.classList.contains('btn-remove-sumber') ?
                    e.target : e.target.parentElement;
                btn.closest('.mb-3').remove();
                updateRemoveButtons();
                updateCombinedField();
            }
        });

        container.addEventListener('input', function(e) {
            if (e.target.classList.contains('input-sumber-asesmen')) {
                updateCombinedField();
            }
        });

        // Initialize with existing data if any
        const initialData = `{{ old('sumber_asesmen_combined') }}`;
        if (initialData && initialData.trim() !== '') {
            const sources = initialData.split('\n\n');

            sources.forEach((source, index) => {
                if (index > 0) {
                    addButton.click();
                }
                container.querySelectorAll('.input-sumber-asesmen')[index].value = source;
            });
        }
    });
</script>

<script>
    // Examination result scripts
    document.addEventListener('DOMContentLoaded', function() {
        const container = document.getElementById('hasil-pemeriksaan-container');
        const addButton = document.getElementById('btn-tambah-hasil');
        const combinedField = document.getElementById('hasil_pemeriksaan_combined');

        function updateRemoveButtons() {
            const fields = container.querySelectorAll('.mb-3');
            fields.forEach((field, index) => {
                const btn = field.querySelector('.btn-remove-hasil');
                btn.disabled = index === 0;
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
            const newIndex = container.querySelectorAll('.input-hasil-pemeriksaan').length;
            const newField = document.createElement('div');
            newField.className = 'mb-3 position-relative';
            newField.innerHTML = `
                <textarea class="form-control input-hasil-pemeriksaan"
                    name="hasil_pemeriksaan[]" rows="2"
                    placeholder="Tambahan analisis hasil pemeriksaan..."></textarea>
                <button class="btn btn-sm btn-outline-danger btn-remove-hasil position-absolute"
                    style="right: 5px; top: 5px;" type="button">
                    <i class="fas fa-times"></i>
                </button>
            `;
            container.appendChild(newField);
            updateRemoveButtons();
        });

        container.addEventListener('click', function(e) {
            if (e.target.classList.contains('btn-remove-hasil') ||
                e.target.parentElement.classList.contains('btn-remove-hasil')) {
                const btn = e.target.classList.contains('btn-remove-hasil') ?
                    e.target : e.target.parentElement;
                btn.closest('.mb-3').remove();
                updateRemoveButtons();
                updateCombinedField();
            }
        });

        container.addEventListener('input', function(e) {
            if (e.target.classList.contains('input-hasil-pemeriksaan')) {
                updateCombinedField();
            }
        });

        // Initialize with existing data if any
        const initialData = `{{ old('hasil_pemeriksaan_combined') }}`;
        if (initialData && initialData.trim() !== '') {
            const analyses = initialData.split('\n\n');

            analyses.forEach((analysis, index) => {
                if (index > 0) {
                    addButton.click();
                }
                container.querySelectorAll('.input-hasil-pemeriksaan')[index].value = analysis;
            });
        }
    });
</script>

<script>
    // Recommendation scripts
    document.addEventListener('DOMContentLoaded', function() {
        function setupRekomendasi(containerId, addButtonId, combinedFieldId) {
            const container = document.getElementById(containerId);
            const addButton = document.getElementById(addButtonId);
            const combinedField = document.getElementById(combinedFieldId);

            function updateRemoveButtons() {
                const fields = container.querySelectorAll('.mb-3');
                fields.forEach((field, index) => {
                    const btn = field.querySelector('.btn-remove-rekomendasi');
                    btn.disabled = index === 0;
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
                newField.className = 'mb-3 position-relative';
                newField.innerHTML = `
                    <textarea class="form-control input-rekomendasi"
                        name="${containerId.replace('-container', '')}[]" rows="2"
                        placeholder="Tambahan rekomendasi..."></textarea>
                    <button class="btn btn-sm btn-outline-danger btn-remove-rekomendasi position-absolute"
                        style="right: 5px; top: 5px;" type="button">
                        <i class="fas fa-times"></i>
                    </button>
                `;
                container.appendChild(newField);
                updateRemoveButtons();
                updateCombinedField();
            });

            container.addEventListener('click', function(e) {
                if (e.target.classList.contains('btn-remove-rekomendasi') ||
                    e.target.parentElement.classList.contains('btn-remove-rekomendasi')) {
                    const btn = e.target.classList.contains('btn-remove-rekomendasi') ?
                        e.target : e.target.parentElement;
                    btn.closest('.mb-3').remove();
                    updateRemoveButtons();
                    updateCombinedField();
                }
            });

            container.addEventListener('input', function(e) {
                if (e.target.classList.contains('input-rekomendasi')) {
                    updateCombinedField();
                }
            });

            // Initialize with existing data if any
            const initialData = containerId.includes('orangtua') ?
                `{{ old('rekomendasi_orangtua_combined') }}` :
                `{{ old('rekomendasi_terapi_combined') }}`;

            if (initialData && initialData.trim() !== '') {
                const recommendations = initialData.split('\n\n');

                recommendations.forEach((rec, index) => {
                    if (index > 0) {
                        addButton.click();
                    }
                    container.querySelectorAll('.input-rekomendasi')[index].value = rec;
                });
            }
        }

        // Setup both recommendation forms
        setupRekomendasi('rekomendasi-orangtua-container', 'btn-tambah-orangtua',
            'rekomendasi_orangtua_combined');
        setupRekomendasi('rekomendasi-terapi-container', 'btn-tambah-terapi', 'rekomendasi_terapi_combined');
    });
</script>

<script>
    // Approval scripts
    document.addEventListener('DOMContentLoaded', function() {
        const radioYa = document.getElementById('persetujuan_ya');
        const radioTidak = document.getElementById('persetujuan_tidak');
        const alasanGroup = document.getElementById('alasan-tidak-setuju-group');

        function toggleAlasanField() {
            if (radioTidak.checked) {
                alasanGroup.style.display = 'block';
                document.getElementById('alasan_tidak_setuju').required = true;
            } else {
                alasanGroup.style.display = 'none';
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
    });
</script>
