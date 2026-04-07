@extends('layouts.user')

@section('title', 'Dược liệu: ' . $herb->name)

@section('styles')
<style>
    .herb-container {
        background: #fff;
        border-radius: 16px;
        overflow: hidden;
        box-shadow: 0 4px 16px rgba(0,0,0,0.04);
        border: 1px solid #e8e2d8;
        padding: 40px;
        max-width: 800px;
        margin: 0 auto;
    }

    .btn-back {
        display: inline-block;
        margin-bottom: 24px;
        color: #2f7d4a;
        font-weight: 500;
        text-decoration: none;
    }
    .btn-back:hover {
        text-decoration: underline;
    }

    .herb-header {
        display: flex;
        align-items: center;
        gap: 20px;
        margin-bottom: 30px;
        padding-bottom: 30px;
        border-bottom: 2px solid #f2ede5;
    }

    .herb-icon-large {
        font-size: 60px;
        width: 100px;
        height: 100px;
        background: #f0f7f1;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }

    .herb-title {
        font-size: 32px;
        color: #1a5632;
        margin-bottom: 8px;
        line-height: 1.2;
    }

    .herb-code {
        font-size: 16px;
        color: #88998c;
        display: inline-block;
        background: #f8f9fa;
        padding: 4px 12px;
        border-radius: 6px;
        border: 1px solid #e9ecef;
    }

    .info-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 24px;
        margin-bottom: 40px;
    }

    .info-item {
        background: #fafff8;
        padding: 20px;
        border-radius: 12px;
        border: 1px solid #e8f5e9;
    }

    .info-label {
        font-size: 14px;
        color: #5a6b5e;
        margin-bottom: 8px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        font-weight: 600;
    }

    .info-value {
        font-size: 18px;
        color: #2d3a2e;
        font-weight: 500;
    }

    .herb-content-section {
        background: #faf7f2;
        padding: 30px;
        border-radius: 12px;
        border-left: 4px solid #2f7d4a;
    }

    .herb-content-title {
        font-size: 20px;
        color: #1a5632;
        margin-bottom: 16px;
    }

    .herb-content-text {
        font-size: 18px;
        line-height: 1.8;
        color: #2d3a2e;
        white-space: pre-wrap;
    }

    @media (max-width: 600px) {
        .info-grid {
            grid-template-columns: 1fr;
        }
        .herb-header {
            flex-direction: column;
            text-align: center;
        }
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
