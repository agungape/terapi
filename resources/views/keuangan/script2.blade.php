@section('scripts')
    <script type="text/javascript">
        $(function() {
            $('#data-tables').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{ route('pemasukkan.json') }}',
                pageLength: 5,
                lengthMenu: [5, 10, 25, 50],
                // lengthChange: false,
                responsive: true,
                buttons: ["copy", "csv", "excel", "pdf", "print", "colvis"],
                columns: [{
                        data: null, // Data null karena tidak berasal dari database
                        name: 'no',
                        render: function(data, type, row, meta) {
                            return meta.row + meta.settings._iDisplayStart + 1;
                        },
                        orderable: false, // Tidak dapat diurutkan
                        searchable: false // Tidak dapat dicari
                    },
                    {
                        data: 'deskripsi',
                        name: 'deskripsi'
                    },
                    {
                        data: 'kategori_nama',
                        name: 'kategori_nama'
                    },
                    {
                        data: 'jumlah',
                        name: 'jumlah'
                    },
                    {
                        data: 'tanggal',
                        name: 'tanggal'
                    }

                ]
            }).buttons().container().appendTo('#data-tables_wrapper .col-md-6:eq(0)');
        });
    </script>

    <script type="text/javascript">
        $(function() {
            $('#data-tables2').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{ route('pengeluaran.json') }}',
                pageLength: 5,
                lengthMenu: [5, 10, 25, 50],
                // lengthChange: false,
                responsive: true,
                buttons: ["copy", "csv", "excel", "pdf", "print", "colvis"],
                columns: [{
                        data: null, // Data null karena tidak berasal dari database
                        name: 'no',
                        render: function(data, type, row, meta) {
                            return meta.row + meta.settings._iDisplayStart + 1;
                        },
                        orderable: false, // Tidak dapat diurutkan
                        searchable: false // Tidak dapat dicari
                    },
                    {
                        data: 'deskripsi',
                        name: 'deskripsi'
                    },
                    {
                        data: 'kategori_nama',
                        name: 'kategori_nama'
                    },
                    {
                        data: 'jumlah',
                        name: 'jumlah'
                    },
                    {
                        data: 'tanggal',
                        name: 'tanggal'
                    }

                ]
            }).buttons().container().appendTo('#data-tables_wrapper .col-md-6:eq(0)');
        });
    </script>

    {{-- script rekapkas --}}
    <script>
        // Ambil data dari server (PHP)
        const chartData = @json($data);

        // Array nama bulan
        const monthNames = [
            "Januari", "Februari", "Maret", "April", "Mei", "Juni",
            "Juli", "Agustus", "September", "Oktober", "November", "Desember"
        ];

        // Format data untuk Chart.js
        const labels = chartData.map(data => monthNames[data.month - 1]);
        const dataSet = chartData.map(data => data.total);

        // Menentukan rentang skala tetap pada sumbu Y
        const minY = 0; // Batas bawah
        const maxY = 10000000; // Batas atas, sesuaikan dengan rentang nilai yang diinginkan

        // Buat chart
        const ctx = document.getElementById('pemasukanChart').getContext('2d');
        let pemasukanChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Pemasukan',
                    data: dataSet,
                    backgroundColor: 'rgba(40, 167, 69, 0.5)',
                    borderColor: 'rgba(40, 167, 69, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top',
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        min: minY, // Tetapkan batas bawah skala Y
                        max: maxY, // Tetapkan batas atas skala Y
                    }
                }
            }
        });

        // Event listener untuk perubahan tahun
        $('#yearFilter').on('change', function() {
            const selectedYear = $(this).val();

            // Lakukan AJAX request ke server untuk mendapatkan data berdasarkan tahun
            $.ajax({
                url: '{{ url('/rekap-kas') }}',
                method: 'GET',
                data: {
                    year: selectedYear
                },
                success: function(response) {
                    const newChartData = response.chartData;

                    // Format data baru

                    const newLabels = newChartData.map(data => monthNames[data.month - 1]);
                    const newDataSet = newChartData.map(data => data.total);

                    // Update chart dengan data baru
                    pemasukanChart.data.labels = newLabels;
                    pemasukanChart.data.datasets[0].data = newDataSet;
                    pemasukanChart.update();
                }
            });
        });
    </script>
    {{-- script rekapkas --}}
@endsection
