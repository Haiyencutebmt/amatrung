@extends('layouts.user')

@section('title', 'Từ điển Dược liệu')

@section('styles')
<style>
    .herbs-header {
        text-align: center;
        margin-bottom: 56px;
    }
    .herbs-header h1 {
        font-size: 40px;
        font-weight: 800;
        color: var(--text-main);
        margin-bottom: 16px;
        letter-spacing: -1px;
    }
    .herbs-header p {
        color: var(--text-muted);
        font-size: 18px;
        max-width: 700px;
        margin: 0 auto;
        line-height: 1.8;
    }

    .search-container {
        max-width: 700px;
        margin: 0 auto 56px;
        display: flex;
        gap: 12px;
        background: #fff;
        padding: 8px;
        border-radius: 20px;
        box-shadow: var(--shadow-md);
        border: 1px solid var(--border);
    }

    .search-input {
        flex: 1;
        padding: 16px 24px;
        border: 1px solid transparent;
        border-radius: 16px;
        font-size: 17px;
        outline: none;
        transition: var(--transition);
        font-family: inherit;
        font-weight: 500;
        background: var(--bg-page);
    }
    .search-input:focus {
        background: #fff;
        border-color: var(--primary);
        box-shadow: 0 0 0 4px var(--primary-soft);
    }

    .btn-search {
        padding: 0 32px;
        background: var(--primary);
        color: white;
        border: none;
        border-radius: 14px;
        font-size: 16px;
        font-weight: 700;
        cursor: pointer;
        transition: var(--transition);
        display: flex;
        align-items: center;
        gap: 8px;
    }
    .btn-search:hover {
        background: var(--primary-hover);
        transform: translateY(-1px);
        box-shadow: 0 4px 12px rgba(37, 99, 235, 0.2);
    }

    .herbs-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
        gap: 32px;
    }

    .herb-card {
        background: var(--bg-card);
        border-radius: 24px;
        padding: 32px;
        box-shadow: var(--shadow-md);
        border: 1px solid var(--border);
        transition: var(--transition);
        text-decoration: none;
        display: flex;
        flex-direction: column;
        align-items: center;
        text-align: center;
    }

    .herb-card:hover {
        transform: translateY(-8px);
        box-shadow: var(--shadow-lg);
        border-color: var(--primary);
    }

    .herb-icon {
        font-size: 48px;
        margin-bottom: 24px;
        background: var(--primary-soft);
        width: 96px;
        height: 96px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 28px;
        transition: var(--transition);
        box-shadow: 0 4px 10px rgba(0,0,0,0.03);
    }

    .herb-card:hover .herb-icon {
        background: var(--primary);
        color: #fff;
        transform: rotate(10deg) scale(1.1);
    }

    .herb-title {
        font-size: 24px;
        font-weight: 800;
        color: var(--text-main);
        margin-bottom: 8px;
        letter-spacing: -0.5px;
    }

    .herb-origin {
        font-size: 14px;
        color: var(--text-muted);
        margin-bottom: 20px;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        display: flex;
        align-items: center;
        gap: 6px;
    }

    .herb-summary {
        font-size: 16px;
        color: var(--text-muted);
        line-height: 1.7;
        flex: 1;
    }

    .empty-state {
        text-align: center;
        padding: 80px 40px;
        color: var(--text-muted);
        background: var(--bg-card);
        border-radius: 24px;
        border: 1px solid var(--border);
        box-shadow: var(--shadow-md);
    }

    .empty-state h2 {
        font-size: 28px;
        font-weight: 800;
        color: var(--text-main);
        margin-bottom: 16px;
    }

    @media (max-width: 600px) {
        .search-container { flex-direction: column; padding: 12px; }
        .btn-search { height: 56px; width: 100%; justify-content: center; }
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
