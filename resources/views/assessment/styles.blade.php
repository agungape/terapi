<!-- Select2 -->
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@ttskch/select2-bootstrap4-theme@1.5.2/dist/select2-bootstrap4.min.css">

<style>
    /* Custom Scrollbar Premium */
    ::-webkit-scrollbar {
        width: 6px;
        height: 6px;
    }
    ::-webkit-scrollbar-track {
        background: transparent;
    }
    ::-webkit-scrollbar-thumb {
        @apply bg-slate-200 rounded-full hover:bg-slate-300 transition-colors;
    }

    /* Tab System CSS for Tailwind Mix */
    .tab-content {
        position: relative;
    }
    
    .tab-pane {
        display: none;
        opacity: 0;
        transition: opacity 0.3s ease-in-out;
    }
    
    .tab-pane.active {
        display: block;
        opacity: 1;
        animation: slideUp 0.4s cubic-bezier(0.16, 1, 0.3, 1);
    }
    
    @keyframes slideUp {
        from {
            opacity: 0;
            transform: translateY(15px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    /* Active State for Nav Pills */
    .nav-pills .nav-link.active .step-icon {
        @apply bg-red-500 text-white shadow-lg shadow-red-200 mt-0;
        transform: scale(1.1);
    }
    
    .nav-pills .nav-link.active span {
        @apply text-red-600 font-black;
    }

    /* Input Focus overrides */
    .form-control:focus {
        @apply ring-4 ring-red-50 border-red-500 outline-none transition-all;
    }

    /* Premium Select2 Styling */
    .select2-container .select2-selection--single {
        @apply h-[50px] border border-slate-200 rounded-[1rem] bg-white shadow-sm transition-all !important;
    }

    .select2-container--bootstrap4 .select2-selection--single .select2-selection__rendered {
        @apply px-6 py-[14px] text-sm font-black text-slate-700 uppercase tracking-tight !important;
    }

    .select2-container--bootstrap4 .select2-selection--single .select2-selection__arrow {
        @apply h-full right-4 !important;
    }

    /* Focus ring for select2 */
    .select2-container--bootstrap4.select2-container--focus .select2-selection {
        @apply ring-4 ring-red-50 border-red-500 shadow-xl shadow-red-100/20 !important;
    }

    /* Select2 Dropdown Premium */
    .select2-dropdown {
        @apply border-slate-100 shadow-2xl rounded-2xl overflow-hidden animate-in fade-in zoom-in-95 duration-200 !important;
    }

    .select2-results__option {
        @apply px-6 py-3 text-xs font-bold text-slate-600 !important;
    }

    .select2-results__option--highlighted {
        @apply bg-red-50 text-red-600 !important;
    }
</style>
