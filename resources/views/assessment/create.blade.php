@extends('layouts.master')
@section('menuAssessment', 'active')
@section('style')
    <style>
        /* Custom styles for health app look */
        .card-primary.card-outline {
            border-top: 3px solid #007bff;
        }

        .nav-pills .nav-link.active,
        .nav-pills .show>.nav-link {
            background-color: #007bff;
            color: #fff;
        }

        .step-progress {
            background-color: #f8f9fa;
            border-radius: 0.5rem;
            padding: 10px;
        }

        .step-progress .nav-item {
            position: relative;
        }

        .step-progress .nav-item:not(:last-child):after {
            content: '';
            position: absolute;
            top: 50%;
            right: -5px;
            width: 10px;
            height: 2px;
            background-color: #dee2e6;
            transform: translateY(-50%);
            z-index: 0;
        }

        .step-progress .nav-link {
            border-radius: 50px;
            padding: 8px 12px;
            color: #6c757d;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .step-progress .nav-link:hover {
            background-color: #e9ecef;
        }

        .step-progress .step-icon {
            display: inline-block;
            width: 28px;
            height: 28px;
            line-height: 28px;
            text-align: center;
            border-radius: 50%;
            background-color: #e9ecef;
            color: #6c757d;
            margin-right: 5px;
        }

        .step-progress .nav-link.active .step-icon {
            background-color: #fff;
            color: #007bff;
        }

        label.form-label {
            font-weight: 500;
            color: #495057;
        }

        .form-control:focus {
            border-color: #80bdff;
            box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
        }

        textarea.form-control {
            min-height: 80px;
        }

        .document-preview {
            border: 1px solid #dee2e6;
        }

        /* Button styles */
        .btn-primary {
            background-color: #0d6efd;
            border-color: #0d6efd;
        }

        .btn-success {
            background-color: #198754;
            border-color: #198754;
        }

        .btn-danger {
            background-color: #dc3545;
            border-color: #dc3545;
        }

        .btn-secondary {
            background-color: #6c757d;
            border-color: #6c757d;
        }
    </style>
@endsection
@section('content')
    <form action="{{ route('assessment.store') }}" method="POST" enctype="multipart/form-data">
        @include('assessment.form', ['tombol' => 'Upload Hasil'])
    </form>
@endsection
@section('scripts')
    <script>
        $(document).ready(function() {
            // 1. Script untuk file upload
            $('input[type="file"]').on('change', function() {
                let filenames = [];
                let files = this.files;

                for (let i in files) {
                    if (files.hasOwnProperty(i)) {
                        filenames.push(files[i].name);
                    }
                }

                $(this).next('.custom-file-label').addClass("selected").html(filenames.join(', '));
            });
        });

        document.addEventListener('DOMContentLoaded', function() {
            // Initialize Select2 if jQuery is available
            if (typeof $ !== 'undefined') {
                $('.select2').select2({
                    theme: 'bootstrap4'
                });

                // Custom file input if available
                if (typeof bsCustomFileInput !== 'undefined') {
                    bsCustomFileInput.init();
                }
            }

            // Tab navigation with pure JavaScript
            // Next buttons
            const nextButtons = document.querySelectorAll('.next-tab');
            nextButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const nextTabId = this.getAttribute('data-next');
                    const nextTabLink = document.querySelector('.nav-pills a[href="#' + nextTabId +
                        '"]');

                    // Deactivate all tabs
                    document.querySelectorAll('.tab-pane').forEach(tab => {
                        tab.classList.remove('active');
                        tab.classList.remove('show');
                    });

                    // Deactivate all nav links
                    document.querySelectorAll('.nav-pills .nav-link').forEach(link => {
                        link.classList.remove('active');
                    });

                    // Activate the next tab
                    document.getElementById(nextTabId).classList.add('active');
                    document.getElementById(nextTabId).classList.add('show');
                    nextTabLink.classList.add('active');
                });
            });

            // Previous buttons
            const prevButtons = document.querySelectorAll('.prev-tab');
            prevButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const prevTabId = this.getAttribute('data-prev');
                    const prevTabLink = document.querySelector('.nav-pills a[href="#' + prevTabId +
                        '"]');

                    // Deactivate all tabs
                    document.querySelectorAll('.tab-pane').forEach(tab => {
                        tab.classList.remove('active');
                        tab.classList.remove('show');
                    });

                    // Deactivate all nav links
                    document.querySelectorAll('.nav-pills .nav-link').forEach(link => {
                        link.classList.remove('active');
                    });

                    // Activate the previous tab
                    document.getElementById(prevTabId).classList.add('active');
                    document.getElementById(prevTabId).classList.add('show');
                    prevTabLink.classList.add('active');
                });
            });

            // Handle tab navigation from the nav pills
            const tabLinks = document.querySelectorAll('.nav-pills .nav-link');
            tabLinks.forEach(link => {
                link.addEventListener('click', function(e) {
                    e.preventDefault();

                    // Get target tab
                    const target = this.getAttribute('href').substring(1); // Remove the #

                    // Deactivate all tabs
                    document.querySelectorAll('.tab-pane').forEach(tab => {
                        tab.classList.remove('active');
                        tab.classList.remove('show');
                    });

                    // Deactivate all nav links
                    document.querySelectorAll('.nav-pills .nav-link').forEach(link => {
                        link.classList.remove('active');
                    });

                    // Activate target tab
                    document.getElementById(target).classList.add('active');
                    document.getElementById(target).classList.add('show');
                    this.classList.add('active');
                });
            });
        });
    </script>


@endsection
