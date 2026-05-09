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
        <span class="font-bold text-slate-800">Ubah Kata Sandi</span>
        <div class="w-10"></div> <!-- Spacer -->
    </div>

    <!-- Main Content -->
    <div class="p-4 space-y-6" x-data="{ showPass1: false, showPass2: false }">
        
        <!-- Illustration/Media -->
        <div class="text-center mb-4 animate-slide-up">
            <div class="w-32 h-32 mx-auto mb-2 bg-purple-50 rounded-full flex items-center justify-center text-purple-600">
                <i data-lucide="lock" class="w-16 h-16"></i>
            </div>
            <h3 class="text-xl font-bold text-slate-800">Masukkan Password Baru</h3>
            <p class="text-xs text-slate-500 mt-1">Pastikan kata sandi Anda kuat dan aman.</p>
        </div>

        @if (session('success'))
            <div class="bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-xl relative" role="alert" id="success-alert">
                <div class="flex items-center">
                    <i data-lucide="check-circle" class="w-5 h-5 mr-2"></i>
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
            </div>

            <script>
                setTimeout(function() {
                    const alert = document.getElementById('success-alert');
                    if (alert) {
                        alert.style.transition = 'opacity 0.5s ease';
                        alert.style.opacity = '0';
                        setTimeout(() => alert.remove(), 500);
                    }
                }, 3000);
            </script>
        @endif

        @error('password')
            <div class="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-xl relative" role="alert">
                <div class="flex items-center">
                    <i data-lucide="alert-circle" class="w-5 h-5 mr-2"></i>
                    <span class="block sm:inline">{{ $message }}</span>
                </div>
            </div>
        @enderror

        <!-- Requirements Box -->
        <div class="bg-amber-50 border border-amber-200 p-4 rounded-xl text-xs text-amber-700">
            <p class="font-bold mb-1 flex items-center">
                <i data-lucide="alert-triangle" class="w-4 h-4 mr-1"></i>
                Perhatian!
            </p>
            <ul class="list-disc list-inside space-y-1">
                <li>Kata sandi baru Anda harus berbeda dari kata sandi yang digunakan sebelumnya.</li>
                <li>Kata sandi harus memiliki minimal 8 karakter, mengandung huruf besar, dan huruf kecil.</li>
            </ul>
        </div>

        <form method="POST" action="{{ route('mobile.updatepassword', ['user' => $user->id]) }}" class="space-y-4">
            @method('PATCH')
            @csrf

            <!-- Password 1 -->
            <div>
                <label class="text-sm font-semibold text-slate-700 mb-1 block" for="dz-password">Kata Sandi Baru*</label>
                <div class="relative">
                    <input :type="showPass1 ? 'text' : 'password'" id="dz-password" class="w-full px-4 py-2.5 rounded-xl border-2 border-slate-100 focus:border-purple-300 focus:outline-none focus:ring-2 focus:ring-purple-200 text-sm" name="password" placeholder="Ketik kata sandi baru">
                    <button type="button" @click="showPass1 = !showPass1" class="absolute right-3 top-1/2 transform -translate-y-1/2 text-slate-400 hover:text-purple-600 transition-colors">
                        <i data-lucide="eye" x-show="!showPass1" class="w-5 h-5"></i>
                        <i data-lucide="eye-off" x-show="showPass1" class="w-5 h-5" x-cloak></i>
                    </button>
                </div>
            </div>

            <!-- Password 2 -->
            <div>
                <label class="text-sm font-semibold text-slate-700 mb-1 block" for="dz-password2">Inputkan Ulang Kata Sandi*</label>
                <div class="relative">
                    <input :type="showPass2 ? 'text' : 'password'" id="dz-password2" class="w-full px-4 py-2.5 rounded-xl border-2 border-slate-100 focus:border-purple-300 focus:outline-none focus:ring-2 focus:ring-purple-200 text-sm" name="password_confirmation" placeholder="Ketik ulang kata sandi">
                    <button type="button" @click="showPass2 = !showPass2" class="absolute right-3 top-1/2 transform -translate-y-1/2 text-slate-400 hover:text-purple-600 transition-colors">
                        <i data-lucide="eye" x-show="!showPass2" class="w-5 h-5"></i>
                        <i data-lucide="eye-off" x-show="showPass2" class="w-5 h-5" x-cloak></i>
                    </button>
                </div>
            </div>

            <div class="pt-2">
                <button type="submit" class="w-full bg-gradient-to-r from-purple-600 to-pink-600 text-white font-bold py-3 rounded-xl hover:from-purple-700 hover:to-pink-700 transition-all duration-300 shadow-lg shadow-purple-100">Update Password</button>
            </div>
        </form>
    </div>
</div>
@endsection

@section('scripts')
<script>
    document.addEventListener('alpine:initialized', () => {
        lucide.createIcons();
    });
</script>
@endsection
