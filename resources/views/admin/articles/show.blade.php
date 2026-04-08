@extends('layouts.admin')

@section('title', 'Xem bài viết')
@section('page-title', 'Chi tiết bài viết')

@include('admin.patients._form-styles')

@section('styles')
<style>
    .status-badge {
        display: inline-flex;
        align-items: center;
        padding: 5px 14px;
        border-radius: 10px;
        font-size: 13px;
        font-weight: 800;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .status-published { background: var(--accent-soft); color: var(--accent); }
    .status-draft { background: var(--bg-page); color: var(--text-muted); }

    .article-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 32px;
        padding-bottom: 20px;
        border-bottom: 2px solid var(--primary-soft);
        flex-wrap: wrap;
        gap: 20px;
    }

    .article-header h2 {
        font-size: 28px;
        font-weight: 800;
        color: var(--text-main);
        margin: 0;
        flex: 1;
        letter-spacing: -0.5px;
    }

    .article-meta {
        display: flex;
        flex-wrap: wrap;
        gap: 24px;
        margin-bottom: 32px;
        color: var(--text-muted);
        font-size: 15px;
        font-weight: 600;
        background: var(--bg-page);
        padding: 16px 24px;
        border-radius: 16px;
        border: 1px solid var(--border);
    }

    .article-meta span {
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .article-meta strong {
        color: var(--primary);
        font-weight: 800;
    }

    .article-image-wrapper {
        margin-bottom: 32px;
        border-radius: 20px;
        overflow: hidden;
        box-shadow: var(--shadow-md);
        border: 1px solid var(--border);
        max-width: 800px;
    }

    .article-image-wrapper img {
        width: 100%;
        height: auto;
        display: block;
        transition: transform 0.3s ease;
    }

    .article-image-wrapper img:hover {
        transform: scale(1.02);
    }

    .summary-box {
        background: #f8fafc;
        border-left: 6px solid var(--accent);
        padding: 24px 32px;
        border-radius: 4px 20px 20px 4px;
        margin-bottom: 40px;
        box-shadow: var(--shadow-sm);
    }

    .summary-box h4 {
        margin: 0 0 12px 0;
        color: var(--accent);
        font-size: 18px;
        font-weight: 800;
        text-transform: uppercase;
        letter-spacing: 1px;
    }

    .summary-box p {
        margin: 0;
        color: var(--text-main);
        font-style: italic;
        line-height: 1.8;
        font-size: 17px;
        font-weight: 500;
    }

    .content-area {
        font-size: 18px;
        line-height: 2;
        color: var(--text-main);
        background: #fff;
        padding: 40px;
        border-radius: 24px;
        border: 1px solid var(--border);
        box-shadow: var(--shadow-sm);
    }

    .content-area h4 {
        font-size: 20px;
        margin-bottom: 24px;
        color: var(--primary);
        font-weight: 800;
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .content-area h4::after {
        content: "";
        flex: 1;
        height: 1px;
        background: var(--primary-soft);
    }

    .content-body {
        white-space: pre-wrap;
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

    .btn-edit { background: var(--primary-soft); color: var(--primary); }
    .btn-edit:hover { background: var(--primary); color: #fff; transform: translateY(-2px); }

    .btn-back { background: var(--bg-page); color: var(--text-muted); border-color: var(--border); }
    .btn-back:hover { background: #fff; color: var(--primary); border-color: var(--primary); transform: translateX(-4px); }

    @media (max-width: 768px) {
        .detail-card { padding: 32px 20px; }
        .article-header { flex-direction: column; align-items: flex-start; }
        .article-meta { flex-direction: column; gap: 12px; }
    }
</style>
@endsection

@section('content')
    <div class="form-card" style="padding: 48px;">
        <div class="article-header">
            <h2>{{ $article->title }}</h2>
            <div style="display: flex; gap: 12px;">
                <a href="{{ route('admin.articles.edit', $article) }}" class="btn-action btn-edit">✏️ Sửa bài</a>
                <a href="{{ route('admin.articles.index') }}" class="btn-action btn-back">Quay lại</a>
            </div>
        </div>

        <div class="article-meta">
            <span>📅 Ngày đăng: <strong>{{ $article->created_at->format('d/m/Y H:i') }}</strong></span>
            <span>👤 Tác giả: <strong>{{ $article->author->name }}</strong></span>
            <span>👁 Lượt xem: <strong>{{ $article->views }}</strong></span>
            <span>🏷 Trạng thái: 
                <span class="status-badge {{ $article->status == 'published' ? 'status-published' : 'status-draft' }}">
                    {{ $article->status == 'published' ? 'Xuất bản' : 'Bản nháp' }}
                </span>
            </span>
        </div>

        @if($article->image)
            <div class="article-image-wrapper">
                <img src="{{ asset('storage/' . $article->image) }}" alt="{{ $article->title }}">
            </div>
        @endif

        @if($article->summary)
            <div class="summary-box">
                <h4>Tóm tắt bài viết</h4>
                <p>{{ $article->summary }}</p>
            </div>
        @endif

        <div class="content-area">
            <h4>Nội dung chi tiết</h4>
            <div class="content-body">{{ $article->content }}</div>
        </div>
    </div>
@endsection
