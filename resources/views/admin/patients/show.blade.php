@extends('layouts.admin')

@section('title', 'Chi tiết bệnh nhân')
@section('page-title', 'Chi tiết bệnh nhân')

@section('styles')
    .detail-card {
        background: #ffffff;
        border-radius: 16px;
        padding: 36px;
        box-shadow: 0 2px 12px rgba(0, 0, 0, 0.04);
        border: 1px solid #e8e2d8;
        max-width: 800px;
    }

    .detail-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 28px;
        padding-bottom: 16px;
        border-bottom: 2px solid #e8f5e9;
        flex-wrap: wrap;
        gap: 12px;
    }

    .detail-header-left {
        display: flex;
        align-items: center;
        gap: 16px;
    }

    .detail-avatar {
        width: 64px;
        height: 64px;
        border-radius: 50%;
        background: linear-gradient(135deg, #2f7d4a, #3a8a52);
        color: white;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 26px;
        font-weight: 700;
        flex-shrink: 0;
        box-shadow: 0 4px 12px rgba(47, 125, 74, 0.3);
    }

    .detail-name {
        font-size: 24px;
        font-weight: 700;
        color: #1a5632;
    }

    .detail-id {
        font-size: 14px;
        color: #5a6b5e;
        margin-top: 2px;
    }

    .detail-actions {
        display: flex;
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
    }

    .btn-back:hover {
        background: #f0ebe3;
        color: #2d3a2e;
    }

    .btn-edit-detail {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 10px 20px;
        background: #fff3e0;
        color: #e65100;
        border: 1px solid #ffcc80;
        border-radius: 10px;
        font-size: 14px;
        font-weight: 600;
        text-decoration: none;
        transition: all 0.15s;
    }

    .btn-edit-detail:hover {
        background: #ffe0b2;
    }

    .detail-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 0;
    }

    .detail-item {
        padding: 16px 0;
        border-bottom: 1px solid #f2ede5;
    }

    .detail-item.full-width {
        grid-column: 1 / -1;
    }

    .detail-item:last-child {
        border-bottom: none;
    }

    .detail-label {
        font-size: 13px;
        font-weight: 600;
        color: #5a6b5e;
        text-transform: uppercase;
        letter-spacing: 0.3px;
        margin-bottom: 4px;
    }

    .detail-value {
        font-size: 17px;
        color: #2d3a2e;
        font-weight: 500;
        line-height: 1.6;
    }

    .gender-badge {
        display: inline-block;
        padding: 3px 14px;
        border-radius: 8px;
        font-size: 14px;
        font-weight: 600;
    }

    .gender-badge.male   { background: #e8f0fe; color: #1a56db; }
    .gender-badge.female { background: #fce4ec; color: #c62828; }
    .gender-badge.other  { background: #f3e8ff; color: #7c3aed; }

    .detail-timestamps {
        margin-top: 24px;
        padding-top: 16px;
        border-top: 2px solid #f2ede5;
        display: flex;
        gap: 32px;
        font-size: 13px;
        color: #8a9b8e;
    }

    @media (max-width: 600px) {
        .detail-grid {
            grid-template-columns: 1fr;
        }
        .detail-header {
            flex-direction: column;
            align-items: flex-start;
        }
        .detail-card {
            padding: 24px 18px;
        }
    }
@endsection

@section('content')
    <div class="detail-card">
        {{-- Header --}}
        <div class="detail-header">
            <div class="detail-header-left">
                <div class="detail-avatar">
                    {{ mb_strtoupper(mb_substr($patient->full_name, 0, 1)) }}
                </div>
                <div>
                    <div class="detail-name">{{ $patient->full_name }}</div>
                    <div class="detail-id">Mã bệnh nhân: #{{ $patient->id }}</div>
                </div>
            </div>
            <div class="detail-actions">
                <a href="{{ route('admin.patients.edit', $patient) }}" class="btn-edit-detail">✏️ Sửa</a>
                <a href="{{ route('admin.patients.index') }}" class="btn-back">← Quay lại</a>
            </div>
        </div>

        {{-- Thông tin chi tiết --}}
        <div class="detail-grid">
            <div class="detail-item">
                <div class="detail-label">👤 Họ và tên</div>
                <div class="detail-value">{{ $patient->full_name }}</div>
            </div>

            <div class="detail-item">
                <div class="detail-label">🧑 Giới tính</div>
                <div class="detail-value">
                    <span class="gender-badge {{ $patient->gender }}">
                        {{ $patient->gender_label }}
                    </span>
                </div>
            </div>

            <div class="detail-item">
                <div class="detail-label">🎂 Ngày sinh</div>
                <div class="detail-value">
                    @if($patient->date_of_birth)
                        {{ $patient->date_of_birth->format('d/m/Y') }}
                        <span style="color: #5a6b5e; font-size: 14px;">({{ $patient->age }} tuổi)</span>
                    @else
                        —
                    @endif
                </div>
            </div>

            <div class="detail-item">
                <div class="detail-label">📞 Số điện thoại</div>
                <div class="detail-value">{{ $patient->phone ?? '—' }}</div>
            </div>

            <div class="detail-item full-width">
                <div class="detail-label">📍 Địa chỉ</div>
                <div class="detail-value">{{ $patient->address ?? '—' }}</div>
            </div>

            <div class="detail-item full-width">
                <div class="detail-label">📝 Ghi chú</div>
                <div class="detail-value" style="white-space: pre-line;">{{ $patient->note ?? 'Không có ghi chú.' }}</div>
            </div>
        </div>

        {{-- Timestamps --}}
        <div class="detail-timestamps">
            <div>📅 Tạo lúc: {{ $patient->created_at->format('d/m/Y H:i') }}</div>
            <div>🔄 Cập nhật: {{ $patient->updated_at->format('d/m/Y H:i') }}</div>
        </div>
    </div>
@endsection
