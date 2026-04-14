<style>
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

    /* Hide scrollbar for tabs */
    .hidden-scroll::-webkit-scrollbar {
        display: none;
    }
    .hidden-scroll {
        -ms-overflow-style: none;
        scrollbar-width: none;
    }

    /* Input Focus overrides */
    .form-control:focus {
        @apply ring-2 ring-red-100 border-red-500 outline-none;
    }
</style>
