<!DOCTYPE html>
<html lang="id" x-data="{
    page: new URLSearchParams(window.location.search).get('page') || 'home',
    filterTerapi: 'semua',
    searchDate: '',
    searchTherapist: '',
    isLoading: false,
    notificationCount: 3,
    totalSesi: {{ $totalPertemuan }},

    // Data untuk buku penghubung
    sessions: {{ json_encode($sessions) }},

    // Data aktivitas terakhir
    activities: {{ json_encode($activities) }},

    // Statistics
    sesiMingguIni: {{ $sesiMingguIni }},
    progress: '{{ $progress }}',
    tagihanCount: {{ $tagihanCount }},
    formattedActivePackages: {{ json_encode($formattedActivePackages ?? []) }},

    // Attendance
    attendanceStats: {{ json_encode($attendanceStats) }},
    assessments: {{ json_encode($assessments ?? []) }},
    selectedPackageId: {{ $attendanceStats['defaultPackageId'] ?? 'null' }},
    selectedSession: null,
    showSessionDetail: false,
    selectedPackage: null,
    showPackageDetail: false,
    selectedAssessment: null,
    showAssessmentDetail: false,
    showPdfViewer: false,
    pdfViewerUrl: null,
    currentViewDate: new Date(),

    prevMonth() {
        this.currentViewDate = new Date(this.currentViewDate.getFullYear(), this.currentViewDate.getMonth() - 1, 1);
    },

    nextMonth() {
        this.currentViewDate = new Date(this.currentViewDate.getFullYear(), this.currentViewDate.getMonth() + 1, 1);
    },

    getDaysInMonth() {
        const year = this.currentViewDate.getFullYear();
        const month = this.currentViewDate.getMonth();
        const days = new Date(year, month + 1, 0).getDate();
        return Array.from({ length: days }, (_, i) => i + 1);
    },

    getFirstDayOfMonth() {
        const year = this.currentViewDate.getFullYear();
        const month = this.currentViewDate.getMonth();
        let firstDay = new Date(year, month, 1).getDay();
        // Adjust to Monday as first day (Mon=0, Sun=6)
        return firstDay === 0 ? 6 : firstDay - 1;
    },

    getStatusForDate(day) {
        const year = this.currentViewDate.getFullYear();
        const month = (this.currentViewDate.getMonth() + 1).toString().padStart(2, '0');
        const dayStr = day.toString().padStart(2, '0');
        const dateStr = `${year}-${month}-${dayStr}`;
        
        const pkg = this.getSelectedPackage();
        if (!pkg || !pkg.history.length) return 'none';
        
        // Check for existing record
        const record = pkg.history.find(h => h.isoDate === dateStr);
        if (record) return record.rawStatus;
        
        // Sunday is always libur
        const isSunday = new Date(year, this.currentViewDate.getMonth(), day).getDay() === 0;
        if (isSunday) return 'libur';

        // Check if date is between first and last session, and NOT in the future
        const today = new Date().toISOString().split('T')[0];
        const dates = pkg.history.map(h => h.isoDate).sort();
        const minDate = dates[0];
        const maxDate = dates[dates.length - 1];

        // Only mark as libur if it's before or on the latest record, AND before or on today
        if (dateStr > minDate && dateStr < maxDate && dateStr <= today) {
            return 'libur';
        }
        
        return 'none';
    },

    isToday(day) {
        const today = new Date();
        return day === today.getDate() && 
               this.currentViewDate.getMonth() === today.getMonth() && 
               this.currentViewDate.getFullYear() === today.getFullYear();
    },

    // Data psikolog assessment (Keep mockup for now)
    assessmentResults: [
        {
            id: 1,
            date: '25 Jan 2026',
            psychologist: 'Dr. Maya Sari, M.Psi',
            category: 'Kognitif',
            score: 85,
            status: 'Above Average',
            color: 'purple',
            details: 'Kemampuan problem solving menunjukkan perkembangan signifikan'
        },
        {
            id: 2,
            date: '25 Jan 2026',
            psychologist: 'Dr. Maya Sari, M.Psi',
            category: 'Sosial-Emosional',
            score: 78,
            status: 'Average',
            color: 'blue',
            details: 'Mulai menunjukkan empati dan kemampuan berbagi dengan teman'
        },
        {
            id: 3,
            date: '25 Jan 2026',
            psychologist: 'Dr. Maya Sari, M.Psi',
            category: 'Bahasa',
            score: 72,
            status: 'Average',
            color: 'green',
            details: 'Kosakata meningkat 15% dari assessment sebelumnya'
        }
    ],

    // Data observasi dari database
    observations: {{ json_encode($observations ?? []) }},

    // Data terapis
    therapists: {{ json_encode($therapists) }},

    // Data paket terapi
    therapyPackages: {{ json_encode($therapyPackages) }},

    // Data jadwal terapi (Keep mockup for now)
    therapySchedules: [
        {
            id: 1,
            day: 'Senin',
            date: '09 Feb',
            time: '10:00 - 11:00',
            therapist: 'Siti Aminah',
            type: 'Terapi Wicara',
            status: 'Confirmed'
        }
    ],

    // Data tagihan
    invoices: {{ json_encode($invoices) }},

    // Data galeri foto (Keep mockup for now)
    galleryPhotos: [
        {
            id: 1,
            date: '02 Feb 2026',
            activity: 'Terapi Wicara',
            description: 'Ananda belajar fonetik dengan kartu bergambar',
            likes: 12,
            comments: 3
        }
    ],

    // Data buku anak (Keep mockup for now)
    childBook: {
        personalInfo: {
            fullName: '{{ $anak->nama ?? 'Nama Anak' }}',
            nickname: '{{ $anak->nama ?? 'Ananda' }}',
            age: '4 Tahun 2 Bulan',
            birthDate: '15 Desember 2021',
            bloodType: 'O+',
            allergies: 'Susu Sapi, Debu',
            favoriteFood: 'Nasi Goreng, Buah Pisang',
            favoriteActivity: 'Menyusun Puzzle, Bermain Bola',
            sleepPattern: 'Siang: 13:00-15:00\nMalam: 20:00-07:00',
            specialNotes: 'Sensitif terhadap suara keras, suka musik klasik'
        },
        milestones: [
            {
                id: 1,
                milestone: 'Bisa menyusun puzzle 8 keping',
                age: '3 Tahun 10 Bulan',
                date: '15 Des 2024',
                status: 'Achieved'
            }
        ],
        medicalRecords: [
            {
                id: 1,
                date: '20 Jan 2026',
                doctor: 'Dr. Andi Wijaya, Sp.A',
                diagnosis: 'ISPA Ringan',
                treatment: 'Antibiotik, Istirahat',
                notes: 'Demam 2 hari, batuk pilek'
            }
        ],
        dailyRoutine: {
            morning: '07:00 - Bangun tidur\n07:30 - Sarapan\n08:30 - Bermain edukatif',
            therapy: '10:00 - Terapi Wicara\n11:00 - Terapi Sensori',
            afternoon: '12:00 - Makan siang\n13:00 - Tidur siang\n15:00 - Snack sehat\n16:00 - Outdoor play',
            evening: '18:00 - Makan malam\n19:00 - Mandi\n20:00 - Tidur'
        }
    },

    // Data absensi
    attendanceData: {{ json_encode($attendanceData) }},

    // Fungsi untuk navigasi internal (Hard Reload untuk selalu mendapatkan data terbaru)
    nav(target) {
        if (this.page === target) {
            // Jika diklik di halaman yang sama, reload juga
            window.location.reload();
            return;
        }
        window.location.href = window.location.pathname + '?page=' + target;
    },

    // Filter sessions berdasarkan jenis terapi
    filteredSessions() {
        if (this.filterTerapi === 'semua') return this.sessions;
        return this.sessions.filter(session => session.type === this.filterTerapi);
    },

    openSessionDetail(session) {
        this.selectedSession = session;
        this.showSessionDetail = true;
    },

    // Mark notification as read
    markNotificationRead() {
        this.notificationCount = 0;
        this.showToast('Notifikasi dibaca', 'success');
    },

    // Toast notification
    showToast(message, type) {
        const toast = document.createElement('div');
        toast.className = 'fixed top-6 left-1/2 transform -translate-x-1/2 z-50 px-6 py-3 rounded-2xl text-white font-bold text-sm shadow-xl animate-bounce-in ' +
                         (type === 'success' ? 'bg-green-500' : 'bg-indigo-500');
        toast.textContent = message;
        document.body.appendChild(toast);

        setTimeout(() => {
            toast.remove();
        }, 3000);
    },

    // Toggle like pada aktivitas
    toggleLike(index) {
        this.activities[index].liked = !this.activities[index].liked;
        const message = this.activities[index].liked ? 'Disimpan ke favorit!' : 'Dihapus dari favorit';
        this.showToast(message, 'success');
    },

    // Book therapist
    bookTherapist(therapistName) {
        this.showToast('Mengirim permintaan booking ke ' + therapistName, 'success');
    },

    // Select package
    selectPackage(packageName) {
        this.showToast('Memilih ' + packageName, 'success');
    },

    // Pay invoice
    payInvoice(invoiceId) {
        this.showToast('Membayar tagihan ' + invoiceId, 'success');
    },

    // Like photo
    likePhoto(index) {
        this.galleryPhotos[index].likes++;
        this.showToast('Foto disukai!', 'success');
    },

    // Check in
    checkIn() {
        this.showToast('Check in berhasil', 'success');
    },

    // Check out
    checkOut() {
        this.showToast('Check out berhasil', 'success');
    },

    getSelectedPackage() {
        return this.attendanceStats.packages.find(p => p.id === this.selectedPackageId) || this.attendanceStats.packages[0];
    },

    getAttendanceStats() {
        const pkg = this.getSelectedPackage();
        if (!pkg) return { total: 0, present: 0, absent: 0, sakit: 0, hangus: 0, percentage: 0 };
        
        return {
            total: pkg.totalQuota,
            present: pkg.hadir,
            absent: pkg.izin,
            sakit: pkg.sakit,
            hangus: pkg.hangus,
            percentage: pkg.totalQuota > 0 ? Math.round((pkg.hadir / pkg.totalQuota) * 100) : 0
        };
    },

    // Get status color for attendance
    getStatusColor(status) {
        const colors = {
            'Hadir': 'bg-green-100 text-green-700 border-green-200',
            'Sakit': 'bg-purple-100 text-purple-700 border-purple-200',
            'Izin': 'bg-amber-100 text-amber-700 border-amber-200',
            'Hangus': 'bg-red-100 text-red-700 border-red-200',
            'Libur': 'bg-blue-100 text-blue-700 border-blue-200'
        };
        return colors[status] || 'bg-gray-100 text-gray-700 border-gray-200';
    },

    // Get mood icon
    getMoodIcon(mood) {
        const icons = {
            'happy': 'fa-face-smile-beam',
            'excited': 'fa-face-grin-stars',
            'neutral': 'fa-face-meh',
            'sick': 'fa-face-dizzy',
            'sleepy': 'fa-face-sleepy'
        };
        return icons[mood] || 'fa-face-meh';
    }
}" x-init="() => {
    setTimeout(() => {
        document.querySelectorAll('[x-cloak]').forEach(el => {
            el.style.display = 'block';
        });
    }, 100);
}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>Bright Start - {{ $anak->nama ?? 'Dashboard' }}</title>
    
    @include('mobile-new.partials.styles')
</head>

<body class="flex justify-center">
    <div class="w-full max-w-md min-h-screen bg-white shadow-2xl relative pb-32 overflow-x-hidden">
        <!-- Loading Overlay -->
        <div x-show="isLoading" x-transition.opacity
            class="fixed inset-0 bg-white/90 backdrop-blur-sm z-50 flex items-center justify-center">
            <div class="loader"></div>
        </div>

        <!-- Header Section -->
        @include('mobile-new.partials.header')

        <!-- Main Content -->
        <main class="px-6 -mt-10 relative z-20">
            <!-- Home Page -->
            <template x-if="page === 'home'" x-transition:enter="transition ease-out duration-300"
                x-transition:enter-start="opacity-0 translate-y-4">
                @include('mobile-new.sections.dashboard')
            </template>

            <!-- Absensi Page -->
            <template x-if="page === 'absensi'" x-transition>
                @include('mobile-new.sections.absensi')
            </template>

            <!-- Buku Anak Page -->
            <template x-if="page === 'buku_anak'" x-transition>
                @include('mobile-new.sections.buku_penghubung')
            </template>

            <!-- Assessment Psikolog Page -->
            <template x-if="page === 'assessment_psikolog'" x-transition>
                @include('mobile-new.sections.assessment_psikolog')
            </template>

            <!-- Observasi Page -->
            <template x-if="page === 'observasi'" x-transition>
                @include('mobile-new.sections.observasi')
            </template>

            <!-- Daftar Terapis Page -->
            <template x-if="page === 'daftar_terapis'" x-transition>
                @include('mobile-new.sections.daftar_terapis')
            </template>

            <!-- Paket Terapi Page -->
            <template x-if="page === 'paket_terapi'" x-transition>
                @include('mobile-new.sections.paket_terapi')
            </template>

            <!-- Jadwal Terapi Page -->
            <template x-if="page === 'jadwal_terapi'" x-transition>
                @include('mobile-new.sections.jadwal_terapi')
            </template>

            <!-- Tagihan Page -->
            <template x-if="page === 'tagihan'" x-transition>
                @include('mobile-new.sections.tagihan')
            </template>

            <!-- Galeri Page -->
            <template x-if="page === 'galeri'" x-transition>
                @include('mobile-new.sections.galeri')
            </template>

            <!-- Progress Page -->
            <template x-if="page === 'progres'" x-transition>
                @include('mobile-new.sections.progres')
            </template>

            <!-- Profile Page -->
            <template x-if="page === 'profil'" x-transition>
                @include('mobile-new.sections.profil')
            </template>
        </main>

        <!-- Global PDF Viewer -->
        @include('mobile-new.partials.pdf_viewer')

        <!-- Bottom Navigation -->
        @include('mobile-new.partials.navigation')
    </div>

    @include('mobile-new.partials.scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/3.11.174/pdf.min.js"></script>
    <script>
        if (typeof pdfjsLib !== 'undefined') {
            pdfjsLib.GlobalWorkerOptions.workerSrc = 'https://cdnjs.cloudflare.com/ajax/libs/pdf.js/3.11.174/pdf.worker.min.js';
        }
    </script>
</body>
</html>
