@extends('mobile.master')
@section('mobileTerapi', 'active')

@section('style')
<style>
    @keyframes slide-up {
        0% { transform: translateY(20px); opacity: 0; }
        100% { transform: translateY(0); opacity: 1; }
    }
    @keyframes wiggle {
        0%, 100% { transform: rotate(-3deg); }
        50% { transform: rotate(3deg); }
    }
    @keyframes float {
        0%, 100% { transform: translateY(0); }
        50% { transform: translateY(-5px); }
    }
    @keyframes pop {
        0% { transform: scale(0.9); }
        50% { transform: scale(1.1); }
        100% { transform: scale(1); }
    }
    .animate-slide-up { animation: slide-up 0.5s ease-out forwards; }
    .animate-wiggle { animation: wiggle 0.5s ease-in-out infinite; }
    .animate-float { animation: float 2s ease-in-out infinite; }
    .animate-pop { animation: pop 0.3s ease-out forwards; }
    
    .loader-cute {
        border: 4px solid #f3f3f3;
        border-top: 4px solid #9333ea; /* purple-600 */
        border-radius: 50%;
        width: 40px;
        height: 40px;
        animation: spin 1s linear infinite;
    }
    @keyframes spin {
        0% { transform: rotate(0deg); }
        100% { transform: rotate(360deg); }
    }
</style>
@endsection

@section('content')
@php
    $totalHadir = 0;
    $totalIzin = 0;
    $totalSakit = 0;
    $totalHangus = 0;
    
    $perilakuStats = ['total' => 0, 'hadir' => 0, 'izin' => 0, 'sakit' => 0, 'izin_hangus' => 0];
    $fisioStats = ['total' => 0, 'hadir' => 0, 'izin' => 0, 'sakit' => 0, 'izin_hangus' => 0];
    
    $attendanceData = [];
    
    foreach ($groupedBySesi as $sesi => $pertemuan) {
        foreach ($pertemuan as $k) {
            $status = $k->status;
            $perilakuStats['total']++;
            if ($status == 'hadir') $perilakuStats['hadir']++;
            elseif ($status == 'izin') $perilakuStats['izin']++;
            elseif ($status == 'sakit') $perilakuStats['sakit']++;
            elseif ($status == 'izin_hangus') $perilakuStats['izin_hangus']++;
            
            $attendanceData[] = [
                'id' => $k->id,
                'date' => $k->created_at->translatedFormat('d F Y'),
                'day_short' => $k->created_at->translatedFormat('D'),
                'date_number' => $k->created_at->format('j'),
                'timestamp' => $k->created_at->timestamp,
                'type' => 'Terapi Perilaku',
                'therapist' => $k->terapis->nama ?? '-',
                'status' => $status == 'hadir' ? 'Hadir' : ($status == 'izin' ? 'Izin' : ($status == 'sakit' ? 'Sakit' : 'Hangus')),
                'status_original' => $status,
                'pertemuan_ke' => $k->pertemuan,
                'sesi' => $k->sesi,
                'mood' => 'happy',
                'timeIn' => $k->jam_masuk ?? '-',
                'timeOut' => $k->jam_pulang ?? '-',
                'catatan' => $k->catatan ?? null
            ];
        }
    }
    
    foreach ($groupedBySesi_fisio as $sesi => $pertemuan) {
        foreach ($pertemuan as $k) {
            $status = $k->status;
            $fisioStats['total']++;
            if ($status == 'hadir') $fisioStats['hadir']++;
            elseif ($status == 'izin') $fisioStats['izin']++;
            elseif ($status == 'sakit') $fisioStats['sakit']++;
            elseif ($status == 'izin_hangus') $fisioStats['izin_hangus']++;
            
            $attendanceData[] = [
                'id' => $k->id,
                'date' => $k->created_at->translatedFormat('d F Y'),
                'day_short' => $k->created_at->translatedFormat('D'),
                'date_number' => $k->created_at->format('j'),
                'timestamp' => $k->created_at->timestamp,
                'type' => 'Fisioterapi',
                'therapist' => $k->terapis->nama ?? '-',
                'status' => $status == 'hadir' ? 'Hadir' : ($status == 'izin' ? 'Izin' : ($status == 'sakit' ? 'Sakit' : 'Hangus')),
                'status_original' => $status,
                'pertemuan_ke' => $k->pertemuan,
                'sesi' => $k->sesi,
                'mood' => 'happy',
                'timeIn' => $k->jam_masuk ?? '-',
                'timeOut' => $k->jam_pulang ?? '-',
                'catatan' => $k->catatan ?? null
            ];
        }
    }
    
    $totalKehadiran = [
        'total' => $perilakuStats['total'] + $fisioStats['total'],
        'hadir' => $perilakuStats['hadir'] + $fisioStats['hadir'],
        'izin' => $perilakuStats['izin'] + $fisioStats['izin'],
        'sakit' => $perilakuStats['sakit'] + $fisioStats['sakit'],
        'izin_hangus' => $perilakuStats['izin_hangus'] + $fisioStats['izin_hangus'],
    ];
    
    $attendanceStats = [
        'terapi_perilaku' => array_merge($perilakuStats, ['percentage' => $perilakuStats['total'] > 0 ? round(($perilakuStats['hadir'] / $perilakuStats['total']) * 100) : 0]),
        'fisioterapi' => array_merge($fisioStats, ['percentage' => $fisioStats['total'] > 0 ? round(($fisioStats['hadir'] / $fisioStats['total']) * 100) : 0]),
    ];
    
    $bulanIni = now()->translatedFormat('F Y');
    $hariInBulan = now()->daysInMonth;
@endphp

<!-- Container for Desktop centering -->
<div class="max-w-lg mx-auto bg-white min-h-screen shadow-xl sm:rounded-3xl overflow-hidden mb-20">
    
    <!-- Header -->
    <div class="bg-white border-b border-slate-100 px-4 py-3 flex items-center justify-between sticky top-0 z-30">
        <button @click="sidebarOpen = true" class="w-10 h-10 rounded-xl bg-slate-50 flex items-center justify-center text-slate-600 hover:bg-slate-100 transition-colors">
            <i data-lucide="menu" class="w-5 h-5"></i>
        </button>
        <span class="font-bold text-slate-800">Presensi Terapi</span>
        <div class="w-10"></div> <!-- Spacer -->
    </div>

    <div class="p-4 space-y-4 md:space-y-6" x-data="attendanceDashboard()">
        
        <!-- Header dengan Animasi yang Lucu -->
        <div class="text-center mb-4 md:mb-6 animate-slide-up">
            <h2 class="text-xl md:text-2xl font-black bg-gradient-to-r from-purple-600 to-pink-600 bg-clip-text text-transparent flex items-center justify-center gap-2">
                <i data-lucide="smile" class="w-6 h-6 text-yellow-500 animate-bounce"></i>
                <span>Presensi Seru!</span>
                <i data-lucide="star" class="w-6 h-6 text-yellow-500 animate-wiggle"></i>
            </h2>
            <p class="text-xs md:text-sm text-slate-500 mt-1">Yuk lihat kehadiranmu!</p>
        </div>

        <!-- Loading State dengan Animasi Lucu -->
        <div x-show="isLoading" class="text-center py-8 md:py-12">
            <div class="loader-cute mx-auto"></div>
            <p class="mt-4 text-slate-600 font-bold animate-pulse">Sedang memuat data seru...</p>
            <p class="text-xs text-slate-400">Bentar ya, lagi disiapin!</p>
        </div>

        <div x-show="!isLoading" x-transition:enter="transition ease-out duration-500" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100">
            <!-- Ringkasan Total Kehadiran dengan Progress Circle -->
            <div class="bg-gradient-to-r from-purple-50 to-pink-50 p-4 md:p-6 rounded-[25px] md:rounded-[35px] border-2 border-purple-200 hover:border-purple-300 hover:shadow-xl transition-all duration-300">
                <h4 class="font-bold text-slate-800 mb-3 md:mb-4 flex items-center text-sm md:text-base">
                    <i data-lucide="pie-chart" class="w-4 h-4 mr-2 text-purple-500 animate-pulse"></i>
                    Ringkasan Kehadiran
                    <span class="ml-2 text-[10px] bg-purple-200 px-2 py-1 rounded-full">Bulan Ini</span>
                </h4>

                <!-- Progress Circle Overview -->
                <div class="flex justify-center mb-4 md:mb-6">
                    <div class="relative w-28 h-28 md:w-36 md:h-36">
                        <svg class="w-28 h-28 md:w-36 md:h-36 transform -rotate-90">
                            <circle class="text-slate-200" stroke-width="8" stroke="currentColor" fill="transparent" 
                                    r="48" cx="56" cy="56">
                            </circle>
                            <circle class="text-purple-600 progress-ring" stroke-width="8" stroke="currentColor" fill="transparent" 
                                    r="48" cx="56" cy="56"
                                    :stroke-dasharray="2 * Math.PI * 48"
                                    :stroke-dashoffset="2 * Math.PI * 48 * (1 - ({{ $totalKehadiran['hadir'] }} / {{ max($totalKehadiran['total'], 1) }}))">
                            </circle>
                        </svg>
                        <div class="absolute inset-0 flex flex-col items-center justify-center">
                            <span class="text-xl md:text-2xl font-black text-purple-600">{{ number_format(($totalKehadiran['hadir'] / max($totalKehadiran['total'], 1)) * 100, 1) }}%</span>
                            <span class="text-[10px] text-slate-500">Kehadiran</span>
                        </div>
                    </div>
                </div>

                <!-- Stat Cards -->
                <div class="grid grid-cols-5 gap-1 md:gap-2">
                    <div class="bg-white p-2 rounded-xl text-center hover:scale-105 transform transition-all duration-300 hover:shadow-lg cursor-pointer"
                         @click="filterByStatus('all')"
                         :class="{'ring-2 ring-purple-500': selectedFilter === 'all'}">
                        <p class="text-[8px] font-bold text-slate-400 uppercase">Total</p>
                        <p class="text-xs md:text-sm font-black text-slate-700" x-text="formatNumber({{ $totalKehadiran['total'] }})"></p>
                    </div>
                    <div class="bg-white p-2 rounded-xl text-center hover:scale-105 transform transition-all duration-300 hover:shadow-lg cursor-pointer"
                         @click="filterByStatus('hadir')"
                         :class="{'ring-2 ring-green-500': selectedFilter === 'hadir'}">
                        <p class="text-[8px] font-bold text-slate-400 uppercase">Hadir</p>
                        <p class="text-xs md:text-sm font-black text-green-600" x-text="formatNumber({{ $totalKehadiran['hadir'] }})"></p>
                    </div>
                    <div class="bg-white p-2 rounded-xl text-center hover:scale-105 transform transition-all duration-300 hover:shadow-lg cursor-pointer"
                         @click="filterByStatus('izin')"
                         :class="{'ring-2 ring-yellow-500': selectedFilter === 'izin'}">
                        <p class="text-[8px] font-bold text-slate-400 uppercase">Izin</p>
                        <p class="text-xs md:text-sm font-black text-yellow-600" x-text="formatNumber({{ $totalKehadiran['izin'] }})"></p>
                    </div>
                    <div class="bg-white p-2 rounded-xl text-center hover:scale-105 transform transition-all duration-300 hover:shadow-lg cursor-pointer"
                         @click="filterByStatus('sakit')"
                         :class="{'ring-2 ring-red-500': selectedFilter === 'sakit'}">
                        <p class="text-[8px] font-bold text-slate-400 uppercase">Sakit</p>
                        <p class="text-xs md:text-sm font-black text-red-600" x-text="formatNumber({{ $totalKehadiran['sakit'] }})"></p>
                    </div>
                    <div class="bg-white p-2 rounded-xl text-center hover:scale-105 transform transition-all duration-300 hover:shadow-lg cursor-pointer"
                         @click="filterByStatus('izin_hangus')"
                         :class="{'ring-2 ring-blue-500': selectedFilter === 'izin_hangus'}">
                        <p class="text-[8px] font-bold text-slate-400 uppercase">Hangus</p>
                        <p class="text-xs md:text-sm font-black text-blue-600" x-text="formatNumber({{ $totalKehadiran['izin_hangus'] }})"></p>
                    </div>
                </div>
            </div>

            <!-- Attendance Stats Cards -->
            <div class="grid grid-cols-1 gap-3 md:gap-4">
                <!-- Terapi Perilaku Card -->
                <div class="bg-gradient-to-r from-green-50 to-emerald-50 p-4 rounded-2xl border-2 border-green-200 hover:border-green-300 hover:shadow-xl transition-all duration-300 flex flex-col md:flex-row items-start gap-3">
                    <!-- Icon -->
                    <div class="w-12 h-12 bg-gradient-to-br from-green-500 to-emerald-600 rounded-xl flex items-center justify-center shadow-lg flex-shrink-0 animate-float">
                        <i data-lucide="brain" class="w-6 h-6 text-white"></i>
                    </div>

                    <!-- Content -->
                    <div class="flex-1 w-full">
                        <div class="flex justify-between items-start mb-2">
                            <div>
                                <h4 class="font-bold text-slate-800 text-sm md:text-base">Terapi Perilaku</h4>
                                <p class="text-[10px] text-slate-500 flex items-center">
                                    <i data-lucide="calendar" class="w-3 h-3 mr-1"></i>
                                    {{ $bulanIni }}
                                </p>
                            </div>
                            <div class="text-right bg-white/60 px-2 py-1 rounded-full">
                                <span class="text-xs font-black text-green-600">{{ $attendanceStats['terapi_perilaku']['percentage'] ?? 0 }}%</span>
                            </div>
                        </div>

                        @php
                            $stats = $attendanceStats['terapi_perilaku'];
                        @endphp

                        <div class="grid grid-cols-4 gap-1 mb-2">
                            <div class="bg-white/70 p-1.5 rounded-lg text-center hover:bg-green-50 transition-colors cursor-pointer" @click="filterByStatusAndType('hadir', 'perilaku')">
                                <span class="text-[8px] font-bold text-slate-400">Hadir</span>
                                <p class="text-xs font-black text-green-600">{{ $stats['hadir'] }}</p>
                            </div>
                            <div class="bg-white/70 p-1.5 rounded-lg text-center hover:bg-yellow-50 transition-colors cursor-pointer" @click="filterByStatusAndType('izin', 'perilaku')">
                                <span class="text-[8px] font-bold text-slate-400">Izin</span>
                                <p class="text-xs font-black text-yellow-600">{{ $stats['izin'] }}</p>
                            </div>
                            <div class="bg-white/70 p-1.5 rounded-lg text-center hover:bg-red-50 transition-colors cursor-pointer" @click="filterByStatusAndType('sakit', 'perilaku')">
                                <span class="text-[8px] font-bold text-slate-400">Sakit</span>
                                <p class="text-xs font-black text-red-600">{{ $stats['sakit'] }}</p>
                            </div>
                            <div class="bg-white/70 p-1.5 rounded-lg text-center hover:bg-blue-50 transition-colors cursor-pointer" @click="filterByStatusAndType('izin_hangus', 'perilaku')">
                                <span class="text-[8px] font-bold text-slate-400">Hangus</span>
                                <p class="text-xs font-black text-blue-600">{{ $stats['izin_hangus'] }}</p>
                            </div>
                        </div>

                        <div class="flex items-center justify-between text-[8px] text-slate-500 border-t border-green-200 pt-1">
                            <span class="font-bold">Total Sesi: <span class="text-slate-800">{{ $stats['total'] }}</span></span>
                            <span class="font-bold">Progress: <span class="text-green-600">{{ $stats['hadir'] }}/{{ $stats['total'] }}</span></span>
                        </div>
                    </div>
                </div>

                <!-- Fisioterapi Card -->
                <div class="bg-gradient-to-r from-blue-50 to-cyan-50 p-4 rounded-2xl border-2 border-blue-200 hover:border-blue-300 hover:shadow-xl transition-all duration-300 flex flex-col md:flex-row items-start gap-3">
                    <!-- Icon -->
                    <div class="w-12 h-12 bg-gradient-to-br from-blue-500 to-cyan-600 rounded-xl flex items-center justify-center shadow-lg flex-shrink-0 animate-float">
                        <i data-lucide="accessibility" class="w-6 h-6 text-white"></i>
                    </div>

                    <!-- Content -->
                    <div class="flex-1 w-full">
                        <div class="flex justify-between items-start mb-2">
                            <div>
                                <h4 class="font-bold text-slate-800 text-sm md:text-base">Fisioterapi</h4>
                                <p class="text-[10px] text-slate-500 flex items-center">
                                    <i data-lucide="calendar" class="w-3 h-3 mr-1"></i>
                                    {{ $bulanIni }}
                                </p>
                            </div>
                            <div class="text-right bg-white/60 px-2 py-1 rounded-full">
                                <span class="text-xs font-black text-blue-600">{{ $attendanceStats['fisioterapi']['percentage'] ?? 0 }}%</span>
                            </div>
                        </div>

                        @php
                            $stats = $attendanceStats['fisioterapi'];
                        @endphp

                        <div class="grid grid-cols-4 gap-1 mb-2">
                            <div class="bg-white/70 p-1.5 rounded-lg text-center hover:bg-green-50 transition-colors cursor-pointer" @click="filterByStatusAndType('hadir', 'fisio')">
                                <span class="text-[8px] font-bold text-slate-400">Hadir</span>
                                <p class="text-xs font-black text-green-600">{{ $stats['hadir'] }}</p>
                            </div>
                            <div class="bg-white/70 p-1.5 rounded-lg text-center hover:bg-yellow-50 transition-colors cursor-pointer" @click="filterByStatusAndType('izin', 'fisio')">
                                <span class="text-[8px] font-bold text-slate-400">Izin</span>
                                <p class="text-xs font-black text-yellow-600">{{ $stats['izin'] }}</p>
                            </div>
                            <div class="bg-white/70 p-1.5 rounded-lg text-center hover:bg-red-50 transition-colors cursor-pointer" @click="filterByStatusAndType('sakit', 'fisio')">
                                <span class="text-[8px] font-bold text-slate-400">Sakit</span>
                                <p class="text-xs font-black text-red-600">{{ $stats['sakit'] }}</p>
                            </div>
                            <div class="bg-white/70 p-1.5 rounded-lg text-center hover:bg-blue-50 transition-colors cursor-pointer" @click="filterByStatusAndType('izin_hangus', 'fisio')">
                                <span class="text-[8px] font-bold text-slate-400">Hangus</span>
                                <p class="text-xs font-black text-blue-600">{{ $stats['izin_hangus'] }}</p>
                            </div>
                        </div>

                        <div class="flex items-center justify-between text-[8px] text-slate-500 border-t border-blue-200 pt-1">
                            <span class="font-bold">Total Sesi: <span class="text-slate-800">{{ $stats['total'] }}</span></span>
                            <span class="font-bold">Progress: <span class="text-blue-600">{{ $stats['hadir'] }}/{{ $stats['total'] }}</span></span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Filter & Search -->
            <div class="flex items-center gap-2">
                <div class="flex-1 relative">
                    <i data-lucide="search" class="w-4 h-4 absolute left-3 top-1/2 transform -translate-y-1/2 text-slate-400"></i>
                    <input type="text"
                           placeholder="Cari presensi seru..."
                           class="w-full pl-10 pr-4 py-2.5 rounded-xl border-2 border-slate-100 focus:border-purple-300 focus:outline-none focus:ring-2 focus:ring-purple-200 text-sm"
                           x-model="searchQuery">
                </div>
                <button @click="showCalendar = !showCalendar"
                        class="p-2.5 bg-white rounded-xl border-2 border-slate-100 hover:border-purple-300 hover:bg-purple-50 transition-all duration-300">
                    <i data-lucide="calendar" class="w-5 h-5 text-slate-600"></i>
                </button>
            </div>

            <!-- Calendar View -->
            <div x-show="showCalendar"
                 x-transition:enter="transition ease-out duration-300"
                 x-transition:enter-start="opacity-0 transform scale-95"
                 x-transition:enter-end="opacity-100 transform scale-100"
                 class="bg-gradient-to-r from-purple-50 to-pink-50 p-4 rounded-2xl border-2 border-purple-200" x-cloak>
                
                <h4 class="font-bold text-slate-800 mb-3 flex items-center text-sm">
                    <i data-lucide="calendar" class="w-4 h-4 mr-2 text-purple-500"></i>
                    Kalender Seru {{ $bulanIni }}
                </h4>
                
                <!-- Legend -->
                <div class="flex flex-wrap items-center justify-center gap-2 mb-3 text-[8px]">
                    <div class="flex items-center bg-white/60 px-2 py-1 rounded-full">
                        <div class="w-2 h-2 rounded-full bg-green-100 mr-1 border border-green-300"></div>
                        <span>Hadir</span>
                    </div>
                    <div class="flex items-center bg-white/60 px-2 py-1 rounded-full">
                        <div class="w-2 h-2 rounded-full bg-yellow-100 mr-1 border border-yellow-300"></div>
                        <span>Izin</span>
                    </div>
                    <div class="flex items-center bg-white/60 px-2 py-1 rounded-full">
                        <div class="w-2 h-2 rounded-full bg-red-100 mr-1 border border-red-300"></div>
                        <span>Sakit</span>
                    </div>
                    <div class="flex items-center bg-white/60 px-2 py-1 rounded-full">
                        <div class="w-2 h-2 rounded-full bg-blue-100 mr-1 border border-blue-300"></div>
                        <span>Hangus</span>
                    </div>
                </div>

                <!-- Calendar Grid -->
                <div class="grid grid-cols-7 gap-1 text-center">
                    @foreach(['Sen', 'Sel', 'Rab', 'Kam', 'Jum', 'Sab', 'Min'] as $day)
                        <div class="text-[10px] font-bold text-slate-400 p-1">{{ $day }}</div>
                    @endforeach

                    @for($i = 1; $i <= $hariInBulan; $i++)
                        @php
                            $hasAttendance = collect($attendanceData)->first(function($item) use ($i) {
                                return $item['date_number'] == $i;
                            });
                            $status = $hasAttendance ? $hasAttendance['status_original'] : null;
                        @endphp
                        <div class="aspect-square flex items-center justify-center">
                            <button class="w-7 h-7 rounded-full flex items-center justify-center text-xs cursor-pointer transition-all duration-300 hover:scale-110
                                @if($status == 'hadir') bg-green-100 text-green-700 hover:bg-green-200 border-2 border-green-300
                                @elseif($status == 'izin') bg-yellow-100 text-yellow-700 hover:bg-yellow-200 border-2 border-yellow-300
                                @elseif($status == 'sakit') bg-red-100 text-red-700 hover:bg-red-200 border-2 border-red-300
                                @elseif($status == 'izin_hangus') bg-blue-100 text-blue-700 hover:bg-blue-200 border-2 border-blue-300
                                @else bg-slate-50 text-slate-400 hover:bg-slate-100 border-2 border-slate-100
                                @endif"
                                @click="showDateDetail({{ $i }})">
                                <span class="font-bold">{{ $i }}</span>
                            </button>
                        </div>
                    @endfor
                </div>
            </div>

            <!-- Attendance History -->
            <div>
                <div class="flex justify-between items-center mb-3">
                    <h4 class="font-bold text-slate-800 flex items-center text-sm">
                        <i data-lucide="calendar-days" class="w-4 h-4 mr-2 text-purple-500"></i>
                        Riwayat Presensi
                    </h4>
                    <div class="flex items-center gap-1">
                        <span class="text-xs text-slate-600" x-text="filteredData.length + ' data'"></span>
                        <select class="text-xs border-2 border-slate-100 rounded-lg px-2 py-1 focus:border-purple-300" x-model="sortOrder">
                            <option value="desc">Terbaru ✨</option>
                            <option value="asc">Terlama 📅</option>
                        </select>
                    </div>
                </div>

                <div class="space-y-2" x-show="filteredData.length > 0">
                    <template x-for="(attendance, index) in filteredData" :key="attendance.id">
                        <div class="bg-white p-3 rounded-2xl border border-slate-100 hover:border-purple-200 transition-all duration-300 hover:shadow-lg cursor-pointer"
                             @click="showDetail(attendance)">
                            
                            <div class="flex items-center justify-between mb-2">
                                <div class="flex items-center space-x-3">
                                    <!-- Date Circle -->
                                    <div class="w-12 h-12 rounded-xl flex flex-col items-center justify-center relative overflow-hidden"
                                         :class="{
                                             'bg-gradient-to-br from-green-100 to-green-50 text-green-700': attendance.status_original === 'hadir',
                                             'bg-gradient-to-br from-yellow-100 to-yellow-50 text-yellow-700': attendance.status_original === 'izin',
                                             'bg-gradient-to-br from-red-100 to-red-50 text-red-700': attendance.status_original === 'sakit',
                                             'bg-gradient-to-br from-blue-100 to-blue-50 text-blue-700': attendance.status_original === 'izin_hangus'
                                         }">
                                        <span class="text-[10px] font-bold" x-text="attendance.day_short"></span>
                                        <span class="text-base font-black" x-text="attendance.date_number"></span>
                                    </div>
                                    
                                    <!-- Info -->
                                    <div>
                                        <p class="font-bold text-slate-800 text-sm flex items-center">
                                            <span x-text="attendance.date"></span>
                                            <span class="ml-2 text-[8px] px-1.5 py-0.5 rounded-full bg-purple-100 text-purple-700"
                                                  x-show="attendance.pertemuan_ke"
                                                  x-text="'P' + attendance.pertemuan_ke"></span>
                                        </p>
                                        <p class="text-xs text-slate-500" x-text="attendance.type"></p>
                                        <div class="flex items-center mt-0.5 text-[10px] text-slate-400">
                                            <i data-lucide="user" class="w-3 h-3 mr-1"></i>
                                            <span x-text="attendance.therapist"></span>
                                        </div>
                                    </div>
                                </div>
                                
                                <!-- Status Badge -->
                                <div class="text-right">
                                    <span class="text-[8px] font-bold px-2 py-1 rounded-full border"
                                          :class="{
                                              'bg-green-50 text-green-700 border-green-200': attendance.status_original === 'hadir',
                                              'bg-yellow-50 text-yellow-700 border-yellow-200': attendance.status_original === 'izin',
                                              'bg-red-50 text-red-700 border-red-200': attendance.status_original === 'sakit',
                                              'bg-blue-50 text-blue-700 border-blue-200': attendance.status_original === 'izin_hangus'
                                          }"
                                          x-text="attendance.status">
                                    </span>
                                </div>
                            </div>

                            <!-- Time Info for Hadir -->
                            <div x-show="attendance.status_original === 'hadir'" class="mt-2">
                                <div class="grid grid-cols-2 gap-2 p-2 bg-slate-50 rounded-lg">
                                    <div class="text-center">
                                        <p class="text-[8px] font-bold text-slate-400 uppercase">Masuk</p>
                                        <p class="text-xs font-black text-slate-700" x-text="attendance.timeIn"></p>
                                    </div>
                                    <div class="text-center">
                                        <p class="text-[8px] font-bold text-slate-400 uppercase">Pulang</p>
                                        <p class="text-xs font-black text-slate-700" x-text="attendance.timeOut"></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </template>
                </div>

                <!-- Empty State -->
                <div x-show="filteredData.length === 0" class="bg-white p-6 rounded-2xl border border-slate-100 text-center">
                    <i data-lucide="smile" class="w-12 h-12 mx-auto text-slate-300 mb-2"></i>
                    <p class="text-slate-500 font-bold text-sm">Belum ada data presensi</p>
                    <p class="text-xs text-slate-400">Nanti akan muncul ya, tetap semangat! 🌟</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    function attendanceDashboard() {
        return {
            isLoading: false,
            searchQuery: '',
            selectedFilter: 'all',
            selectedType: 'all',
            sortOrder: 'desc',
            showCalendar: false,
            showScrollTop: false,
            allData: {!! json_encode($attendanceData) !!},
            filteredData: [],
            
            init() {
                this.filteredData = this.allData;
                this.applyFilters();
                window.addEventListener('scroll', () => {
                    this.showScrollTop = window.scrollY > 300;
                });
            },
            
            filterByStatus(status) {
                this.selectedFilter = status;
                this.selectedType = 'all';
                this.applyFilters();
            },
            
            filterByStatusAndType(status, type) {
                this.selectedFilter = status;
                this.selectedType = type === 'perilaku' ? 'Terapi Perilaku' : 'Fisioterapi';
                this.applyFilters();
            },
            
            applyFilters() {
                this.filteredData = this.allData.filter(item => {
                    const matchesStatus = this.selectedFilter === 'all' || item.status_original === this.selectedFilter;
                    const matchesType = this.selectedType === 'all' || item.type === this.selectedType;
                    const matchesSearch = item.date.toLowerCase().includes(this.searchQuery.toLowerCase()) || 
                                          item.therapist.toLowerCase().includes(this.searchQuery.toLowerCase()) ||
                                          item.type.toLowerCase().includes(this.searchQuery.toLowerCase());
                    return matchesStatus && matchesType && matchesSearch;
                });
                
                // Apply sorting
                this.filteredData.sort((a, b) => {
                    return this.sortOrder === 'desc' ? b.timestamp - a.timestamp : a.timestamp - b.timestamp;
                });
            },
            
            formatNumber(num) {
                return num;
            },
            
            showDetail(item) {
                window.location.href = '/mobile/kunjungan/' + item.id;
            },
            
            showDateDetail(day) {
                const item = this.allData.find(d => parseInt(d.date_number) === day);
                if (item) {
                    this.showDetail(item);
                }
            },
            
            scrollToTop() {
                window.scrollTo({ top: 0, behavior: 'smooth' });
            }
        }
    }

    document.addEventListener('alpine:initialized', () => {
        lucide.createIcons();
    });
</script>
@endsection
