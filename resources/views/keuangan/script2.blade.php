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
    {{-- <script>
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
    </script> --}}
    <script>
        // Data awal dari server
        const pemasukanData = @json($data_pemasukkan);
        const pengeluaranData = @json($data_pengeluaran);

        // Array nama bulan
        const monthNames = [
            "Januari", "Februari", "Maret", "April", "Mei", "Juni",
            "Juli", "Agustus", "September", "Oktober", "November", "Desember"
        ];

        // Fungsi untuk membuat chart
        function createChart(ctx, label, data, bgColor, borderColor) {
            return new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: data.map(item => monthNames[item.month - 1]),
                    datasets: [{
                        label: label,
                        data: data.map(item => item.total),
                        backgroundColor: bgColor,
                        borderColor: borderColor,
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
                            min: 0,
                            max: 10000000 // Batas atas skala Y
                        }
                    }
                }
            });
        }

        // Buat chart pemasukan
        const pemasukanCtx = document.getElementById('pemasukanChart').getContext('2d');
        let pemasukanChart = createChart(
            pemasukanCtx,
            'Pemasukan',
            pemasukanData,
            'rgba(40, 167, 69, 0.5)',
            'rgba(40, 167, 69, 1)'
        );

        // Buat chart pengeluaran
        const pengeluaranCtx = document.getElementById('pengeluaranChart').getContext('2d');
        let pengeluaranChart = createChart(
            pengeluaranCtx,
            'Pengeluaran',
            pengeluaranData,
            'rgba(255, 99, 132, 0.5)',
            'rgba(255, 99, 132, 1)'
        );

        $('#yearFilter_pemasukkan').on('change', function() {
            const selectedYear = $(this).val();

            // Lakukan AJAX request untuk pemasukan
            $.ajax({
                url: '{{ url('/rekap-kas') }}',
                method: 'GET',
                data: {
                    year: selectedYear
                },
                success: function(response) {
                    const newData = response.incomeData;

                    // Update chart pemasukan
                    pemasukanChart.data.labels = newData.map(item => monthNames[item.month - 1]);
                    pemasukanChart.data.datasets[0].data = newData.map(item => item.total);
                    pemasukanChart.update();
                }
            });
        });

        // Event listener untuk filter tahun pengeluaran
        $('#yearFilter_pengeluaran').on('change', function() {
            const selectedYear = $(this).val();

            // Lakukan AJAX request untuk pengeluaran
            $.ajax({
                url: '{{ url('/rekap-kas') }}',
                method: 'GET',
                data: {
                    year: selectedYear
                },
                success: function(response) {
                    const newData = response.expenseData;

                    // Update chart pengeluaran
                    pengeluaranChart.data.labels = newData.map(item => monthNames[item.month - 1]);
                    pengeluaranChart.data.datasets[0].data = newData.map(item => item.total);
                    pengeluaranChart.update();
                }
            });
        });
    </script>
    {{-- script rekapkas --}}
@endsection
