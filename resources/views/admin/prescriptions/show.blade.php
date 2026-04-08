@extends('layouts.admin')

@section('title', 'Chi tiết Đơn thuốc')
@section('page-title', 'Chi tiết Đơn thuốc')

@section('styles')
    <style>
        .detail-card {
            background: var(--bg-card);
            border-radius: var(--radius-lg);
            padding: 48px;
            box-shadow: var(--shadow-lg);
            border: 1px solid var(--border);
            max-width: 1000px;
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

        .detail-header h2 {
            font-size: 28px;
            font-weight: 800;
            color: var(--text-main);
            display: flex;
            align-items: center;
            gap: 16px;
            letter-spacing: -0.5px;
        }

        .status-badge {
            display: inline-flex;
            align-items: center;
            padding: 6px 16px;
            border-radius: 12px;
            font-size: 13px;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .status-active {
            background: var(--primary-soft);
            color: var(--primary);
        }

        .status-completed {
            background: var(--accent-soft);
            color: var(--accent-hover);
        }

        .status-cancelled {
            background: #fef2f2;
            color: #dc2626;
        }

        .header-actions {
            display: flex;
            gap: 12px;
        }

        .btn-action {
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
            cursor: pointer;
            font-family: inherit;
        }

        .btn-print {
            background: #fff7ed;
            color: #ea580c;
            border-color: #ffedd5;
        }

        .btn-print:hover {
            background: #ea580c;
            color: #fff;
            transform: translateY(-2px);
        }

        .btn-edit {
            background: var(--primary-soft);
            color: var(--primary);
        }

        .btn-edit:hover {
            background: var(--primary);
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

        .info-section {
            margin-bottom: 40px;
        }

        .info-section h3 {
            font-size: 18px;
            color: var(--primary);
            margin-bottom: 20px;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: 1px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .info-section h3::after {
            content: "";
            flex: 1;
            height: 1px;
            background: var(--primary-soft);
        }

        .record-box {
            display: flex;
            align-items: center;
            justify-content: space-between;
            background: var(--primary-soft);
            padding: 24px 32px;
            border-radius: 20px;
            margin-bottom: 32px;
            border: 2px solid var(--border);
            gap: 20px;
        }

        .record-info strong {
            font-size: 20px;
            color: var(--primary);
            display: block;
            margin-bottom: 6px;
            font-weight: 800;
        }

        .record-info span {
            font-size: 16px;
            color: var(--text-main);
            font-weight: 600;
        }

        .info-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 24px;
        }

        .info-item.full-width {
            grid-column: 1 / -1;
        }

        .info-label {
            display: block;
            font-size: 12px;
            color: var(--text-muted);
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: 10px;
        }

        .info-value {
            font-size: 17px;
            color: var(--text-main);
            font-weight: 700;
            line-height: 1.6;
            background: var(--bg-page);
            padding: 18px 24px;
            border-radius: 16px;
            border: 1px solid var(--border);
            white-space: pre-wrap;
            box-shadow: var(--shadow-sm);
        }

        .items-table-wrapper {
            background: #fff;
            border: 1px solid var(--border);
            border-radius: 20px;
            overflow: hidden;
            box-shadow: var(--shadow-md);
        }

        .items-table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0;
        }

        .items-table thead th {
            background: #f8fafc;
            padding: 16px 20px;
            font-size: 13px;
            font-weight: 800;
            color: var(--text-muted);
            text-transform: uppercase;
            letter-spacing: 1px;
            border-bottom: 2px solid var(--border);
            text-align: left;
        }

        .items-table tbody td {
            padding: 18px 20px;
            font-size: 16px;
            color: var(--text-main);
            border-bottom: 1px solid var(--border);
            vertical-align: middle;
        }

        .items-table tbody tr:last-child td {
            border-bottom: none;
        }

        .herb-name {
            font-weight: 800;
            color: var(--primary);
            text-decoration: none;
            font-size: 17px;
        }

        .herb-name:hover {
            text-decoration: underline;
        }

        .quantity-badge {
            background: var(--accent-hover);
            color: #fff;
            padding: 4px 12px;
            border-radius: 8px;
            font-weight: 800;
            font-size: 15px;
        }

        @media (max-width: 768px) {
            .detail-card {
                padding: 32px 20px;
            }

            .record-box {
                flex-direction: column;
                align-items: stretch;
                text-align: center;
            }

            .info-grid {
                grid-template-columns: 1fr;
            }

            .btn-action {
                width: 100%;
                justify-content: center;
            }
        }
    </style>
@endsection

@section('content')
    <div class="detail-card">
        <div class="detail-header">
            <h2>
                <span style="color: var(--primary);">📄</span> Đơn thuốc: {{ $prescription->prescription_code }}
                <span class="status-badge status-{{ $prescription->status }}">
                    @if($prescription->status == 'active')
                        Đang sử dụng
                    @elseif($prescription->status == 'completed')
                        Hoàn thành
                    @else
                        Đã hủy
                    @endif
                </span>
            </h2>
            <div class="header-actions">
                <a href="{{ route('admin.prescriptions.print', $prescription) }}" target="_blank"
                    class="btn-action btn-print">🖨 In đơn</a>
                <a href="{{ route('admin.prescriptions.edit', $prescription) }}" class="btn-action btn-edit">✏️ Sửa đơn</a>
                <a href="{{ route('admin.prescriptions.index') }}" class="btn-action btn-back">Quay lại</a>
            </div>
        </div>

        <div class="info-section">
            <h3>Hồ sơ bệnh án & Bệnh nhân</h3>
            <div class="record-box">
                <div class="record-info">
                    <strong>Hồ sơ: {{ $prescription->medicalRecord->record_code }}</strong>
                    <span>Bệnh nhân: {{ $prescription->medicalRecord->patient->full_name }} | Khám ngày:
                        {{ $prescription->medicalRecord->visit_date->format('d/m/Y') }}</span>
                </div>
                <a href="{{ route('admin.medical-records.show', $prescription->medical_record_id) }}"
                    class="btn-action btn-back" style="background:#fff;">📋 Xem hồ sơ gốc</a>
            </div>
        </div>

        <div class="info-section">
            <h3>Thông tin đơn thuốc</h3>
            <div class="info-grid">
                <div class="info-item">
                    <span class="info-label">Ngày kê đơn</span>
                    <div class="info-value">{{ $prescription->prescribed_date->format('d/m/Y') }}</div>
                </div>
                <div class="info-item">
                    <span class="info-label">Chẩn đoán (từ hồ sơ)</span>
                    <div class="info-value">{{ $prescription->medicalRecord->diagnosis ?: 'Không có' }}</div>
                </div>

                <div class="info-item full-width">
                    <span class="info-label">Hướng dẫn sử dụng chung</span>
                    <div class="info-value">
                        {{ $prescription->usage_instruction ?: 'Không có (Sẽ hướng dẫn theo từng vị thuốc)' }}</div>
                </div>

                <div class="info-item full-width">
                    <span class="info-label">Ghi chú, lời dặn thêm</span>
                    <div class="info-value">{{ $prescription->general_note ?: 'Không có' }}</div>
                </div>
            </div>
        </div>

        <div class="info-section">
            <h3>Chi tiết các vị thuốc ({{ $prescription->items->count() }} vị)</h3>
            <div class="items-table-wrapper">
                <table class="items-table">
                    <thead>
                        <tr>
                            <th style="width: 60px; text-align: center;">STT</th>
                            <th>Tên Vị Thuốc</th>
                            <th style="text-align: center;">Số lượng</th>
                            <th>Ghi chú / Cách dùng riêng</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($prescription->items as $index => $item)
                            <tr>
                                <td style="text-align: center; font-weight: 700; color: var(--text-muted);">{{ $index + 1 }}
                                </td>
                                <td>
                                    <a href="{{ route('admin.medicinal-herbs.show', $item->medicinal_herb_id) }}"
                                        class="herb-name">
                                        🌿 {{ $item->herb->name }}
                                    </a>
                                </td>
                                <td style="text-align: center;">
                                    <span class="quantity-badge">{{ floatval($item->quantity) }} {{ $item->unit }}</span>
                                </td>
                                <td style="font-style: italic; color: var(--text-muted);">{{ $item->instruction ?: '-' }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4"
                                    style="text-align: center; padding: 40px; color: var(--text-muted); font-weight: 600;">
                                    Chưa có vị thuốc nào trong đơn này.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection