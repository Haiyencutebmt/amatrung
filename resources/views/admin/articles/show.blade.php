@extends('layouts.admin')

@section('title', 'Xem bài viết')
@section('page-title', 'Chi tiết bài viết')

@include('admin.patients._form-styles')

@section('content')
    <div class="form-card">
        <div class="form-header">
            <h2>{{ $article->title }}</h2>
            <div style="display: flex; gap: 10px;">
                <a href="{{ route('admin.articles.edit', $article) }}" class="btn-submit" style="background: #e65100; text-decoration:none;">✏️ Sửa bài</a>
                <a href="{{ route('admin.articles.index') }}" class="btn-back">Quay lại</a>
            </div>
        </div>

        <div style="margin-top: 20px;">
            <p><strong>Ngày đăng:</strong> {{ $article->created_at->format('d/m/Y H:i') }} | <strong>Tác giả:</strong> {{ $article->author->name }} | <strong>Lượt xem:</strong> {{ $article->views }}</p>
            <p><strong>Trạng thái:</strong> 
                <span style="font-weight: bold; color: {{ $article->status == 'published' ? '#2e7d32' : '#616161' }}">
                    {{ $article->status == 'published' ? 'Xuất bản' : 'Bản nháp' }}
                </span>
            </p>
        </div>

        @if($article->image)
            <div style="margin-top: 20px; border-radius: 12px; overflow: hidden; max-width: 600px;">
                <img src="{{ asset('storage/' . $article->image) }}" alt="{{ $article->title }}" style="width: 100%; height: auto; display: block;">
            </div>
        @endif

        @if($article->summary)
            <div style="margin-top: 20px; padding: 20px; background: #faf7f2; border-left: 4px solid #2f7d4a; border-radius: 0 12px 12px 0;">
                <h4 style="margin: 0 0 10px 0; color: #1a5632;">Tóm tắt</h4>
                <p style="margin: 0; color: #5a6b5e; font-style: italic;">{{ $article->summary }}</p>
            </div>
        @endif

        <div style="margin-top: 30px; font-size: 16px; line-height: 1.8; color: #2d3a2e;">
            <h4 style="margin-bottom: 15px; border-bottom: 2px solid #e8e2d8; padding-bottom: 10px;">Nội dung chi tiết</h4>
            <div style="white-space: pre-wrap;">{{ $article->content }}</div>
        </div>
    </div>
@endsection
