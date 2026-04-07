@extends('layouts.user')

@section('title', 'Từ điển Dược liệu')

@section('styles')
<style>
    .herbs-header {
        text-align: center;
        margin-bottom: 40px;
    }
    .herbs-header h1 {
        font-size: 32px;
        color: #1a5632;
        margin-bottom: 10px;
    }
    .herbs-header p {
        color: #5a6b5e;
        font-size: 16px;
    }

    .search-container {
        max-width: 600px;
        margin: 0 auto 40px;
        display: flex;
        gap: 10px;
    }

    .search-input {
        flex: 1;
        padding: 14px 20px;
        border: 2px solid #e8e2d8;
        border-radius: 12px;
        font-size: 16px;
        outline: none;
        transition: border-color 0.2s;
        font-family: inherit;
    }
    .search-input:focus {
        border-color: #2f7d4a;
    }

    .btn-search {
        padding: 14px 24px;
        background: #2f7d4a;
        color: white;
        border: none;
        border-radius: 12px;
        font-size: 16px;
        font-weight: 600;
        cursor: pointer;
        transition: background 0.2s;
    }
    .btn-search:hover {
        background: #1a5632;
    }

    .herbs-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
        gap: 24px;
    }

    .herb-card {
        background: #fff;
        border-radius: 16px;
        padding: 24px;
        box-shadow: 0 4px 16px rgba(0,0,0,0.04);
        border: 1px solid #e8e2d8;
        transition: transform 0.3s, box-shadow 0.3s;
        text-decoration: none;
        display: flex;
        flex-direction: column;
    }

    .herb-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 12px 24px rgba(0,0,0,0.08);
        border-color: #2f7d4a;
    }

    .herb-icon {
        font-size: 40px;
        margin-bottom: 16px;
        text-align: center;
        background: #f0f7f1;
        width: 80px;
        height: 80px;
        line-height: 80px;
        border-radius: 50%;
        margin: 0 auto 20px;
    }

    .herb-title {
        font-size: 20px;
        font-weight: 700;
        color: #1a5632;
        margin-bottom: 8px;
        text-align: center;
    }

    .herb-origin {
        font-size: 14px;
        color: #88998c;
        text-align: center;
        margin-bottom: 16px;
    }

    .herb-summary {
        font-size: 15px;
        color: #5a6b5e;
        line-height: 1.6;
        text-align: center;
        flex: 1;
    }

    .empty-state {
        text-align: center;
        padding: 60px 20px;
        color: #5a6b5e;
        background: #fff;
        border-radius: 16px;
        border: 1px solid #e8e2d8;
    }
</style>
@endsection

@section('content')
    <div class="herbs-header">
        <h1>Từ điển Dược liệu</h1>
        <p>Tra cứu thông tin, nguồn gốc và công dụng của các loại thảo dược quý tại AmaTrung.</p>
    </div>

    <form action="{{ route('user.medicinal-herbs.index') }}" method="GET" class="search-container">
        <input type="text" name="search" class="search-input" placeholder="Nhập tên dược liệu cần tìm..." value="{{ request('search') }}">
        <button type="submit" class="btn-search">🔍 Tìm kiếm</button>
    </form>

    @if($herbs->count() > 0)
        <div class="herbs-grid">
            @foreach($herbs as $herb)
                <a href="{{ route('user.medicinal-herbs.show', $herb->id) }}" class="herb-card">
                    <div class="herb-icon">🌿</div>
                    <h2 class="herb-title">{{ $herb->name }}</h2>
                    <div class="herb-origin">📍 Nguồn gốc: {{ $herb->origin ?: 'Đang cập nhật' }}</div>
                    <p class="herb-summary">{{ Str::limit($herb->note ?: 'Thông tin công dụng đang được cập nhật thêm.', 80) }}</p>
                </a>
            @endforeach
        </div>

        @if($herbs->hasPages())
            <div style="margin-top: 40px; display:flex; justify-content:center;">
                {{ $herbs->links() }}
            </div>
        @endif
    @else
        <div class="empty-state">
            <h2 style="font-size: 24px; color: #1a5632; margin-bottom: 10px;">Không tìm thấy dược liệu</h2>
            <p>Vui lòng thử tìm với từ khóa khác.</p>
            @if(request('search'))
                <a href="{{ route('user.medicinal-herbs.index') }}" style="display:inline-block; margin-top:20px; color:#2f7d4a; text-decoration:underline;">Xem tất cả dược liệu</a>
            @endif
        </div>
    @endif
@endsection
