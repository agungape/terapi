<!-- ===== PDF VIEWER MODAL (PDF.js Canvas — Tidak Bisa Diblokir) ===== -->
<div x-show="showPdfViewer"
     x-transition:enter="transition ease-out duration-300"
     x-transition:enter-start="opacity-0"
     x-transition:enter-end="opacity-100"
     x-transition:leave="transition ease-in duration-200"
     x-transition:leave-start="opacity-100"
     x-transition:leave-end="opacity-0"
     class="fixed inset-0 z-[99999] flex flex-col bg-gray-100 w-full max-w-[400px] mx-auto shadow-2xl" x-cloak
     x-data="{
        isLoadingPdf: false,
        pdfError: false,
        pdfPages: 0,
        downloadBlob: null,
        currentPdfUrl: null,
        pdfTitle: 'Laporan Dokumen',
        async renderPdf(url, title = 'Laporan Dokumen') {
            this.isLoadingPdf = true;
            this.pdfError = false;
            this.pdfPages = 0;
            this.downloadBlob = null;
            this.currentPdfUrl = url;
            this.pdfTitle = title;
            const container = document.getElementById('pdf-canvas-container');
            if (container) container.innerHTML = '';
            try {
                const response = await fetch(url, { credentials: 'same-origin' });
                if (!response.ok) throw new Error('Gagal');
                const arrayBuffer = await response.arrayBuffer();
                this.downloadBlob = new Blob([arrayBuffer], { type: 'application/pdf' });
                const loadingTask = pdfjsLib.getDocument({ data: arrayBuffer.slice(0) });
                const pdf = await loadingTask.promise;
                this.pdfPages = pdf.numPages;
                for (let i = 1; i <= pdf.numPages; i++) {
                    const page = await pdf.getPage(i);
                    const renderScale = 3; 
                    const viewport = page.getViewport({ scale: renderScale });
                    const canvas = document.createElement('canvas');
                    canvas.width = viewport.width;
                    canvas.height = viewport.height;
                    canvas.style.width = '100%';
                    canvas.className = 'w-full shadow-md mb-2 block bg-white';
                    container.appendChild(canvas);
                    await page.render({ canvasContext: canvas.getContext('2d'), viewport: viewport }).promise;
                }
                this.isLoadingPdf = false;
            } catch(e) {
                this.isLoadingPdf = false;
                this.pdfError = true;
            }
        },
        downloadPdf() {
            if (!this.currentPdfUrl) return;
            window.location.href = this.currentPdfUrl + '?download=1';
        }
     }"
     x-on:open-pdf.window="renderPdf($event.detail.url, $event.detail.title || 'Laporan Dokumen')">

    <!-- Header -->
    <div class="flex items-center justify-between px-6 py-4 bg-slate-800 flex-shrink-0">
        <button @click="showPdfViewer = false; document.getElementById('pdf-canvas-container').innerHTML = ''; downloadBlob = null"
            class="flex items-center space-x-2 text-white/80 hover:text-white transition-colors active:scale-95">
            <i class="fas fa-arrow-left text-sm"></i>
            <span class="text-xs font-black uppercase tracking-widest">Kembali</span>
        </button>
        <div class="text-center">
            <p class="text-[10px] font-black text-white/60 uppercase tracking-widest" x-text="pdfTitle"></p>
            <p x-show="pdfPages > 0" class="text-[9px] text-white/30" x-text="pdfPages + ' halaman'"></p>
        </div>
        <!-- Download Button -->
        <button @click="downloadPdf()"
            :disabled="!currentPdfUrl || isLoadingPdf"
            :class="currentPdfUrl && !isLoadingPdf ? 'bg-blue-500 text-white active:scale-90' : 'bg-slate-700 text-slate-500 cursor-not-allowed'"
            class="w-10 h-10 rounded-xl flex items-center justify-center transition-all flex-shrink-0 shadow-sm"
            title="Unduh PDF ke Perangkat">
            <i class="fas fa-download text-sm"></i>
        </button>
    </div>

    <!-- Loading -->
    <div x-show="isLoadingPdf" class="flex-1 flex flex-col items-center justify-center space-y-4 bg-gray-100">
        <div class="w-16 h-16 rounded-2xl bg-blue-100 flex items-center justify-center animate-pulse">
            <i class="fas fa-file-pdf text-blue-500 text-2xl"></i>
        </div>
        <p class="text-slate-600 text-sm font-black uppercase tracking-widest">Memuat Laporan...</p>
        <div class="flex space-x-1">
            <div class="w-2 h-2 bg-blue-500 rounded-full animate-bounce" style="animation-delay:0s"></div>
            <div class="w-2 h-2 bg-blue-500 rounded-full animate-bounce" style="animation-delay:0.15s"></div>
            <div class="w-2 h-2 bg-blue-500 rounded-full animate-bounce" style="animation-delay:0.3s"></div>
        </div>
    </div>

    <!-- Error -->
    <div x-show="pdfError && !isLoadingPdf" class="flex-1 flex flex-col items-center justify-center space-y-4 px-8 text-center bg-gray-100">
        <div class="w-16 h-16 rounded-2xl bg-rose-100 flex items-center justify-center">
            <i class="fas fa-exclamation-triangle text-rose-500 text-2xl"></i>
        </div>
        <p class="text-slate-800 font-black text-sm uppercase tracking-widest">Gagal Memuat</p>
        <p class="text-slate-400 text-xs">Pastikan Anda sudah login dan coba lagi.</p>
        <button @click="renderPdf(currentPdfUrl, pdfTitle)"
            class="bg-blue-600 text-white px-6 py-3 rounded-xl text-xs font-black uppercase tracking-widest active:scale-95 transition-all mt-2">
            Coba Lagi
        </button>
    </div>

    <!-- Canvas Container -->
    <div x-show="!isLoadingPdf && !pdfError" class="flex-1 overflow-y-auto overflow-x-hidden bg-gray-200 p-4 scrollbar-hide no-scrollbar" id="pdf-canvas-container">
        <!-- Canvas PDF dirender kesini -->
    </div>
</div>
