@extends('mobile.master')
@section('mobileProfile', 'active')

@section('style')
<style>
    @keyframes slide-up {
        0% { transform: translateY(20px); opacity: 0; }
        100% { transform: translateY(0); opacity: 1; }
    }
    .animate-slide-up { animation: slide-up 0.5s ease-out forwards; }
</style>
@endsection

@section('content')
<!-- Container for Desktop centering -->
<div class="max-w-lg mx-auto bg-white min-h-screen shadow-xl sm:rounded-3xl overflow-hidden mb-20">
    
    <!-- Header -->
    <div class="bg-white border-b border-slate-100 px-4 py-3 flex items-center justify-between sticky top-0 z-30">
        <button @click="sidebarOpen = true" class="w-10 h-10 rounded-xl bg-slate-50 flex items-center justify-center text-slate-600 hover:bg-slate-100 transition-colors">
            <i data-lucide="menu" class="w-5 h-5"></i>
        </button>
        <span class="font-bold text-slate-800">Profil Saya</span>
        <div class="w-10"></div> <!-- Spacer -->
    </div>

    <!-- Main Content -->
    <div class="p-4 space-y-6">
        <!-- Profile Header (Fun Style) -->
        <div class="text-center mb-4 animate-slide-up">
            <div class="w-24 h-24 mx-auto rounded-full overflow-hidden border-4 border-purple-100 shadow-lg mb-3">
                <img src="{{ $anak->foto ? asset('storage/anak/' . $anak->foto) : asset('assets/mobile/pixio/images/foto-anak/avatar.png') }}" alt="avatar" class="w-full h-full object-cover">
            </div>
            <h2 class="text-xl font-bold text-slate-800">{{ $anak->nama }}</h2>
            <p class="text-sm text-slate-500">Bright Star of Child</p>
        </div>

        <!-- Attendance Summary (Fun Style) -->
        <div class="bg-gradient-to-r from-purple-50 to-pink-50 p-4 md:p-6 rounded-[25px] border-2 border-purple-200 animate-slide-up">
            <h4 class="font-bold text-slate-800 mb-4 flex items-center text-sm">
                <i data-lucide="pie-chart" class="w-4 h-4 mr-2 text-purple-500"></i>
                Rekap Presensi
            </h4>

            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead>
                        <tr class="text-slate-500 border-b border-purple-100">
                            <th class="text-left pb-2 font-semibold">Status</th>
                            <th class="text-center pb-2 font-semibold">Perilaku</th>
                            <th class="text-center pb-2 font-semibold">Fisio</th>
                        </tr>
                    </thead>
                    <tbody class="text-slate-700">
                        <tr class="border-b border-purple-50">
                            <td class="py-3 flex items-center gap-2">
                                <div class="w-2 h-2 rounded-full bg-green-500"></div>
                                <span>Hadir</span>
                            </td>
                            <td class="text-center font-bold text-green-600">{{ $hadir_terapi_perilaku }}</td>
                            <td class="text-center font-bold text-green-600">{{ $hadir_fisioterapi }}</td>
                        </tr>
                        <tr class="border-b border-purple-50">
                            <td class="py-3 flex items-center gap-2">
                                <div class="w-2 h-2 rounded-full bg-yellow-500"></div>
                                <span>Izin</span>
                            </td>
                            <td class="text-center font-bold text-yellow-600">{{ $izin_terapi_perilaku }}</td>
                            <td class="text-center font-bold text-yellow-600">{{ $izin_fisioterapi }}</td>
                        </tr>
                        <tr class="border-b border-purple-50">
                            <td class="py-3 flex items-center gap-2">
                                <div class="w-2 h-2 rounded-full bg-red-500"></div>
                                <span>Sakit</span>
                            </td>
                            <td class="text-center font-bold text-red-600">{{ $sakit_terapi_perilaku }}</td>
                            <td class="text-center font-bold text-red-600">{{ $sakit_fisioterapi }}</td>
                        </tr>
                        <tr>
                            <td class="py-3 flex items-center gap-2">
                                <div class="w-2 h-2 rounded-full bg-blue-500"></div>
                                <span>Hangus</span>
                            </td>
                            <td class="text-center font-bold text-blue-600">{{ $izin_hangus_terapi_perilaku }}</td>
                            <td class="text-center font-bold text-blue-600">{{ $izin_hangus_fisioterapi }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Account Settings -->
        <div>
            <h4 class="font-bold text-slate-800 mb-3 flex items-center text-sm">
                <i data-lucide="settings" class="w-4 h-4 mr-2 text-purple-500"></i>
                Pengaturan Akun
            </h4>
            
            <div class="space-y-2">
                <a href="{{ route('mobile.editprofile') }}" class="flex items-center justify-between p-4 bg-white rounded-2xl border border-slate-100 hover:border-purple-200 transition-colors">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-xl bg-purple-50 flex items-center justify-center text-purple-600">
                            <i data-lucide="user" class="w-5 h-5"></i>
                        </div>
                        <div>
                            <span class="font-semibold text-slate-800 block">Edit Profil</span>
                            <span class="text-xs text-slate-500">Ubah data diri anak</span>
                        </div>
                    </div>
                    <i data-lucide="chevron-right" class="w-5 h-5 text-slate-400"></i>
                </a>
                
                <a href="{{ route('mobile.ubahpassword') }}" class="flex items-center justify-between p-4 bg-white rounded-2xl border border-slate-100 hover:border-purple-200 transition-colors">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-xl bg-pink-50 flex items-center justify-center text-pink-600">
                            <i data-lucide="lock" class="w-5 h-5"></i>
                        </div>
                        <div>
                            <span class="font-semibold text-slate-800 block">Ubah Kata Sandi</span>
                            <span class="text-xs text-slate-500">Amankan akun Anda</span>
                        </div>
                    </div>
                    <i data-lucide="chevron-right" class="w-5 h-5 text-slate-400"></i>
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
