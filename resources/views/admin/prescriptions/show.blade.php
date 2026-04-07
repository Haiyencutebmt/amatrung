@extends('layouts.admin')

@section('title', 'Chi tiết Đơn thuốc')
@section('page-title', 'Chi tiết Đơn thuốc')

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
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .status-badge {
            display: inline-block;
            padding: 4px 12px;
            border-radius: 8px;
            font-size: 14px;
            font-weight: 600;
            text-transform: capitalize;
        }

        .status-active { background: #e3f2fd; color: #1565c0; }
        .status-completed { background: #e8f5e9; color: #2e7d32; }
        .status-cancelled { background: #ffebee; color: #c62828; }

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

        /* Medical Record box */
        .record-box {
            display: flex;
            align-items: center;
            justify-content: space-between;
            background: #e8f5e9;
            padding: 16px 20px;
            border-radius: 12px;
            margin-bottom: 20px;
            border: 1px solid #c8e6c9;
        }

        .record-info strong {
            font-size: 18px;
            color: #1a5632;
            display: block;
            margin-bottom: 4px;
        }

        .record-info span {
            color: #2d3a2e;
        }
    </style>
@endsection

@section('content')
    <div class="detail-card">
        <div class="detail-header">
            <h2>
                Mã đơn thuốc: {{ $prescription->prescription_code }}
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
                <a href="{{ route('admin.prescriptions.print', $prescription) }}" target="_blank" class="btn" style="background:#fff3e0; color:#e65100; border-color:#ffe0b2;">🖨 In đơn</a>
                <a href="{{ route('admin.prescriptions.edit', $prescription) }}" class="btn btn-primary">✏️ Sửa đơn</a>
                <a href="{{ route('admin.prescriptions.index') }}" class="btn btn-default">Quay lại</a>
            </div>
        </div>

        <div class="info-section">
            <h3>Hồ sơ bệnh án & Bệnh nhân</h3>
            <div class="record-box">
                <div class="record-info">
                    <strong>Hồ sơ: {{ $prescription->medicalRecord->record_code }}</strong>
                    <span>Bệnh nhân: {{ $prescription->medicalRecord->patient->full_name }} | Khám ngày: {{ $prescription->medicalRecord->visit_date->format('d/m/Y') }}</span>
                </div>
                <a href="{{ route('admin.medical-records.show', $prescription->medical_record_id) }}" class="btn btn-default" style="background:#fff;">📋 Xem hồ sơ gốc</a>
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
                    <div class="info-value">{{ $prescription->usage_instruction ?: 'Không có (Sẽ hướng dẫn theo từng vị thuốc)' }}</div>
                </div>

                <div class="info-item full-width">
                    <span class="info-label">Ghi chú, lời dặn thêm</span>
                    <div class="info-value">{{ $prescription->general_note ?: 'Không có' }}</div>
                </div>
            </div>
        </div>

        <div class="info-section" style="margin-top: 40px;">
            <h3>Chi tiết các vị thuốc (Tổng cộng: {{ $prescription->items->count() }} vị)</h3>
            <div style="background: #ffffff; border: 1px solid #d9e4d8; border-radius: 12px; overflow: hidden;">
                <table style="width: 100%; border-collapse: collapse;">
                    <thead>
                        <tr style="background: #faf7f2; border-bottom: 2px solid #e8e2d8;">
                            <th style="text-align: left; padding: 12px 18px; color: #5a6b5e; font-weight: 600;">STT</th>
                            <th style="text-align: left; padding: 12px 18px; color: #5a6b5e; font-weight: 600;">Tên Vị Thuốc</th>
                            <th style="text-align: center; padding: 12px 18px; color: #5a6b5e; font-weight: 600;">Số lượng</th>
                            <th style="text-align: left; padding: 12px 18px; color: #5a6b5e; font-weight: 600;">Ghi chú / Cách dùng riêng</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($prescription->items as $index => $item)
                        <tr style="border-bottom: 1px solid #f2ede5;">
                            <td style="padding: 12px 18px;">{{ $index + 1 }}</td>
                            <td style="padding: 12px 18px; font-weight: 500;">
                                <a href="{{ route('admin.medicinal-herbs.show', $item->medicinal_herb_id) }}" style="color: #1a5632; text-decoration: none;">
                                    {{ $item->herb->name }}
                                </a>
                            </td>
                            <td style="padding: 12px 18px; text-align: center;"><strong>{{ floatval($item->quantity) }}</strong> {{ $item->unit }}</td>
                            <td style="padding: 12px 18px;">{{ $item->instruction ?: '-' }}</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" style="text-align: center; padding: 20px;">Chưa có vị thuốc nào.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
