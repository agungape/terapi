<script src="https://cdn.tailwindcss.com"></script>
<script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
<link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@400;600;700&display=swap" rel="stylesheet">

<style>
    body {
        font-family: 'Quicksand', sans-serif;
        background-color: #f8faff;
        overflow-x: hidden;
    }

    [x-cloak] {
        display: none !important;
    }

    .primary-purple {
        background: linear-gradient(135deg, #6366f1 0%, #a855f7 100%);
    }

    .primary-rose {
        background: linear-gradient(135deg, #f43f5e 0%, #fb7185 100%);
    }

    .primary-teal {
        background: linear-gradient(135deg, #0d9488 0%, #14b8a6 100%);
    }

    .primary-blue {
        background: linear-gradient(135deg, #3b82f6 0%, #60a5fa 100%);
    }

    .primary-green {
        background: linear-gradient(135deg, #10b981 0%, #34d399 100%);
    }

    .primary-orange {
        background: linear-gradient(135deg, #f97316 0%, #fb923c 100%);
    }

    .kid-card {
        border-radius: 30px;
        background: white;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }

    .active-nav {
        color: #6366f1;
        transform: translateY(-3px);
    }

    @keyframes float {
        0%, 100% {
            transform: translateY(0);
        }
        50% {
            transform: translateY(-10px);
        }
    }

    @keyframes bounce-in {
        0% {
            transform: translate(-50%, -20px);
            opacity: 0;
        }
        50% {
            transform: translate(-50%, 5px);
        }
        100% {
            transform: translate(-50%, 0);
            opacity: 1;
        }
    }

    @keyframes pulse {
        0%, 100% {
            opacity: 1;
        }
        50% {
            opacity: 0.5;
        }
    }

    @keyframes slide-up {
        from {
            transform: translateY(20px);
            opacity: 0;
        }
        to {
            transform: translateY(0);
            opacity: 1;
        }
    }

    .animate-float {
        animation: float 3s ease-in-out infinite;
    }

    .animate-bounce-in {
        animation: bounce-in 0.5s ease-out;
    }

    .animate-pulse-slow {
        animation: pulse 2s ease-in-out infinite;
    }

    .animate-slide-up {
        animation: slide-up 0.3s ease-out;
    }

    .scrollbar-thin::-webkit-scrollbar {
        width: 4px;
        height: 4px;
    }

    .scrollbar-thin::-webkit-scrollbar-track {
        background: #f1f1f1;
        border-radius: 10px;
    }

    .scrollbar-thin::-webkit-scrollbar-thumb {
        background: #c7d2fe;
        border-radius: 10px;
    }

    * {
        -webkit-tap-highlight-color: transparent;
    }

    .loader {
        width: 40px;
        height: 40px;
        border: 3px solid #e5e7eb;
        border-top-color: #6366f1;
        border-radius: 50%;
        animation: spin 1s linear infinite;
    }

    @keyframes spin {
        to {
            transform: rotate(360deg);
        }
    }

    .hover-lift {
        transition: transform 0.2s ease, box-shadow 0.2s ease;
    }

    .hover-lift:hover {
        transform: translateY(-4px);
        box-shadow: 0 20px 40px rgba(99, 102, 241, 0.1);
    }

    .ripple {
        position: relative;
        overflow: hidden;
    }

    .ripple:after {
        content: '';
        position: absolute;
        top: 50%;
        left: 50%;
        width: 5px;
        height: 5px;
        background: rgba(255, 255, 255, 0.5);
        opacity: 0;
        border-radius: 100%;
        transform: scale(1, 1) translate(-50%);
        transform-origin: 50% 50%;
    }

    .ripple:focus:after {
        animation: ripple 1s ease-out;
    }

    @keyframes ripple {
        0% {
            transform: scale(0, 0);
            opacity: 0.5;
        }
        100% {
            transform: scale(40, 40);
            opacity: 0;
        }
    }

    .status-badge {
        padding: 4px 12px;
        border-radius: 20px;
        font-size: 10px;
        font-weight: bold;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .status-confirmed {
        background: #dcfce7;
        color: #166534;
        border: 1px solid #bbf7d0;
    }

    .status-pending {
        background: #fef3c7;
        color: #92400e;
        border: 1px solid #fde68a;
    }

    .status-paid {
        background: #dbeafe;
        color: #1e40af;
        border: 1px solid #bfdbfe;
    }

    .status-upcoming {
        background: #f3e8ff;
        color: #6b21a8;
        border: 1px solid #e9d5ff;
    }

    .routine-time {
        background: linear-gradient(135deg, #f0f9ff 0%, #e0f2fe 100%);
        border-left: 4px solid #0ea5e9;
    }

    .milestone-achieved {
        background: linear-gradient(135deg, #f0fdf4 0%, #dcfce7 100%);
    }

    .milestone-progress {
        background: linear-gradient(135deg, #fef3c7 0%, #fde68a 100%);
    }

    .milestone-planned {
        background: linear-gradient(135deg, #f5f3ff 0%, #ede9fe 100%);
    }
</style>
