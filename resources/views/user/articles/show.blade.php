@extends('layouts.user')

@section('title', $article->title)

@section('styles')
<style>
    .article-container {
        background: var(--bg-card);
        border-radius: var(--radius);
        overflow: hidden;
        box-shadow: var(--shadow-sm);
        border: 1px solid var(--border);
        padding: 48px;
        max-width: 900px;
        margin: 0 auto;
    }

    .btn-back {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        margin-bottom: 32px;
        color: var(--text-muted);
        font-weight: 600;
        text-decoration: none;
        transition: var(--transition);
    }
    .btn-back:hover {
        color: var(--primary);
        transform: translateX(-4px);
    }

    .article-title {
        font-size: 36px;
        color: var(--text-main);
        font-weight: 800;
        margin-bottom: 24px;
        line-height: 1.3;
        letter-spacing: -1px;
    }

    .article-meta {
        font-size: 15px;
        color: var(--text-muted);
        font-weight: 500;
        margin-bottom: 40px;
        padding-bottom: 24px;
        border-bottom: 1px solid var(--border);
        display: flex;
        flex-wrap: wrap;
        gap: 24px;
    }

    .article-img {
        width: 100%;
        max-height: 480px;
        object-fit: cover;
        border-radius: var(--radius);
        margin-bottom: 40px;
        box-shadow: var(--shadow-md);
    }

    .article-summary {
        background: var(--primary-soft);
        padding: 32px;
        border-radius: var(--radius);
        border-left: 4px solid var(--primary);
        font-size: 18px;
        color: var(--text-main);
        font-weight: 500;
        font-style: italic;
        margin-bottom: 40px;
        line-height: 1.7;
    }

    .article-content {
        font-size: 18px;
        line-height: 1.8;
        color: var(--text-main);
        font-weight: 400;
    }

    .article-content img {
        max-width: 100%;
        height: auto;
        border-radius: var(--radius);
        margin: 32px 0;
        box-shadow: var(--shadow-sm);
    }

    /* Comments Section */
    .comments-section {
        margin-top: 64px;
        padding-top: 48px;
        border-top: 2px solid var(--border);
    }

    .comments-title {
        font-size: 28px;
        font-weight: 800;
        color: var(--text-main);
        margin-bottom: 32px;
        letter-spacing: -0.5px;
    }

    .comment-form {
        background: var(--bg-page);
        padding: 32px;
        border-radius: var(--radius);
        margin-bottom: 48px;
        border: 1px solid var(--border);
    }

    .comment-form textarea {
        width: 100%;
        padding: 20px;
        border: 1px solid var(--border);
        border-radius: 14px;
        font-family: inherit;
        font-size: 16px;
        margin-bottom: 16px;
        resize: vertical;
        outline: none;
        transition: var(--transition);
        background: var(--bg-card);
    }
    .comment-form textarea:focus {
        border-color: var(--primary);
        box-shadow: 0 0 0 4px var(--primary-soft);
    }

    .btn-submit-comment {
        background: var(--primary);
        color: white;
        border: none;
        padding: 14px 28px;
        border-radius: 12px;
        font-size: 16px;
        font-weight: 700;
        cursor: pointer;
        transition: var(--transition);
        display: inline-flex;
        align-items: center;
        gap: 8px;
    }
    .btn-submit-comment:hover {
        background: var(--primary-hover);
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(37, 99, 235, 0.2);
    }

    .comment-list {
        display: flex;
        flex-direction: column;
        gap: 32px;
    }

    .comment-item {
        display: flex;
        gap: 20px;
    }

    .comment-avatar {
        width: 52px;
        height: 52px;
        border-radius: 16px;
        background: linear-gradient(135deg, var(--primary), var(--primary-hover));
        color: white;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 20px;
        font-weight: 800;
        flex-shrink: 0;
        box-shadow: 0 4px 10px rgba(37, 99, 235, 0.15);
    }

    .comment-content-box {
        background: var(--bg-card);
        padding: 20px 24px;
        border-radius: 0 20px 20px 20px;
        border: 1px solid var(--border);
        flex: 1;
        box-shadow: var(--shadow-sm);
    }

    .comment-author {
        font-weight: 700;
        color: var(--text-main);
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 12px;
        font-size: 16px;
    }
    .comment-date {
        font-size: 13px;
        color: var(--text-muted);
        font-weight: 500;
    }

    .comment-text {
        color: var(--text-main);
        line-height: 1.7;
        white-space: pre-wrap;
    }
</style>
@endsection

@section('content')
    <div class="article-container">
        <a href="{{ route('user.articles.index') }}" class="btn-back">← Quay lại danh sách</a>

        <h1 class="article-title">{{ $article->title }}</h1>
        
        <div class="article-meta">
            <span>📅 {{ $article->created_at->format('d/m/Y H:i') }}</span>
            <span>✍️ Tác giả: {{ $article->author->name }}</span>
            <span>👁 {{ $article->views }} lượt xem</span>
        </div>

        @if($article->image)
            <img src="{{ asset('storage/' . $article->image) }}" alt="{{ $article->title }}" class="article-img">
        @endif

        @if($article->summary)
            <div class="article-summary">
                {{ $article->summary }}
            </div>
        @endif

        <div class="article-content">
            {{ $article->content }}
        </div>

        <div class="comments-section">
            <h2 class="comments-title">Bình luận ({{ $article->approvedComments->count() }})</h2>

            @auth
                <div class="comment-form">
                    <form action="{{ route('user.articles.comment', $article->id) }}" method="POST">
                        @csrf
                        <textarea name="content" rows="4" placeholder="Để lại bình luận của bạn..." required></textarea>
                        <button type="submit" class="btn-submit-comment">💬 Gửi bình luận</button>
                    </form>
                </div>
            @else
                <div class="comment-form" style="text-align: center;">
                    <p style="margin-bottom: 16px; color: var(--text-muted); font-size: 16px; font-weight: 500;">Vui lòng đăng nhập để tham gia bình luận.</p>
                    <a href="{{ route('login') }}" class="btn-submit-comment" style="text-decoration:none;">👋 Đăng nhập ngay</a>
                </div>
            @endauth

            <div class="comment-list">
                @forelse($article->approvedComments as $comment)
                    <div class="comment-item">
                        <div class="comment-avatar">
                            {{ strtoupper(substr($comment->user->name, 0, 1)) }}
                        </div>
                        <div class="comment-content-box">
                            <div class="comment-author">
                                {{ $comment->user->name }}
                                <span class="comment-date">{{ $comment->created_at->format('d/m/Y H:i') }}</span>
                            </div>
                            <div class="comment-text">{{ $comment->content }}</div>
                        </div>
                    </div>
                @empty
                    <p style="text-align: center; color: var(--text-muted); font-style: italic; padding: 30px; font-weight: 500;">
                        ✨ Chưa có bình luận nào. Hãy là người đầu tiên chia sẻ suy nghĩ của bạn!
                    </p>
                @endforelse
            </div>
        </div>
    </div>
@endsection
