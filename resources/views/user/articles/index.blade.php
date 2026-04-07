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
        color: #1a5632;
        margin-bottom: 10px;
    }
    .articles-header p {
        color: #5a6b5e;
        font-size: 16px;
    }

    .articles-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
        gap: 30px;
    }

    .article-card {
        background: #fff;
        border-radius: 16px;
        overflow: hidden;
        box-shadow: 0 4px 16px rgba(0,0,0,0.04);
        transition: transform 0.3s, box-shadow 0.3s;
        border: 1px solid #e8e2d8;
        display: flex;
        flex-direction: column;
    }

    .article-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 12px 24px rgba(0,0,0,0.08);
    }

    .article-img {
        width: 100%;
        height: 200px;
        object-fit: cover;
        background: #f0f7f1;
    }

    .article-content {
        padding: 24px;
        flex: 1;
        display: flex;
        flex-direction: column;
    }

    .article-meta {
        font-size: 13px;
        color: #88998c;
        margin-bottom: 12px;
        display: flex;
        justify-content: space-between;
    }

    .article-title {
        font-size: 20px;
        font-weight: 700;
        color: #1a5632;
        margin-bottom: 12px;
        line-height: 1.4;
    }

    .article-summary {
        font-size: 15px;
        color: #5a6b5e;
        line-height: 1.6;
        margin-bottom: 20px;
        flex: 1;
    }

    .btn-read-more {
        display: inline-block;
        padding: 10px 0;
        color: #2f7d4a;
        font-weight: 600;
        text-decoration: none;
        border-top: 1px solid #f2ede5;
        width: 100%;
        text-align: center;
        transition: color 0.2s;
        margin-top: auto;
    }
    .btn-read-more:hover {
        color: #1a5632;
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
                            <a href="{{ route('user.articles.show', $article->slug) }}" style="color:inherit;">{{ $article->title }}</a>
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
            <h2 style="font-size: 24px; color: #1a5632; margin-bottom: 10px;">Chưa có bài viết nào</h2>
            <p>Phòng khám đang cập nhật các kiến thức y khoa. Vui lòng quay lại sau.</p>
        </div>
    @endif
@endsection
