{{-- Form bệnh nhân dùng chung cho create và edit --}}
@section('styles')
    <style>
        .form-card {
            background: var(--bg-card);
            border-radius: var(--radius-lg);
            padding: 48px;
            box-shadow: var(--shadow-lg);
            border: 1px solid var(--border);
            max-width: 900px;
            margin: 0 auto;
            animation: fadeInUp 0.5s ease-out;
        }

        .form-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 40px;
            padding-bottom: 24px;
            border-bottom: 2px solid var(--primary-soft);
        }

        .form-header h2 {
            font-size: 28px;
            font-weight: 800;
            color: var(--text-main);
            display: flex;
            align-items: center;
            gap: 12px;
            letter-spacing: -1px;
        }

        .btn-back {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 10px 20px;
            background: var(--bg-page);
            color: var(--text-muted);
            border: 1px solid var(--border);
            border-radius: 12px;
            font-size: 14px;
            font-weight: 700;
            text-decoration: none;
            transition: var(--transition);
            font-family: inherit;
        }

        .btn-back:hover {
            background: #fff;
            color: var(--primary);
            border-color: var(--primary);
            transform: translateX(-4px);
        }

        .form-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 28px;
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
            font-weight: 700;
            color: var(--text-main);
            margin-bottom: 10px;
        }

        .form-group label .required {
            color: #dc2626;
        }

        .form-control {
            width: 100%;
            padding: 14px 18px;
            border: 1px solid var(--border);
            border-radius: 14px;
            font-size: 16px;
            font-family: inherit;
            color: var(--text-main);
            outline: none;
            transition: var(--transition);
            background: var(--bg-page);
            font-weight: 500;
        }

        .form-control:focus {
            background: #fff;
            border-color: var(--primary);
            box-shadow: 0 0 0 4px var(--primary-soft);
        }

        .form-control::placeholder {
            color: var(--text-muted);
            opacity: 0.6;
        }

        .form-control.is-invalid {
            border-color: #dc2626;
            background-color: #fef2f2;
        }

        select.form-control {
            appearance: none;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' viewBox='0 0 12 12'%3E%3Cpath fill='%2364748b' d='M6 8L1 3h10z'/%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: right 18px center;
            padding-right: 48px;
            cursor: pointer;
        }

        textarea.form-control {
            resize: vertical;
            min-height: 120px;
            line-height: 1.6;
        }

        .invalid-feedback {
            font-size: 13px;
            color: #dc2626;
            margin-top: 8px;
            display: flex;
            align-items: center;
            gap: 6px;
            font-weight: 600;
        }

        .form-actions {
            margin-top: 40px;
            padding-top: 32px;
            border-top: 1px solid var(--border);
            display: flex;
            gap: 16px;
        }

        .btn-submit {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            padding: 16px 40px;
            background: var(--primary);
            color: white;
            border: none;
            border-radius: 14px;
            font-size: 16px;
            font-weight: 700;
            cursor: pointer;
            font-family: inherit;
            transition: var(--transition);
            box-shadow: 0 4px 12px rgba(37, 99, 235, 0.2);
        }

        .btn-submit:hover {
            background: var(--primary-hover);
            transform: translateY(-2px);
            box-shadow: 0 8px 16px rgba(37, 99, 235, 0.3);
        }

        .btn-cancel {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            padding: 16px 32px;
            background: #fff;
            color: var(--text-muted);
            border: 1px solid var(--border);
            border-radius: 14px;
            font-size: 16px;
            font-weight: 700;
            cursor: pointer;
            text-decoration: none;
            font-family: inherit;
            transition: var(--transition);
        }

        .btn-cancel:hover {
            background: var(--bg-page);
            color: var(--text-main);
            border-color: var(--text-muted);
        }

        /* Error summary */
        .error-summary {
            background: #fef2f2;
            border: 1px solid #fecaca;
            border-radius: 16px;
            padding: 20px 24px;
            margin-bottom: 32px;
            color: #b91c1c;
            font-size: 15px;
            box-shadow: 0 2px 8px rgba(220, 38, 38, 0.05);
        }

        .error-summary ul {
            margin: 12px 0 0;
            padding-left: 24px;
        }

        .error-summary li {
            margin-bottom: 6px;
            font-weight: 500;
        }

        @media (max-width: 768px) {
            .form-card {
                padding: 32px 20px;
            }

            .form-grid {
                grid-template-columns: 1fr;
                gap: 20px;
            }

            .form-actions {
                flex-direction: column;
            }

            .btn-submit,
            .btn-cancel {
                width: 100%;
                justify-content: center;
            }
        }
    </style>
@endsection