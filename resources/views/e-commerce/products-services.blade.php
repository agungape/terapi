@extends('layouts.master')
@section('title', 'Layanan & Produk')

@section('content')
<div class="space-y-8 animate-in fade-in duration-500">
    
    <!-- Header -->
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
        <div class="space-y-1">
            <div class="flex items-center gap-2 text-xs font-bold text-slate-400 uppercase tracking-widest">
                <a href="{{ route('home') }}" class="hover:text-red-500 transition-colors">Home</a>
                <i data-lucide="chevron-right" class="w-3 h-3"></i>
                <span class="text-slate-600">E-Commerce</span>
                <i data-lucide="chevron-right" class="w-3 h-3"></i>
                <span class="text-slate-600">Layanan & Produk</span>
            </div>
            <h2 class="text-2xl font-black text-slate-800 uppercase italic tracking-tight">Katalog Produk & Layanan</h2>
        </div>
        
        <div class="flex items-center gap-3">
            <button class="bg-slate-900 hover:bg-red-500 text-white py-2.5 px-6 rounded-xl text-xs font-black uppercase tracking-widest flex items-center gap-2 transition-all shadow-lg shadow-slate-200">
                <i data-lucide="plus-circle" class="w-4 h-4"></i> Tambah Produk
            </button>
        </div>
    </div>

    <!-- Stats and Filters -->
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
        <!-- Summary Stats -->
        <div class="lg:col-span-4 space-y-6 lg:sticky lg:top-8">
            <div class="card-premium p-8 bg-white border-none shadow-xl shadow-slate-200/50">
                <div class="flex items-center justify-between mb-8">
                    <div class="flex items-center gap-3">
                        <div class="p-2.5 bg-red-50 rounded-xl text-red-500">
                            <i data-lucide="shopping-bag" class="w-5 h-5"></i>
                        </div>
                        <h3 class="text-xs font-black text-slate-800 uppercase tracking-widest">Ringkasan Produk</h3>
                    </div>
                    <span class="px-3 py-1 bg-slate-100 text-slate-500 rounded-lg text-[10px] font-black uppercase tracking-widest border border-slate-200">
                        {{ $products->total() }} Items
                    </span>
                </div>

                <div class="space-y-4">
                    <div class="p-4 bg-slate-50 rounded-2xl border border-slate-100">
                        <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest block mb-2">Filter Kategori</label>
                        <select class="w-full bg-white border-slate-200 rounded-xl px-4 py-2.5 text-xs font-bold text-slate-700 outline-none focus:ring-4 focus:ring-red-50 transition-all">
                            <option value="">Semua Kategori</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="p-4 bg-slate-50 rounded-2xl border border-slate-100">
                        <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest block mb-2">Cari Nama Produk</label>
                        <div class="relative group">
                            <i data-lucide="search" class="w-3.5 h-3.5 absolute left-3 top-1/2 -translate-y-1/2 text-slate-400 group-focus-within:text-red-500 transition-colors"></i>
                            <input type="text" id="productSearch" 
                                   class="w-full bg-white border-slate-200 rounded-xl pl-9 pr-4 py-2.5 text-xs font-bold text-slate-700 outline-none focus:ring-4 focus:ring-red-50 transition-all"
                                   placeholder="Ketik kata kunci...">
                        </div>
                    </div>
                </div>

                <div class="mt-8 pt-8 border-t border-slate-50">
                    <div class="flex items-center gap-4">
                        <div class="w-12 h-12 bg-red-500 rounded-2xl flex items-center justify-center text-white shadow-lg shadow-red-200 animate-float">
                            <i data-lucide="trending-up" class="w-6 h-6"></i>
                        </div>
                        <div>
                            <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest leading-none mb-1">Total Klik</p>
                            <h4 class="text-xl font-black text-slate-800 tracking-tight">{{ $products->sum('click_count') }}</h4>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card-premium p-8 bg-slate-900 text-white relative overflow-hidden group">
                <div class="relative z-10 space-y-4">
                    <div class="w-10 h-10 bg-white/10 rounded-xl flex items-center justify-center text-red-500 group-hover:bg-red-500 group-hover:text-white transition-all duration-500">
                        <i data-lucide="info" class="w-5 h-5"></i>
                    </div>
                    <div class="space-y-1">
                        <h4 class="text-xs font-black uppercase tracking-widest italic leading-tight">Shopee Affiliate Program</h4>
                        <p class="text-[10px] text-slate-400 font-bold leading-relaxed">Kelola produk referensi yang ditampilkan ke orang tua pasien melalui aplikasi mobile.</p>
                    </div>
                </div>
                <div class="absolute -right-4 -bottom-4 text-white/5"><i data-lucide="shopping-cart" class="w-24 h-24"></i></div>
            </div>
        </div>

        <!-- Product Grid -->
        <div class="lg:col-span-8">
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-2 xl:grid-cols-3 gap-6" id="productGrid">
                @forelse($products as $product)
                <div class="group relative bg-white rounded-3xl border border-slate-100 shadow-[0_4px_20px_rgba(0,0,0,0.03)] overflow-hidden hover:shadow-xl hover:shadow-slate-200/50 hover:border-red-100 transition-all duration-300 product-item" data-name="{{ strtolower($product->name) }}">
                    <!-- Media Container -->
                    <div class="aspect-[4/3] bg-slate-50 relative overflow-hidden">
                        @if ($product->primaryImage)
                            <img src="{{ $product->primaryImage->image_url }}" alt="{{ $product->name }}" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
                        @else
                            <div class="w-full h-full flex flex-col items-center justify-center text-slate-200">
                                <i data-lucide="image" class="w-12 h-12 mb-2"></i>
                                <span class="text-[9px] font-black uppercase tracking-widest">No Image Captured</span>
                            </div>
                        @endif

                        <!-- Badges -->
                        <div class="absolute top-4 left-4 flex flex-col gap-2">
                            <span class="px-3 py-1 bg-white/90 backdrop-blur-md text-[9px] font-black uppercase tracking-[0.2em] rounded-full shadow-sm border border-white/20 {{ $product->is_active ? 'text-emerald-500' : 'text-slate-400' }}">
                                {{ $product->is_active ? 'Active' : 'Private' }}
                            </span>
                            @if ($product->discounted_price)
                                <span class="px-2 py-1 bg-red-500 text-white text-[9px] font-black uppercase tracking-widest rounded-lg shadow-lg shadow-red-200">
                                    Off {{ number_format((($product->price - $product->discounted_price) / $product->price) * 100, 0) }}%
                                </span>
                            @endif
                        </div>

                        <!-- Visibility Overlay Buttons -->
                        <div class="absolute inset-0 bg-slate-900/40 backdrop-blur-[2px] opacity-0 group-hover:opacity-100 transition-all duration-300 flex items-center justify-center gap-3">
                            <button class="w-10 h-10 bg-white rounded-xl flex items-center justify-center text-slate-900 hover:bg-red-500 hover:text-white transition-all shadow-xl -translate-y-4 group-hover:translate-y-0 duration-300">
                                <i data-lucide="edit-3" class="w-4 h-4"></i>
                            </button>
                            <button class="w-10 h-10 bg-white rounded-xl flex items-center justify-center text-red-500 hover:bg-red-500 hover:text-white transition-all shadow-xl -translate-y-4 group-hover:translate-y-0 delay-75 duration-300">
                                <i data-lucide="trash-2" class="w-4 h-4"></i>
                            </button>
                        </div>
                    </div>

                    <!-- Details -->
                    <div class="p-6 space-y-4">
                        <div class="space-y-1">
                            <div class="flex items-center gap-2 mb-2">
                                <span class="text-[9px] font-black text-red-500 uppercase tracking-widest">{{ $product->category->name ?? 'Recommendation' }}</span>
                                <div class="flex items-center gap-1 px-1.5 py-0.5 bg-slate-50 rounded text-[8px] font-bold text-slate-400 border border-slate-100">
                                    <i data-lucide="eye" class="w-2.5 h-2.5"></i>
                                    {{ $product->click_count }}
                                </div>
                            </div>
                            <h3 class="text-xs font-black text-slate-800 uppercase tracking-tight leading-snug line-clamp-2 h-8">
                                {{ $product->name }}
                            </h3>
                        </div>

                        <div class="flex items-end justify-between pt-2 border-t border-slate-50">
                            <div class="flex flex-col">
                                @if ($product->discounted_price)
                                    <span class="text-[10px] text-slate-400 line-through font-bold">Rp {{ number_format($product->price, 0, ',', '.') }}</span>
                                    <span class="text-sm font-black text-red-500 tracking-tight">Rp {{ number_format($product->discounted_price, 0, ',', '.') }}</span>
                                @else
                                    <span class="text-sm font-black text-slate-900 tracking-tight">Rp {{ number_format($product->price, 0, ',', '.') }}</span>
                                @endif
                            </div>
                            <div class="p-2 bg-slate-50 rounded-xl group-hover:bg-red-50 transition-colors">
                                <i data-lucide="arrow-up-right" class="w-3.5 h-3.5 text-slate-300 group-hover:text-red-500 transition-colors"></i>
                            </div>
                        </div>
                    </div>
                </div>
                @empty
                <div class="col-span-full py-20 card-premium bg-white flex flex-col items-center justify-center text-center px-6">
                    <div class="w-20 h-20 bg-slate-50 rounded-[40px] flex items-center justify-center text-slate-200 mb-6 border border-slate-100">
                        <i data-lucide="shopping-cart" class="w-10 h-10"></i>
                    </div>
                    <h4 class="text-sm font-black text-slate-800 uppercase tracking-widest mb-2">Belum Ada Katalog Produk</h4>
                    <p class="text-[11px] text-slate-400 font-bold max-w-sm mb-8 leading-relaxed">Katalog masih kosong, silakan tambah produk rekomendasi Shopee Affiliate Anda untuk mulai menampilkan di aplikasi.</p>
                    <button class="bg-red-500 hover:bg-red-600 text-white py-3 px-8 rounded-2xl text-xs font-black uppercase tracking-widest shadow-xl shadow-red-100 transition-all flex items-center gap-2">
                        <i data-lucide="plus" class="w-4 h-4"></i> Create Product Template
                    </button>
                </div>
                @endforelse
            </div>

            <!-- Pagination -->
            <div class="mt-12 flex justify-center">
                {{ $products->appends(request()->query())->links() }}
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        lucide.createIcons();

        // Search logic
        const searchInput = document.getElementById('productSearch');
        const productItems = document.querySelectorAll('.product-item');

        searchInput.addEventListener('input', function() {
            const query = this.value.toLowerCase().trim();
            productItems.forEach(item => {
                const name = item.getAttribute('data-name');
                if (name.includes(query)) {
                    item.style.display = 'block';
                } else {
                    item.style.display = 'none';
                }
            });
        });
    });
</script>
@endsection
