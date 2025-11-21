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

    <script>
        document.addEventListener('DOMContentLoaded', function() {
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
                // Cari nilai maksimum dari data
                const maxDataValue = Math.max(...data);
                // Tambahkan margin 20% dari nilai maksimum untuk tampilan yang lebih baik
                const maxYValue = maxDataValue * 1.2;

                return new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: monthNames,
                        datasets: [{
                            label: label,
                            data: data,
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
                                max: maxYValue, // Nilai maksimum menyesuaikan data
                                ticks: {
                                    stepSize: calculateStepSize(
                                        maxYValue), // Fungsi untuk menghitung step size
                                    callback: function(value) {
                                        return value.toLocaleString();
                                    }
                                }
                            }
                        }
                    }
                });
            }

            // Fungsi untuk menghitung step size yang sesuai
            function calculateStepSize(maxValue) {
                if (maxValue <= 1000000) return 200000; // Untuk nilai kecil
                if (maxValue <= 5000000) return 500000;
                if (maxValue <= 10000000) return 1000000;
                if (maxValue <= 50000000) return 5000000;
                return 10000000; // Untuk nilai sangat besar
            }

            // Buat chart pemasukan
            const pemasukanCtx = document.getElementById('pemasukanChart').getContext('2d');
            let pemasukanChart = createChart(
                pemasukanCtx,
                'Pemasukan',
                pemasukanData.map(item => item.total),
                'rgba(40, 167, 69, 0.5)',
                'rgba(40, 167, 69, 1)'
            );

            // Buat chart pengeluaran
            const pengeluaranCtx = document.getElementById('pengeluaranChart').getContext('2d');
            let pengeluaranChart = createChart(
                pengeluaranCtx,
                'Pengeluaran',
                pengeluaranData.map(item => item.total),
                'rgba(255, 99, 132, 0.5)',
                'rgba(255, 99, 132, 1)'
            );

            function fillMissingMonths(data) {
                const filledData = Array.from({
                    length: 12
                }, (_, index) => ({
                    month: index + 1,
                    total: 0
                }));

                data.forEach(item => {
                    filledData[item.month - 1] = item; // Ganti bulan yang ada dengan data sebenarnya
                });

                return filledData;
            }

            // Event filter tahun pemasukan
            $('#yearFilter_pemasukkan').on('change', function() {
                const selectedYear = $(this).val();

                // AJAX request untuk mendapatkan data pemasukan
                $.ajax({
                    url: '{{ url('/rekap-kas') }}',
                    method: 'GET',
                    data: {
                        year: selectedYear
                    },
                    success: function(response) {
                        const newData = fillMissingMonths(response.incomeData);

                        // Update chart pemasukan
                        pemasukanChart.data.labels = monthNames;
                        pemasukanChart.data.datasets[0].data = newData.map(item => item.total);
                        pemasukanChart.update();
                    }
                });
            });

            // Event filter tahun pengeluaran
            $('#yearFilter_pengeluaran').on('change', function() {
                const selectedYear = $(this).val();

                // AJAX request untuk mendapatkan data pengeluaran
                $.ajax({
                    url: '{{ url('/rekap-kas') }}',
                    method: 'GET',
                    data: {
                        year: selectedYear
                    },
                    success: function(response) {
                        const newData = fillMissingMonths(response.expenseData);

                        // Update chart pengeluaran
                        pengeluaranChart.data.labels = monthNames;
                        pengeluaranChart.data.datasets[0].data = newData.map(item => item
                            .total);
                        pengeluaranChart.update();
                    }
                });
            });
        });
    </script>


    {{-- script rekapkas --}}
@endsection
