@extends('layouts.admin')

@section('title', 'Chi tiết Dược liệu')
@section('page-title', 'Chi tiết Dược liệu')

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

        .status-available { background: #e3f2fd; color: #1565c0; }
        .status-out_of_stock { background: #ffebee; color: #c62828; }
        .status-discontinued { background: #eeeeee; color: #616161; }

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
        
        .alert-box {
            background: #fff3e0;
            border-left: 4px solid #ff9800;
            padding: 16px 20px;
            border-radius: 8px;
            margin-bottom: 24px;
            color: #e65100;
            display: flex;
            align-items: center;
            gap: 10px;
            font-weight: 600;
        }

        .alert-danger {
            background: #ffebee;
            border-color: #f44336;
            color: #c62828;
        }
    </style>
@endsection

@section('content')
    <div class="detail-card">
        <div class="detail-header">
            <h2>
                🌿 {{ $medicinalHerb->name }}
                <span class="status-badge status-{{ $medicinalHerb->status }}">
                    @if($medicinalHerb->status == 'available')
                        Sẵn sàng
                    @elseif($medicinalHerb->status == 'out_of_stock')
                        Hết hàng
                    @else
                        Ngừng kinh doanh
                    @endif
                </span>
            </h2>
            <div class="header-actions">
                <a href="{{ route('admin.medicinal-herbs.edit', $medicinalHerb) }}" class="btn btn-primary">✏️ Cập nhật</a>
                <a href="{{ route('admin.medicinal-herbs.index') }}" class="btn btn-default">Quay lại</a>
            </div>
        </div>

        @if($medicinalHerb->quantity_in_stock == 0 && $medicinalHerb->status != 'discontinued')
            <div class="alert-box alert-danger">
                🚨 Cảnh báo: Dược liệu này đã hết hàng trong kho! Cần nhập thêm.
            </div>
        @elseif($medicinalHerb->quantity_in_stock > 0 && $medicinalHerb->quantity_in_stock <= 10)
            <div class="alert-box">
                ⚠️ Cảnh báo: Số lượng dược liệu trong kho sắp hết (Chỉ còn {{ floatval($medicinalHerb->quantity_in_stock) }} {{ $medicinalHerb->unit }}).
            </div>
        @endif

        @if($medicinalHerb->expiry_date && $medicinalHerb->expiry_date->isPast())
            <div class="alert-box alert-danger">
                🚨 Cảnh báo: Dược liệu này đã hết hạn sử dụng! (Hết hạn vào {{ $medicinalHerb->expiry_date->format('d/m/Y') }})
            </div>
        @elseif($medicinalHerb->expiry_date && $medicinalHerb->expiry_date->diffInDays(now()) <= 30)
            <div class="alert-box">
                ⚠️ Cảnh báo: Dược liệu sắp hết hạn trong vòng {{ intval($medicinalHerb->expiry_date->diffInDays(now())) }} ngày.
            </div>
        @endif

        <div class="info-section">
            <div class="info-grid">
                <div class="info-item">
                    <span class="info-label">Mã dược liệu</span>
                    <div class="info-value"><strong>{{ $medicinalHerb->herb_code }}</strong></div>
                </div>
                <div class="info-item">
                    <span class="info-label">Tôn kho / Đơn vị tính</span>
                    <div class="info-value"><strong>{{ floatval($medicinalHerb->quantity_in_stock) }}</strong> {{ $medicinalHerb->unit }}</div>
                </div>

                <div class="info-item">
                    <span class="info-label">Ngày hết hạn</span>
                    <div class="info-value">{{ $medicinalHerb->expiry_date ? $medicinalHerb->expiry_date->format('d/m/Y') : 'Không có hạn sử dụng' }}</div>
                </div>
                <div class="info-item">
                    <span class="info-label">Nguồn gốc / Xuất xứ</span>
                    <div class="info-value">{{ $medicinalHerb->origin ?: 'Không có thông tin' }}</div>
                </div>

                <div class="info-item full-width">
                    <span class="info-label">Ghi chú thêm</span>
                    <div class="info-value">{{ $medicinalHerb->note ?: 'Không có ghi chú' }}</div>
                </div>
            </div>
        </div>
    </div>
@endsection
