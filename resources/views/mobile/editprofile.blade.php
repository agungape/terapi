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
        <span class="font-bold text-slate-800">Edit Profil</span>
        <div class="w-10"></div> <!-- Spacer -->
    </div>

    <!-- Main Content -->
    <div class="p-4 space-y-6">
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

        <div class="edit-profile animate-slide-up">
            <form method="POST" action="{{ route('mobile.updateprofile', ['anak' => $anak->id]) }}" enctype="multipart/form-data" class="space-y-4">
                @method('PATCH')
                @csrf
                
                <!-- Avatar Upload -->
                <div class="flex flex-col items-center mb-6">
                    <div class="relative w-32 h-32">
                        <img id="previewImage"
                             src="{{ asset($anak->foto ? 'storage/anak/' . $anak->foto : 'assets/mobile/pixio/images/foto-anak/avatar.png') }}"
                             class="w-full h-full rounded-full object-cover border-4 border-purple-100 shadow-lg">
                        
                        <label for="imageUpload" class="absolute bottom-0 right-0 w-10 h-10 bg-purple-600 rounded-full flex items-center justify-center text-white cursor-pointer hover:bg-purple-700 transition-colors shadow-md">
                            <i data-lucide="camera" class="w-5 h-5"></i>
                            <input type='file' name="foto" id="imageUpload" class="hidden" accept="image/*">
                        </label>
                    </div>
                    <p class="text-xs text-slate-500 mt-2">Ketuk ikon kamera untuk mengubah foto</p>
                </div>

                <!-- Input Fields -->
                <div class="space-y-4">
                    <div>
                        <label class="text-sm font-semibold text-slate-700 mb-1 block" for="name">Nama</label>
                        <input type="text" class="w-full px-4 py-2.5 rounded-xl border-2 border-slate-100 bg-slate-50 text-slate-500 cursor-not-allowed text-sm" value="{{ old('nama') ?? ($anak->nama ?? '') }}" disabled>
                    </div>
                    
                    <div>
                        <label class="text-sm font-semibold text-slate-700 mb-1 block" for="phone">Alamat</label>
                        <textarea class="w-full px-4 py-2.5 rounded-xl border-2 border-slate-100 focus:border-purple-300 focus:outline-none focus:ring-2 focus:ring-purple-200 text-sm @error('alamat') border-red-300 @enderror" rows="4" name="alamat">{{ old('alamat') ?? ($anak->alamat ?? '') }}</textarea>
                        @error('alamat')
                            <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <div>
                        <label class="text-sm font-semibold text-slate-700 mb-1 block" for="address">Telepon</label>
                        <input type="number" class="w-full px-4 py-2.5 rounded-xl border-2 border-slate-100 focus:border-purple-300 focus:outline-none focus:ring-2 focus:ring-purple-200 text-sm @error('telepon_ibu') border-red-300 @enderror" name="telepon_ibu" value="{{ old('telepon_ibu') ?? ($anak->telepon_ibu ?? '') }}" placeholder="08xxxxxxxxxx">
                        @error('telepon_ibu')
                            <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="pt-4">
                    <button type="submit" class="w-full bg-gradient-to-r from-purple-600 to-pink-600 text-white font-bold py-3 rounded-xl hover:from-purple-700 hover:to-pink-700 transition-all duration-300 shadow-lg shadow-purple-100">Update Profile</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    document.getElementById('imageUpload').addEventListener('change', function(event) {
        const file = event.target.files[0];
        const preview = document.getElementById('previewImage');

        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                preview.src = e.target.result;
            };
            reader.readAsDataURL(file);
        }
    });

    document.addEventListener('alpine:initialized', () => {
        lucide.createIcons();
    });
</script>
@endsection
