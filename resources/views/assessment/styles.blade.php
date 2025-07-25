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
        border-radius: 10px;
        padding: 10px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
    }

    .step-progress .nav-pills {
        position: relative;
    }

    .step-progress .nav-item {
        position: relative;
        flex: 1;
        text-align: center;
    }

    .step-progress .nav-item:not(:last-child):after {
        content: '';
        position: absolute;
        top: 50%;
        right: 0;
        width: 1px;
        height: 20px;
        background-color: #dee2e6;
        transform: translateY(-50%);
        z-index: 1;
    }

    .step-progress .nav-link {
        border-radius: 5px;
        padding: 10px 5px;
        color: #6c757d;
        font-weight: 500;
        transition: all 0.3s ease;
        display: flex;
        flex-direction: column;
        align-items: center;
        background: none;
        border: none;
    }

    .step-progress .nav-link:hover {
        background-color: rgba(0, 123, 255, 0.1);
    }

    .step-progress .nav-link.active {
        background-color: transparent;
        color: #007bff;
    }

    .step-progress .nav-link.active .step-icon {
        background-color: #007bff;
        color: white;
    }

    .step-progress .step-icon {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 30px;
        height: 30px;
        border-radius: 50%;
        background-color: #e9ecef;
        color: #6c757d;
        margin-bottom: 5px;
        font-size: 14px;
        transition: all 0.3s ease;
    }

    @media (min-width: 768px) {
        .step-progress .nav-link {
            flex-direction: row;
            justify-content: center;
        }

        .step-progress .step-icon {
            margin-bottom: 0;
            margin-right: 8px;
        }
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


<style>
    #checklistTable td {
        vertical-align: middle;
        padding: 12px;
    }

    #checklistTable input,
    #checklistTable select {
        border: none;
        background: transparent;
    }

    #checklistTable input:focus,
    #checklistTable select:focus {
        background: white;
        box-shadow: 0 0 0 2px #e9ecef;
    }

    .modal-xl {
        max-width: 90%;
    }
</style>
