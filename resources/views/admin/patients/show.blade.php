@extends('layouts.admin')

@section('title', 'Chi tiết bệnh nhân')
@section('page-title', 'Chi tiết bệnh nhân')

@section('styles')
<style>
    .detail-card {
        background: var(--bg-card);
        border-radius: var(--radius-lg);
        padding: 48px;
        box-shadow: var(--shadow-lg);
        border: 1px solid var(--border);
        max-width: 900px;
        margin: 0 auto;
        animation: fadeInUp 0.5s ease-out;
    }

    .detail-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 40px;
        padding-bottom: 24px;
        border-bottom: 2px solid var(--primary-soft);
        flex-wrap: wrap;
        gap: 20px;
    }

    .detail-header-left {
        display: flex;
        align-items: center;
        gap: 24px;
    }

    .detail-avatar {
        width: 80px;
        height: 80px;
        border-radius: 20px;
        background: linear-gradient(135deg, var(--primary), var(--primary-hover));
        color: white;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 32px;
        font-weight: 800;
        flex-shrink: 0;
        box-shadow: 0 8px 16px rgba(37, 99, 235, 0.2);
    }

    .detail-name {
        font-size: 32px;
        font-weight: 800;
        color: var(--text-main);
        letter-spacing: -1px;
    }

    .detail-id {
        font-size: 15px;
        color: var(--text-muted);
        margin-top: 4px;
        font-weight: 600;
    }

    .detail-actions {
        display: flex;
        gap: 12px;
    }

    .btn-detail-action {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 12px 24px;
        border-radius: 12px;
        font-size: 15px;
        font-weight: 700;
        text-decoration: none;
        transition: var(--transition);
        border: 1px solid transparent;
    }

    .btn-create-record {
        background: var(--accent-soft);
        color: var(--accent-hover);
        border-color: var(--accent-soft);
    }
    .btn-create-record:hover {
        background: var(--accent);
        color: #fff;
        transform: translateY(-2px);
    }

    .btn-edit-detail {
        background: #fff7ed;
        color: #ea580c;
        border-color: #ffedd5;
    }
    .btn-edit-detail:hover {
        background: #ea580c;
        color: #fff;
        transform: translateY(-2px);
    }

    .btn-back {
        background: var(--bg-page);
        color: var(--text-muted);
        border-color: var(--border);
    }
    .btn-back:hover {
        background: #fff;
        color: var(--primary);
        border-color: var(--primary);
        transform: translateX(-4px);
    }

    .detail-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 0;
    }

    .detail-item {
        padding: 20px 0;
        border-bottom: 1px solid var(--border);
    }

    .detail-item.full-width {
        grid-column: 1 / -1;
    }

    .detail-item:last-child {
        border-bottom: none;
    }

    .detail-label {
        font-size: 13px;
        font-weight: 800;
        color: var(--text-muted);
        text-transform: uppercase;
        letter-spacing: 1px;
        margin-bottom: 8px;
    }

    .detail-value {
        font-size: 18px;
        color: var(--text-main);
        font-weight: 700;
        line-height: 1.6;
    }

    .gender-badge {
        display: inline-flex;
        align-items: center;
        padding: 5px 14px;
        border-radius: 10px;
        font-size: 13px;
        font-weight: 800;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .gender-badge.male   { background: #eff6ff; color: #2563eb; }
    .gender-badge.female { background: #fff1f2; color: #e11d48; }
    .gender-badge.other  { background: #faf5ff; color: #9333ea; }

    .detail-timestamps {
        margin-top: 40px;
        padding-top: 24px;
        border-top: 2px solid var(--border);
        display: flex;
        gap: 40px;
        font-size: 14px;
        color: var(--text-muted);
        font-weight: 600;
    }

    @media (max-width: 768px) {
        .detail-card { padding: 32px 20px; }
        .detail-grid { grid-template-columns: 1fr; }
        .detail-header { flex-direction: column; align-items: flex-start; }
        .detail-actions { width: 100%; flex-wrap: wrap; }
        .btn-detail-action { flex: 1; justify-content: center; min-width: 140px; }
    }
</style>
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
                <a href="{{ route('admin.medical-records.create', ['patient_id' => $patient->id]) }}" class="btn-detail-action btn-create-record">
                    ➕ Tạo hồ sơ
                </a>
                <a href="{{ route('admin.patients.edit', $patient) }}" class="btn-detail-action btn-edit-detail">✏️ Sửa</a>
                <a href="{{ route('admin.patients.index') }}" class="btn-detail-action btn-back">← Quay lại</a>
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
