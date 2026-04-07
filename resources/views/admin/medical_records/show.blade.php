@extends('layouts.admin')

@section('title', 'Chi tiết Hồ sơ bệnh án')
@section('page-title', 'Chi tiết Hồ sơ')

@section('styles')
    <style>
        .detail-card {
            background: #ffffff;
            border-radius: 16px;
            padding: 36px;
            box-shadow: 0 2px 12px rgba(0, 0, 0, 0.04);
            border: 1px solid #e8e2d8;
            max-width: 900px;
        }

        .detail-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 28px;
            padding-bottom: 16px;
            border-bottom: 2px solid #e8f5e9;
        }

        .detail-header h2 {
            font-size: 22px;
            font-weight: 700;
            color: #1a5632;
            margin: 0;
        }

        .header-actions {
            display: flex;
            gap: 12px;
        }

        .btn {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 10px 20px;
            border-radius: 10px;
            font-size: 14px;
            font-weight: 600;
            text-decoration: none;
            transition: all 0.15s;
            border: 1px solid transparent;
            cursor: pointer;
        }

        .btn-default {
            background: #faf7f2;
            color: #5a6b5e;
            border-color: #e8e2d8;
        }
        .btn-default:hover { background: #f0ebe3; color: #2d3a2e; }

        .btn-primary {
            background: #e8f5e9;
            color: #1a5632;
        }
        .btn-primary:hover { background: #c8e6c9; }

        /* Detail grid */
        .info-section {
            margin-bottom: 30px;
        }

        .info-section h3 {
            font-size: 18px;
            color: #1a5632;
            margin-bottom: 16px;
            padding-bottom: 8px;
            border-bottom: 1px solid #f2ede5;
        }

        .info-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
        }

        .info-item {
            margin-bottom: 12px;
        }

        .info-item.full-width {
            grid-column: 1 / -1;
        }

        .info-label {
            display: block;
            font-size: 13px;
            color: #5a6b5e;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 6px;
        }

        .info-value {
            font-size: 16px;
            color: #2d3a2e;
            font-weight: 500;
            line-height: 1.5;
            background: #faf7f2;
            padding: 14px 18px;
            border-radius: 12px;
            border: 1px solid #f2ede5;
            white-space: pre-wrap;
        }

        /* Patient box */
        .patient-box {
            display: flex;
            align-items: center;
            justify-content: space-between;
            background: #e8f5e9;
            padding: 16px 20px;
            border-radius: 12px;
            margin-bottom: 20px;
            border: 1px solid #c8e6c9;
        }

        .patient-info strong {
            font-size: 18px;
            color: #1a5632;
            display: block;
            margin-bottom: 4px;
        }

        .patient-info span {
            color: #2d3a2e;
        }
    </style>
@endsection

@section('content')
    <div class="detail-card">
        <div class="detail-header">
            <h2>Mã hồ sơ: {{ $medicalRecord->record_code }}</h2>
            <div class="header-actions">
                <a href="{{ route('admin.medical-records.edit', $medicalRecord) }}" class="btn btn-primary">✏️ Sửa hồ sơ</a>
                <a href="{{ route('admin.medical-records.index') }}" class="btn btn-default">Quay lại</a>
            </div>
        </div>

        <div class="info-section">
            <h3>Thông tin bệnh nhân</h3>
            <div class="patient-box">
                <div class="patient-info">
                    <strong>{{ $medicalRecord->patient->full_name }}</strong>
                    <span>Giới tính: {{ $medicalRecord->patient->gender_label }} | Tuổi: {{ $medicalRecord->patient->age ?: '—' }} | SĐT: {{ $medicalRecord->patient->phone ?: '—' }}</span>
                </div>
                <a href="{{ route('admin.patients.show', $medicalRecord->patient_id) }}" class="btn btn-default" style="background:#fff;">👁 Xem hồ sơ cá nhân</a>
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
                    <div class="info-value">{{ $medicalRecord->follow_up_date ? $medicalRecord->follow_up_date->format('d/m/Y') : '—' }}</div>
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
