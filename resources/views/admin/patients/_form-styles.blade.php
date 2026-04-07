{{-- Form bệnh nhân dùng chung cho create và edit --}}
@section('styles')
    .form-card {
        background: #ffffff;
        border-radius: 16px;
        padding: 36px;
        box-shadow: 0 2px 12px rgba(0, 0, 0, 0.04);
        border: 1px solid #e8e2d8;
        max-width: 800px;
    }

    .form-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 28px;
        padding-bottom: 16px;
        border-bottom: 2px solid #e8f5e9;
    }

    .form-header h2 {
        font-size: 22px;
        font-weight: 700;
        color: #1a5632;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .btn-back {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 10px 20px;
        background: #faf7f2;
        color: #5a6b5e;
        border: 1px solid #e8e2d8;
        border-radius: 10px;
        font-size: 14px;
        font-weight: 600;
        text-decoration: none;
        transition: all 0.15s;
        font-family: inherit;
    }

    .btn-back:hover {
        background: #f0ebe3;
        color: #2d3a2e;
    }

    .form-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 20px;
    }

    .form-grid .full-width {
        grid-column: 1 / -1;
    }

    .form-group {
        margin-bottom: 0;
    }

    .form-group label {
        display: block;
        font-size: 15px;
        font-weight: 600;
        color: #2d3a2e;
        margin-bottom: 8px;
    }

    .form-group label .required {
        color: #dc2626;
    }

    .form-control {
        width: 100%;
        padding: 13px 16px;
        border: 1px solid #d9e4d8;
        border-radius: 12px;
        font-size: 16px;
        font-family: inherit;
        color: #2d3a2e;
        outline: none;
        transition: border-color 0.2s, box-shadow 0.2s;
        background: #ffffff;
    }

    .form-control:focus {
        border-color: #2f7d4a;
        box-shadow: 0 0 0 3px rgba(47, 125, 74, 0.1);
    }

    .form-control.is-invalid {
        border-color: #dc2626;
        box-shadow: 0 0 0 3px rgba(220, 38, 38, 0.08);
    }

    select.form-control {
        appearance: none;
        background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' viewBox='0 0 12 12'%3E%3Cpath fill='%235a6b5e' d='M6 8L1 3h10z'/%3E%3C/svg%3E");
        background-repeat: no-repeat;
        background-position: right 14px center;
        padding-right: 36px;
    }

    textarea.form-control {
        resize: vertical;
        min-height: 90px;
    }

    .invalid-feedback {
        font-size: 13px;
        color: #dc2626;
        margin-top: 6px;
        display: flex;
        align-items: center;
        gap: 4px;
    }

    .form-actions {
        margin-top: 28px;
        padding-top: 20px;
        border-top: 1px solid #f2ede5;
        display: flex;
        gap: 12px;
    }

    .btn-submit {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 14px 32px;
        background: #2f7d4a;
        color: white;
        border: none;
        border-radius: 12px;
        font-size: 16px;
        font-weight: 600;
        cursor: pointer;
        font-family: inherit;
        transition: background 0.2s, transform 0.15s;
    }

    .btn-submit:hover {
        background: #1a5632;
        transform: translateY(-1px);
    }

    .btn-cancel {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 14px 28px;
        background: #faf7f2;
        color: #5a6b5e;
        border: 1px solid #e8e2d8;
        border-radius: 12px;
        font-size: 16px;
        font-weight: 600;
        cursor: pointer;
        text-decoration: none;
        font-family: inherit;
        transition: all 0.15s;
    }

    .btn-cancel:hover {
        background: #f0ebe3;
        color: #2d3a2e;
    }

    /* Error summary */
    .error-summary {
        background: #fff5f5;
        border: 1px solid #fecaca;
        border-radius: 12px;
        padding: 16px 20px;
        margin-bottom: 24px;
        color: #b91c1c;
        font-size: 15px;
    }

    .error-summary ul {
        margin: 8px 0 0;
        padding-left: 20px;
    }

    .error-summary li {
        margin-bottom: 4px;
    }

    @media (max-width: 600px) {
        .form-grid {
            grid-template-columns: 1fr;
        }
        .form-card {
            padding: 24px 18px;
        }
    }
@endsection
