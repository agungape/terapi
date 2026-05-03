@extends('layouts.master')
@section('title', 'Data Terapis')

@section('content')
<div class="space-y-8 animate-in fade-in duration-500" 
     x-data="{ 
        modalOpen: {{ $errors->any() ? 'true' : 'false' }}, 
        editMode: {{ (old('_method') == 'PUT' || old('id')) ? 'true' : 'false' }}, 
        formData: {
            id: '{{ old('id') }}',
            nib: '{{ old('nib', $newNib ?? "BSC01") }}',
            nama: '{!! addslashes(old('nama')) !!}',
            telepon: '{{ old('telepon') }}',
            tanggal_lahir: '{{ old('tanggal_lahir') }}',
            perguruan_tinggi: '{!! addslashes(old('perguruan_tinggi')) !!}',
            jurusan: '{!! addslashes(old('jurusan')) !!}',
            role: '{{ old('role', 'terapi_perilaku') }}',
            alamat: '{!! addslashes(old('alamat')) !!}',
            status: '{{ old('status', 'aktif') }}'
        },
        openCreateModal() {
            this.editMode = false;
            this.formData = {
                id: '',
                nib: '{{ $newNib ?? "BSC01" }}',
                nama: '',
                telepon: '',
                tanggal_lahir: '',
                perguruan_tinggi: '',
                jurusan: '',
                role: 'terapi_perilaku',
                alamat: '',
                status: 'aktif'
            };
            this.modalOpen = true;
        },
        openEditModal(data) {
            this.editMode = true;
            this.formData = {
                id: data.id,
                nib: data.nib,
                nama: data.nama,
                telepon: data.telepon,
                tanggal_lahir: data.tanggal_lahir,
                perguruan_tinggi: data.perguruan_tinggi,
                jurusan: data.jurusan,
                role: data.role,
                alamat: data.alamat,
                status: data.status
            };
            this.modalOpen = true;
        }
     }">
    
    <!-- Top Bar -->
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
        <div class="flex items-center gap-2 text-xs font-bold text-slate-400 uppercase tracking-widest">
            <a href="{{ route('home') }}" class="hover:text-red-500 transition-colors">Home</a>
            <i data-lucide="chevron-right" class="w-3 h-3"></i>
            <span class="text-slate-600">Master Data Terapis</span>
        </div>
        
        <div class="flex items-center gap-4">
            <form action="{{ route('terapis.index') }}" method="GET" class="relative group">
                <i data-lucide="search" class="w-4 h-4 absolute left-4 top-1/2 -translate-y-1/2 text-slate-400 group-focus-within:text-red-500 transition-colors"></i>
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari Nama / NIB..." 
                       class="bg-white border border-slate-200 rounded-xl pl-11 pr-4 py-2.5 text-xs font-bold focus:ring-4 focus:ring-red-50 focus:border-red-200 outline-none w-64 transition-all shadow-sm">
            </form>

            @can('create terapis')
            <button @click="openCreateModal()" class="bg-red-500 hover:bg-red-600 text-white py-2.5 px-6 rounded-xl text-xs font-black uppercase tracking-widest flex items-center gap-2 transition-all shadow-lg shadow-red-200">
                <i data-lucide="plus-circle" class="w-4 h-4"></i> Tambah Terapis
            </button>
            @endcan
        </div>
    </div>

    <!-- Stats Table Card -->
    <div class="card-premium overflow-hidden">
        <div class="p-6 border-b border-slate-100 bg-white flex items-center justify-between">
            <h3 class="text-xs font-black text-slate-400 uppercase tracking-[0.2em] flex items-center gap-2">
                <i data-lucide="user-cog" class="w-4 h-4 text-red-500"></i> LIST TENAGA TERAPIS
            </h3>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left min-w-[900px]">
                <thead class="bg-slate-50 border-b border-slate-100">
                    <tr>
                        <th class="px-6 py-4 text-[10px] font-black text-slate-400 uppercase tracking-widest">Terapis</th>
                        <th class="px-6 py-4 text-[10px] font-black text-slate-400 uppercase tracking-widest">Spesialisasi / Role</th>
                        <th class="px-6 py-4 text-[10px] font-black text-slate-400 uppercase tracking-widest text-center">Usia</th>
                        <th class="px-6 py-4 text-[10px] font-black text-slate-400 uppercase tracking-widest text-center">Status</th>
                        <th class="px-6 py-4 text-[10px] font-black text-slate-400 uppercase tracking-widest text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-50">
                    @forelse ($terapis as $t)
                    <tr class="hover:bg-slate-50/50 transition-colors">
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-4">
                                <div class="w-11 h-11 rounded-2xl bg-slate-100 border border-slate-200 overflow-hidden shadow-sm shrink-0">
                                    <img src="{{ $t->foto ? asset('storage/terapis/' . $t->foto) : asset('assets/images/faces/face1.jpg') }}" 
                                         alt="Avatar" class="w-full h-full object-cover">
                                </div>
                                <div>
                                    <h4 class="text-xs font-black text-slate-700 uppercase tracking-tight">{{ $t->nama }}</h4>
                                    <p class="text-[9px] font-bold text-slate-400 uppercase mt-0.5 tracking-tighter">NIB: {{ $t->nib }}</p>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <span class="px-2.5 py-1 bg-red-50 text-red-700 rounded-lg text-[10px] font-black uppercase tracking-tighter border border-red-100 shadow-sm">
                                {{ $t->role }}
                            </span>
                        </td>
                        <td class="px-6 py-4 text-center">
                            <span class="text-xs font-bold text-slate-500">{{ $t->usia }} Thn</span>
                        </td>
                        <td class="px-6 py-4 text-center">
                            @can('update terapis')
                            <div class="flex justify-center">
                                <label class="relative inline-flex items-center cursor-pointer group">
                                    <input type="checkbox" class="sr-only peer status-toggle" 
                                           data-id="{{ $t->id }}" {{ $t->status === 'aktif' ? 'checked' : '' }}>
                                    <div class="w-11 h-6 bg-slate-200 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-emerald-500 shadow-sm"></div>
                                </label>
                            </div>
                            @else
                            <span class="px-2.5 py-1 rounded-lg text-[9px] font-black uppercase tracking-widest border {{ $t->status === 'aktif' ? 'bg-emerald-50 text-emerald-600 border-emerald-100' : 'bg-slate-50 text-slate-400 border-slate-100' }}">
                                {{ $t->status }}
                            </span>
                            @endcan
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex items-center justify-center gap-2">
                                @can('show terapis')
                                <a href="{{ route('terapis.show', $t->id) }}" class="p-2 bg-blue-50 text-blue-600 rounded-xl hover:bg-blue-600 hover:text-white transition-all shadow-sm border border-blue-100" title="Detail Profile">
                                    <i data-lucide="contact-2" class="w-3.5 h-3.5"></i>
                                </a>
                                @endcan
                                
                                @can('update terapis')
                                <button @click="openEditModal({
                                    id: '{{ $t->id }}',
                                    nib: '{{ $t->nib }}',
                                    nama: '{{ $t->nama }}',
                                    telepon: '{{ $t->telepon }}',
                                    tanggal_lahir: '{{ $t->tanggal_lahir }}',
                                    perguruan_tinggi: '{{ $t->perguruan_tinggi }}',
                                    jurusan: '{{ $t->jurusan }}',
                                    role: '{{ $t->role }}',
                                    alamat: `{!! addslashes($t->alamat) !!}`,
                                    status: '{{ $t->status }}'
                                })" class="p-2 bg-amber-50 text-amber-600 rounded-xl hover:bg-amber-600 hover:text-white transition-all shadow-sm border border-amber-100" title="Ubah Data">
                                    <i data-lucide="edit-3" class="w-3.5 h-3.5"></i>
                                </button>
                                @endcan

                                @can('delete terapis')
                                <form action="{{ route('terapis.destroy', $t->id) }}" method="POST" class="inline">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="p-2 bg-red-50 text-red-600 rounded-xl hover:bg-red-600 hover:text-white transition-all shadow-sm border border-red-100 btn-hapus" data-name="{{ $t->nama }}" data-table="terapis" title="Hapus Permanen">
                                        <i data-lucide="trash-2" class="w-3.5 h-3.5"></i>
                                    </button>
                                </form>
                                @endcan
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="5" class="px-6 py-20 text-center text-slate-300 italic font-bold">Belum ada tenaga terapis terdaftar</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        <div class="p-6 bg-slate-50/50 border-t border-slate-100 flex justify-center">
            {{ $terapis->fragment('judul')->links() }}
        </div>
    </div>

    <!-- Alpine Modal -->
    <template x-if="modalOpen">
        <div class="fixed inset-0 z-[100] overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
            <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                <!-- Overlay -->
                <div class="fixed inset-0 bg-slate-900/60 backdrop-blur-sm transition-opacity" @click="modalOpen = false"></div>

                <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>

                <div class="inline-block align-bottom bg-white rounded-3xl text-left overflow-hidden shadow-2xl transform transition-all sm:my-8 sm:align-middle sm:max-w-2xl sm:w-full animate-in zoom-in duration-300">
                    <form :action="editMode ? '{{ url('terapis') }}/' + formData.id : '{{ route('terapis.store') }}'" method="POST" enctype="multipart/form-data">
                        @csrf
                        <template x-if="editMode">
                            <input type="hidden" name="_method" value="PUT">
                        </template>

                        <!-- Modal Header -->
                        <div class="px-8 py-6 bg-slate-50 border-b border-slate-100 flex items-center justify-between">
                            <div class="flex items-center gap-4">
                                <div class="w-12 h-12 rounded-2xl bg-red-500 text-white flex items-center justify-center shadow-lg shadow-red-200">
                                    <i data-lucide="user-cog" class="w-6 h-6" x-show="!editMode"></i>
                                    <i data-lucide="edit-3" class="w-6 h-6" x-show="editMode"></i>
                                </div>
                                <div>
                                    <h3 class="text-lg font-black text-slate-800 uppercase italic tracking-tight" x-text="editMode ? 'Ubah Data Terapis' : 'Tambah Terapis Baru'"></h3>
                                    <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mt-0.5">Lengkapi profil tenaga ahli profesional</p>
                                </div>
                            </div>
                            <button type="button" @click="modalOpen = false" class="text-slate-400 hover:text-red-500 transition-colors">
                                <i data-lucide="x" class="w-6 h-6"></i>
                            </button>
                        </div>

                        <!-- Modal Body -->
                        <div class="px-8 py-8 space-y-6">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <!-- NIB (Readonly in all mode because it's auto-generated) -->
                                <div class="space-y-2">
                                    <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest block">ID / NIB Terapis</label>
                                    <input type="text" name="nib" x-model="formData.nib" readonly required
                                           class="w-full bg-slate-100 border-slate-100 rounded-2xl px-5 py-4 text-xs font-black opacity-60 cursor-not-allowed outline-none">
                                    @error('nib') <p class="text-[10px] font-bold text-red-500 mt-1 uppercase tracking-tight">{{ $message }}</p> @enderror
                                </div>

                                <!-- Nama -->
                                <div class="space-y-2">
                                    <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest block">Nama Lengkap & Gelar</label>
                                    <input type="text" name="nama" x-model="formData.nama" required placeholder="dr. Name, M.Psi..."
                                           class="w-full bg-slate-50 border-slate-100 rounded-2xl px-5 py-4 text-xs font-bold focus:ring-4 focus:ring-red-50 transition-all outline-none">
                                    @error('nama') <p class="text-[10px] font-bold text-red-500 mt-1 uppercase tracking-tight">{{ $message }}</p> @enderror
                                </div>

                                <!-- Telepon -->
                                <div class="space-y-2">
                                    <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest block">Nomor HP</label>
                                    <input type="text" name="telepon" x-model="formData.telepon" required placeholder="08..."
                                           class="w-full bg-slate-50 border-slate-100 rounded-2xl px-5 py-4 text-xs font-bold focus:ring-4 focus:ring-red-50 transition-all outline-none">
                                    @error('telepon') <p class="text-[10px] font-bold text-red-500 mt-1 uppercase tracking-tight">{{ $message }}</p> @enderror
                                </div>

                                <!-- Tanggal Lahir -->
                                <div class="space-y-2">
                                    <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest block">Tanggal Lahir</label>
                                    <input type="date" name="tanggal_lahir" x-model="formData.tanggal_lahir" required
                                           class="w-full bg-slate-50 border-slate-100 rounded-2xl px-5 py-4 text-xs font-bold focus:ring-4 focus:ring-red-50 transition-all focus:text-red-500 outline-none">
                                    @error('tanggal_lahir') <p class="text-[10px] font-bold text-red-500 mt-1 uppercase tracking-tight">{{ $message }}</p> @enderror
                                </div>

                                <!-- Pendidikan -->
                                <div class="space-y-2">
                                    <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest block">Almamater</label>
                                    <input type="text" name="perguruan_tinggi" x-model="formData.perguruan_tinggi" required placeholder="Nama Kampus..."
                                           class="w-full bg-slate-50 border-slate-100 rounded-2xl px-5 py-4 text-xs font-bold focus:ring-4 focus:ring-red-50 transition-all outline-none">
                                    @error('perguruan_tinggi') <p class="text-[10px] font-bold text-red-500 mt-1 uppercase tracking-tight">{{ $message }}</p> @enderror
                                </div>

                                <div class="space-y-2">
                                    <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest block">Jurusan</label>
                                    <input type="text" name="jurusan" x-model="formData.jurusan" required placeholder="Psikologi..."
                                           class="w-full bg-slate-50 border-slate-100 rounded-2xl px-5 py-4 text-xs font-bold focus:ring-4 focus:ring-red-50 transition-all outline-none">
                                    @error('jurusan') <p class="text-[10px] font-bold text-red-500 mt-1 uppercase tracking-tight">{{ $message }}</p> @enderror
                                </div>

                                <!-- Role -->
                                <div class="space-y-2">
                                    <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest block">Jabatan Klinik</label>
                                    <select name="role" x-model="formData.role" class="w-full bg-slate-50 border-slate-100 rounded-2xl px-5 py-4 text-xs font-black focus:ring-4 focus:ring-red-50 outline-none appearance-none">
                                        <option value="terapi_perilaku">Terapi Perilaku</option>
                                        <option value="fisioterapi">Fisioterapi & Sensori Integrasi</option>
                                    </select>
                                    @error('role') <p class="text-[10px] font-bold text-red-500 mt-1 uppercase tracking-tight">{{ $message }}</p> @enderror
                                </div>

                                <!-- Foto (Always shown, not mandatory) -->
                                <div class="space-y-2">
                                    <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest block">Foto Profil</label>
                                    <input type="file" name="foto" class="w-full text-[10px] file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-[10px] file:font-black file:bg-red-50 file:text-red-700 hover:file:bg-red-100 transition-all">
                                    @error('foto') <p class="text-[10px] font-bold text-red-500 mt-1 uppercase tracking-tight">{{ $message }}</p> @enderror
                                </div>
                            </div>

                            <!-- Alamat -->
                            <div class="space-y-2">
                                <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest block">Alamat Lengkap</label>
                                <textarea name="alamat" x-model="formData.alamat" rows="3" required placeholder="Jl. Raya..."
                                          class="w-full bg-slate-50 border-slate-100 rounded-2xl px-5 py-4 text-xs font-bold focus:ring-4 focus:ring-red-50 transition-all outline-none resize-none"></textarea>
                                @error('alamat') <p class="text-[10px] font-bold text-red-500 mt-1 uppercase tracking-tight">{{ $message }}</p> @enderror
                            </div>

                            <!-- Status (Hidden in create, shown in edit) -->
                            <input type="hidden" name="status" x-model="formData.status">
                        </div>

                        <!-- Modal Footer -->
                        <div class="px-8 py-6 bg-slate-50 border-t border-slate-100 flex items-center justify-end gap-3 rounded-b-3xl">
                            <button type="button" @click="modalOpen = false" class="px-6 py-3 bg-white border border-slate-200 text-slate-500 rounded-2xl text-[10px] font-black uppercase tracking-widest hover:bg-slate-50 transition-all">Batal</button>
                            <button type="submit" class="px-8 py-3 bg-red-500 text-white rounded-2xl text-[10px] font-black uppercase tracking-widest hover:bg-red-600 shadow-lg shadow-red-100 transition-all flex items-center gap-2">
                                <span x-text="editMode ? 'Simpan Perubahan' : 'Daftarkan Terapis'"></span>
                                <i data-lucide="arrow-right" class="w-3.5 h-3.5"></i>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </template>
</div>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        lucide.createIcons();

        // AJAX Status Toggle Logic
        $('.status-toggle').on('change', function() {
            const terapisId = $(this).data('id');
            const state = $(this).is(':checked');

            $.ajax({
                url: "{{ route('terapis.status') }}",
                type: "POST",
                data: {
                    _token: "{{ csrf_token() }}",
                    id: terapisId,
                    status: state ? 'aktif' : 'nonaktif'
                },
                success: function(response) {
                    if (response.status === 'success') {
                        Toast.fire({ icon: 'success', title: 'Status terapis diperbarui' });
                    } else {
                        Toast.fire({ icon: 'error', title: 'Gagal memperbarui status' });
                    }
                },
                error: function() {
                    Toast.fire({ icon: 'error', title: 'Terjadi kesalahan sistem' });
                }
            });
        });
        // Modern Delete Confirmation
        $('.btn-hapus').on('click', function(e) {
            e.preventDefault();
            const form = $(this).closest('form');
            const name = $(this).data('name');

            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: "Data terapis '" + name + "' akan dihapus permanen dari sistem!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#ef4444',
                cancelButtonColor: '#94a3b8',
                confirmButtonText: 'Ya, Hapus!',
                cancelButtonText: 'Batal',
                customClass: {
                    popup: 'rounded-3xl',
                    confirmButton: 'rounded-xl px-4 py-2 text-xs font-black uppercase tracking-widest',
                    cancelButton: 'rounded-xl px-4 py-2 text-xs font-black uppercase tracking-widest'
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        });

        // Trigger modal if validation errors exist
        @if ($errors->any())
            const firstError = "{{ $errors->all()[0] }}";
            Toast.fire({ icon: 'error', title: firstError });
            // You might want to auto-open modal here if needed
        @endif
    });
</script>
@endsection
