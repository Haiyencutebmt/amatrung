@extends('layouts.user')

@section('title', $article->title)

@section('styles')
<style>
    .article-container {
        background: #fff;
        border-radius: 16px;
        overflow: hidden;
        box-shadow: 0 4px 16px rgba(0,0,0,0.04);
        border: 1px solid #e8e2d8;
        padding: 40px;
        max-width: 900px;
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

    .article-title {
        font-size: 36px;
        color: #1a5632;
        margin-bottom: 16px;
        line-height: 1.3;
    }

    .article-meta {
        font-size: 15px;
        color: #88998c;
        margin-bottom: 30px;
        padding-bottom: 20px;
        border-bottom: 1px solid #f2ede5;
        display: flex;
        gap: 20px;
    }

    .article-img {
        width: 100%;
        max-height: 400px;
        object-fit: cover;
        border-radius: 12px;
        margin-bottom: 30px;
    }

    .article-summary {
        background: #f0f7f1;
        padding: 24px;
        border-radius: 12px;
        border-left: 4px solid #2f7d4a;
        font-size: 17px;
        color: #1a5632;
        font-style: italic;
        margin-bottom: 30px;
        line-height: 1.6;
    }

    .article-content {
        font-size: 17px;
        line-height: 1.8;
        color: #2d3a2e;
        white-space: pre-wrap;
    }

    .article-content img {
        max-width: 100%;
        height: auto;
        border-radius: 8px;
        margin: 20px 0;
    }

    /* Comments Section */
    .comments-section {
        margin-top: 60px;
        padding-top: 40px;
        border-top: 2px solid #e8e2d8;
    }

    .comments-title {
        font-size: 24px;
        color: #1a5632;
        margin-bottom: 30px;
    }

    .comment-form {
        background: #faf7f2;
        padding: 24px;
        border-radius: 12px;
        margin-bottom: 40px;
    }

    .comment-form textarea {
        width: 100%;
        padding: 16px;
        border: 1px solid #d9e4d8;
        border-radius: 12px;
        font-family: inherit;
        font-size: 16px;
        margin-bottom: 16px;
        resize: vertical;
        outline: none;
    }
    .comment-form textarea:focus {
        border-color: #2f7d4a;
    }

    .btn-submit-comment {
        background: #2f7d4a;
        color: white;
        border: none;
        padding: 12px 24px;
        border-radius: 10px;
        font-size: 16px;
        font-weight: 600;
        cursor: pointer;
        transition: background 0.2s;
    }
    .btn-submit-comment:hover {
        background: #1a5632;
    }

    .comment-list {
        display: flex;
        flex-direction: column;
        gap: 24px;
    }

    .comment-item {
        display: flex;
        gap: 16px;
    }

    .comment-avatar {
        width: 48px;
        height: 48px;
        border-radius: 50%;
        background: linear-gradient(135deg, #2f7d4a, #3a8a52);
        color: white;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 20px;
        font-weight: 700;
        flex-shrink: 0;
    }

    .comment-content-box {
        background: #f8f9fa;
        padding: 16px 20px;
        border-radius: 0 16px 16px 16px;
        border: 1px solid #e9ecef;
        flex: 1;
    }

    .comment-author {
        font-weight: 700;
        color: #1a5632;
        display: flex;
        justify-content: space-between;
        margin-bottom: 8px;
    }
    .comment-date {
        font-size: 13px;
        color: #88998c;
        font-weight: 400;
    }

    .comment-text {
        color: #2d3a2e;
        line-height: 1.6;
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
                        <button type="submit" class="btn-submit-comment">Gửi bình luận</button>
                    </form>
                </div>
            @else
                <div class="comment-form" style="text-align: center;">
                    <p style="margin-bottom: 15px; color: #5a6b5e;">Bạn phải đăng nhập để viết bình luận.</p>
                    <a href="{{ route('login') }}" class="btn-submit-comment" style="display:inline-block; text-decoration:none;">Đăng nhập ngay</a>
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
                    <p style="text-align: center; color: #88998c; font-style: italic; padding: 20px;">
                        Chưa có bình luận nào. Hãy là người đầu tiên bình luận!
                    </p>
                @endforelse
            </div>
        </div>
    </div>
@endsection
