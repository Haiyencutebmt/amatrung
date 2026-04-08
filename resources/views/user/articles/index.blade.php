@extends('layouts.user')

@section('title', 'Kiến thức Y khoa')

@section('styles')
<style>
    .articles-header {
        text-align: center;
        margin-bottom: 40px;
    }
    .articles-header h1 {
        font-size: 32px;
        color: var(--primary);
        font-weight: 800;
        margin-bottom: 10px;
    }
    .articles-header p {
        color: var(--text-muted);
        font-size: 16px;
    }

    .articles-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
        gap: 30px;
    }

    .article-card {
        background: var(--bg-card);
        border-radius: var(--radius);
        overflow: hidden;
        box-shadow: var(--shadow-sm);
        transition: var(--transition);
        border: 1px solid var(--border);
        display: flex;
        flex-direction: column;
    }

    .article-card:hover {
        transform: translateY(-5px);
        box-shadow: var(--shadow-md);
        border-color: var(--primary-soft);
    }

    .article-img {
        width: 100%;
        height: 200px;
        object-fit: cover;
        background: var(--bg-page);
    }

    .article-content {
        padding: 24px;
        flex: 1;
        display: flex;
        flex-direction: column;
    }

    .article-meta {
        font-size: 13px;
        color: var(--text-muted);
        font-weight: 500;
        margin-bottom: 12px;
        display: flex;
        justify-content: space-between;
    }

    .article-title {
        font-size: 20px;
        font-weight: 700;
        color: var(--text-main);
        margin-bottom: 12px;
        line-height: 1.4;
    }
    
    .article-title a {
        color: inherit;
        text-decoration: none;
        transition: var(--transition);
    }
    
    .article-title a:hover {
        color: var(--primary);
    }

    .article-summary {
        font-size: 15px;
        color: var(--text-muted);
        line-height: 1.6;
        margin-bottom: 20px;
        flex: 1;
    }

    .btn-read-more {
        display: inline-block;
        padding: 12px 0;
        color: var(--primary);
        font-weight: 700;
        text-decoration: none;
        border-top: 1px solid var(--border);
        width: 100%;
        text-align: center;
        transition: var(--transition);
        margin-top: auto;
    }
    .btn-read-more:hover {
        color: var(--primary-hover);
        background: var(--primary-soft);
    }

    .empty-state {
        text-align: center;
        padding: 60px 20px;
        color: var(--text-muted);
        background: var(--bg-card);
        border-radius: var(--radius);
        border: 1px solid var(--border);
    }
</style>
@endsection

@section('content')
    <div class="articles-header">
        <h1>Kiến thức Y khoa</h1>
        <p>Cập nhật những thông tin, bài thuốc và phương pháp phòng bệnh từ các chuyên gia.</p>
    </div>

    @if($articles->count() > 0)
        <div class="articles-grid">
            @foreach($articles as $article)
                <div class="article-card">
                    @if($article->image)
                        <img src="{{ asset('storage/' . $article->image) }}" alt="{{ $article->title }}" class="article-img">
                    @else
                        <!-- Placeholder -->
                        <div class="article-img" style="display:flex; align-items:center; justify-content:center; color:#2f7d4a; font-size:40px;">🌿</div>
                    @endif
                    <div class="article-content">
                        <div class="article-meta">
                            <span>📅 {{ $article->created_at->format('d/m/Y') }}</span>
                            <span>💬 {{ $article->comments_count }} bình luận</span>
                        </div>
                        <h2 class="article-title">
                            <a href="{{ route('user.articles.show', $article->slug) }}">{{ $article->title }}</a>
                        </h2>
                        <p class="article-summary">{{ Str::limit($article->summary ?: strip_tags($article->content), 120) }}</p>
                        
                        <a href="{{ route('user.articles.show', $article->slug) }}" class="btn-read-more">Đọc tiếp →</a>
                    </div>
                </div>
            @endforeach
        </div>

        @if($articles->hasPages())
            <div style="margin-top: 40px; display:flex; justify-content:center;">
                {{ $articles->links() }}
            </div>
        @endif
    @else
        <div class="empty-state">
            <h2 style="font-size: 24px; color: var(--text-main); margin-bottom: 10px; font-weight: 800;">Chưa có bài viết nào</h2>
            <p>Phòng khám đang cập nhật các kiến thức y khoa. Vui lòng quay lại sau.</p>
        </div>
    @endif
@endsection
