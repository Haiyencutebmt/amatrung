@extends('layouts.admin')

@section('title', 'Chi tiết Dược liệu')
@section('page-title', 'Chi tiết Dược liệu')

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

    .detail-header h2 {
        font-size: 32px;
        font-weight: 800;
        color: var(--text-main);
        display: flex;
        align-items: center;
        gap: 16px;
        letter-spacing: -1px;
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

    .status-available { background: var(--primary-soft); color: var(--primary); }
    .status-out_of_stock { background: #fef2f2; color: #dc2626; }
    .status-discontinued { background: var(--bg-page); color: var(--text-muted); }

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

    /* Detail grid */
    .info-section {
        margin-top: 32px;
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
    
    .alert-box {
        background: #fff7ed;
        border: 1px solid #ffedd5;
        padding: 24px;
        border-radius: var(--radius);
        margin-bottom: 32px;
        color: #ea580c;
        display: flex;
        align-items: center;
        gap: 16px;
        font-weight: 700;
        box-shadow: var(--shadow-sm);
    }

    .alert-danger {
        background: #fef2f2;
        border-color: #fee2e2;
        color: #dc2626;
    }

    .alert-icon {
        font-size: 24px;
    }

    @media (max-width: 768px) {
        .detail-card { padding: 32px 20px; }
        .info-grid { grid-template-columns: 1fr; }
        .detail-header { flex-direction: column; align-items: flex-start; }
        .header-actions { width: 100%; }
        .btn-action { flex: 1; justify-content: center; }
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
                <a href="{{ route('admin.medicinal-herbs.edit', $medicinalHerb) }}" class="btn-action btn-edit">✏️ Cập nhật</a>
                <a href="{{ route('admin.medicinal-herbs.index') }}" class="btn-action btn-back">Quay lại</a>
            </div>
        </div>

        @if($medicinalHerb->quantity_in_stock == 0 && $medicinalHerb->status != 'discontinued')
            <div class="alert-box alert-danger">
                <span class="alert-icon">🚨</span> Cảnh báo: Dược liệu này đã hết hàng trong kho! Cần nhập thêm.
            </div>
        @elseif($medicinalHerb->quantity_in_stock > 0 && $medicinalHerb->quantity_in_stock <= 10)
            <div class="alert-box">
                <span class="alert-icon">⚠️</span> Cảnh báo: Số lượng dược liệu trong kho sắp hết (Chỉ còn {{ floatval($medicinalHerb->quantity_in_stock) }} {{ $medicinalHerb->unit }}).
            </div>
        @endif

        @if($medicinalHerb->expiry_date && $medicinalHerb->expiry_date->isPast())
            <div class="alert-box alert-danger">
                <span class="alert-icon">🚨</span> Cảnh báo: Dược liệu này đã hết hạn sử dụng! (Hết hạn vào {{ $medicinalHerb->expiry_date->format('d/m/Y') }})
            </div>
        @elseif($medicinalHerb->expiry_date && $medicinalHerb->expiry_date->diffInDays(now()) <= 30)
            <div class="alert-box">
                <span class="alert-icon">⚠️</span> Cảnh báo: Dược liệu sắp hết hạn trong vòng {{ intval($medicinalHerb->expiry_date->diffInDays(now())) }} ngày.
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
