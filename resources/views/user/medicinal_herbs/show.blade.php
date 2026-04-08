@extends('layouts.user')

@section('title', 'Dược liệu: ' . $herb->name)

@section('styles')
<style>
    .herb-container {
        background: var(--bg-card);
        border-radius: var(--radius-lg);
        overflow: hidden;
        box-shadow: var(--shadow-lg);
        border: 1px solid var(--border);
        padding: 60px;
        max-width: 900px;
        margin: 0 auto;
        animation: fadeInUp 0.6s ease-out;
    }

    .btn-back {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        margin-bottom: 32px;
        color: var(--primary);
        font-weight: 700;
        text-decoration: none;
        transition: var(--transition);
        font-size: 16px;
    }
    .btn-back:hover {
        color: var(--primary-hover);
        transform: translateX(-4px);
    }

    .herb-header {
        display: flex;
        align-items: center;
        gap: 32px;
        margin-bottom: 40px;
        padding-bottom: 40px;
        border-bottom: 2px solid var(--primary-soft);
    }

    .herb-icon-large {
        font-size: 64px;
        width: 120px;
        height: 120px;
        background: var(--primary-soft);
        border-radius: 32px;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
        box-shadow: 0 8px 20px rgba(37, 99, 235, 0.1);
        color: var(--primary);
    }

    .herb-title {
        font-size: 40px;
        font-weight: 800;
        color: var(--text-main);
        margin-bottom: 12px;
        line-height: 1.1;
        letter-spacing: -1px;
    }

    .herb-code {
        font-size: 15px;
        color: var(--primary);
        font-weight: 700;
        display: inline-block;
        background: var(--primary-soft);
        padding: 6px 16px;
        border-radius: 10px;
        border: 1px solid var(--primary);
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .info-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 28px;
        margin-bottom: 48px;
    }

    .info-item {
        background: var(--bg-page);
        padding: 24px;
        border-radius: 20px;
        border: 1px solid var(--border);
        transition: var(--transition);
    }

    .info-item:hover {
        background: #fff;
        border-color: var(--primary);
        box-shadow: var(--shadow-md);
    }

    .info-label {
        font-size: 13px;
        color: var(--text-muted);
        margin-bottom: 8px;
        text-transform: uppercase;
        letter-spacing: 1px;
        font-weight: 800;
    }

    .info-value {
        font-size: 20px;
        color: var(--text-main);
        font-weight: 700;
    }

    .herb-content-section {
        background: #fff;
        padding: 40px;
        border-radius: 24px;
        border: 2px solid var(--accent-hover);
        position: relative;
        box-shadow: 0 4px 20px rgba(16, 185, 129, 0.05);
    }

    .herb-content-section::before {
        content: "💡";
        position: absolute;
        top: -24px;
        left: 32px;
        font-size: 32px;
        background: #fff;
        padding: 0 8px;
    }

    .herb-content-title {
        font-size: 24px;
        font-weight: 800;
        color: var(--accent-hover);
        margin-bottom: 20px;
        letter-spacing: -0.5px;
    }

    .herb-content-text {
        font-size: 18px;
        line-height: 1.8;
        color: var(--text-main);
        white-space: pre-wrap;
        font-weight: 500;
    }

    @media (max-width: 768px) {
        .herb-container { padding: 32px 20px; }
        .info-grid { grid-template-columns: 1fr; gap: 16px; }
        .herb-header { flex-direction: column; text-align: center; gap: 20px; }
        .herb-title { font-size: 32px; }
    }
</style>
@endsection

@section('content')
    <div class="herb-container">
        <a href="{{ route('user.medicinal-herbs.index') }}" class="btn-back">← Quay lại Từ điển</a>

        <div class="herb-header">
            <div class="herb-icon-large">🌿</div>
            <div>
                <h1 class="herb-title">{{ $herb->name }}</h1>
                <div class="herb-code">Mã: {{ $herb->herb_code }}</div>
            </div>
        </div>

        <div class="info-grid">
            <div class="info-item">
                <div class="info-label">📍 Nguồn gốc / Xuất xứ</div>
                <div class="info-value">{{ $herb->origin ?: 'Đang cập nhật' }}</div>
            </div>
            <div class="info-item">
                <div class="info-label">📏 Đơn vị tính</div>
                <div class="info-value">{{ $herb->unit }}</div>
            </div>
        </div>

        <div class="herb-content-section">
            <h2 class="herb-content-title">💡 Công dụng & Ghi chú</h2>
            <div class="herb-content-text">{{ $herb->note ?: 'Thông tin chi tiết về công dụng của vị thuốc này đang được các phòng khám AmaTrung tiếp tục cập nhật.' }}</div>
        </div>
        
        <div style="margin-top: 30px; text-align: center; color: #88998c; font-style: italic; font-size: 14px;">
            Lưu ý: Thông tin dược liệu mang tính tham khảo. Quý khách vui lòng được thăm khám bởi thầy thuốc trước khi sử dụng.
        </div>
    </div>
@endsection
