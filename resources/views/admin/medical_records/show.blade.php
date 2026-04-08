@extends('layouts.admin')

@section('title', 'Chi tiết Hồ sơ bệnh án')
@section('page-title', 'Chi tiết Hồ sơ')

@section('styles')
    <style>
        .detail-card {
            background: var(--bg-card);
            border-radius: var(--radius-lg);
            padding: 48px;
            box-shadow: var(--shadow-lg);
            border: 1px solid var(--border);
            max-width: 900px;
            animation: fadeInUp 0.5s ease-out;
        }

        .detail-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 36px;
            padding-bottom: 24px;
            border-bottom: 2px solid var(--primary-soft);
            flex-wrap: wrap;
            gap: 20px;
        }

        .detail-header h2 {
            font-size: 28px;
            font-weight: 800;
            color: var(--text-main);
            margin: 0;
            letter-spacing: -1px;
        }

        .header-actions {
            display: flex;
            gap: 12px;
            flex-wrap: wrap;
        }

        .btn {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 12px 24px;
            border-radius: 12px;
            font-size: 14px;
            font-weight: 700;
            text-decoration: none;
            transition: var(--transition);
            border: 1px solid transparent;
            cursor: pointer;
            font-family: inherit;
        }

        .btn-default {
            background: var(--bg-page);
            color: var(--text-muted);
            border-color: var(--border);
        }

        .btn-default:hover {
            background: #fff;
            color: var(--primary);
            border-color: var(--primary);
            transform: translateY(-2px);
        }

        .btn-primary {
            background: var(--primary-soft);
            color: var(--primary);
        }

        .btn-primary:hover {
            background: var(--primary);
            color: #fff;
            transform: translateY(-2px);
        }

        /* Detail grid */
        .info-section {
            margin-bottom: 36px;
        }

        .info-section h3 {
            font-size: 20px;
            font-weight: 800;
            color: var(--primary);
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .info-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 24px;
        }

        .info-item {
            margin-bottom: 0;
        }

        .info-item.full-width {
            grid-column: 1 / -1;
        }

        .info-label {
            display: block;
            font-size: 13px;
            color: var(--text-muted);
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: 8px;
        }

        .info-value {
            font-size: 17px;
            color: var(--text-main);
            font-weight: 600;
            line-height: 1.6;
            background: var(--bg-page);
            padding: 16px 20px;
            border-radius: 14px;
            border: 1px solid var(--border);
            white-space: pre-wrap;
        }

        /* Patient box */
        .patient-box {
            display: flex;
            align-items: center;
            justify-content: space-between;
            background: var(--primary-soft);
            padding: 24px;
            border-radius: 16px;
            margin-bottom: 24px;
            border: 1px solid var(--primary);
            gap: 16px;
            flex-wrap: wrap;
        }

        .patient-info strong {
            font-size: 20px;
            color: var(--text-main);
            display: block;
            margin-bottom: 6px;
            font-weight: 800;
        }

        .patient-info span {
            color: var(--text-muted);
            font-weight: 600;
            font-size: 15px;
        }

        @media (max-width: 768px) {
            .detail-card {
                padding: 32px 20px;
            }

            .info-grid {
                grid-template-columns: 1fr;
            }

            .detail-header {
                flex-direction: column;
                align-items: flex-start;
            }

            .header-actions {
                width: 100%;
            }

            .patient-box {
                flex-direction: column;
                align-items: flex-start;
            }
        }
    </style>
@endsection

@section('content')
    <div class="detail-card">
        <div class="detail-header">
            <h2>Mã hồ sơ: {{ $medicalRecord->record_code }}</h2>
            <div class="header-actions">
                <a href="{{ route('admin.prescriptions.create', ['medical_record_id' => $medicalRecord->id]) }}" class="btn"
                    style="background: var(--accent-soft); color: var(--accent-hover); border-color: var(--accent);">💊 Tạo
                    đơn thuốc</a>
                <a href="{{ route('admin.medical-records.edit', $medicalRecord) }}" class="btn btn-primary">✏️ Sửa hồ sơ</a>
                <a href="{{ route('admin.medical-records.index') }}" class="btn btn-default">Quay lại</a>
            </div>
        </div>

        <div class="info-section">
            <h3>Thông tin bệnh nhân</h3>
            <div class="patient-box">
                <div class="patient-info">
                    <strong>{{ $medicalRecord->patient->full_name }}</strong>
                    <span>Giới tính: {{ $medicalRecord->patient->gender_label }} | Tuổi:
                        {{ $medicalRecord->patient->age ?: '—' }} | SĐT: {{ $medicalRecord->patient->phone ?: '—' }}</span>
                </div>
                <a href="{{ route('admin.patients.show', $medicalRecord->patient_id) }}" class="btn btn-default">👁 Xem hồ
                    sơ cá nhân</a>
            </div>
        </div>

        <div class="info-section">
            <h3>Thông tin khám bệnh</h3>
            <div class="info-grid">
                <div class="info-item">
                    <span class="info-label">Ngày khám</span>
                    <div class="info-value">{{ $medicalRecord->visit_date->format('d/m/Y') }}</div>
                </div>
                <div class="info-item">
                    <span class="info-label">Ngày tái khám</span>
                    <div class="info-value">
                        {{ $medicalRecord->follow_up_date ? $medicalRecord->follow_up_date->format('d/m/Y') : '—' }}
                    </div>
                </div>

                <div class="info-item full-width">
                    <span class="info-label">Triệu chứng</span>
                    <div class="info-value">{{ $medicalRecord->symptoms }}</div>
                </div>

                <div class="info-item full-width">
                    <span class="info-label">Chẩn đoán</span>
                    <div class="info-value">{{ $medicalRecord->diagnosis ?: 'Đang chờ cập nhật...' }}</div>
                </div>

                <div class="info-item full-width">
                    <span class="info-label">Ghi chú điều trị / Hướng xử lý</span>
                    <div class="info-value">{{ $medicalRecord->treatment_note ?: 'Đang chờ cập nhật...' }}</div>
                </div>

                <div class="info-item full-width">
                    <span class="info-label">Ghi chú chung</span>
                    <div class="info-value">{{ $medicalRecord->note ?: 'Không có' }}</div>
                </div>
            </div>
        </div>
    </div>
@endsection