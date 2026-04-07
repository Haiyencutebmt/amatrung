@extends('layouts.admin')

@section('title', 'Sửa bài viết')
@section('page-title', 'Sửa bài viết')

@include('admin.patients._form-styles')

@section('content')
    <div class="form-card">
        <div class="form-header">
            <h2>Chỉnh sửa: {{ $article->title }}</h2>
            <a href="{{ route('admin.articles.index') }}" class="btn-back">Quay lại</a>
        </div>

        @if($errors->any())
            <div class="error-summary">
                <strong>Vui lòng kiểm tra lại:</strong>
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.articles.update', $article) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            
            <div class="form-grid">
                <div class="form-group full-width">
                    <label for="title">Tiêu đề <span class="required">*</span></label>
                    <input type="text" id="title" name="title" value="{{ old('title', $article->title) }}" 
                           class="form-control" required placeholder="Nhập tiêu đề...">
                </div>

                <div class="form-group">
                    <label for="status">Trạng thái <span class="required">*</span></label>
                    <select name="status" id="status" class="form-control" required>
                        <option value="published" {{ old('status', $article->status) == 'published' ? 'selected' : '' }}>Xuất bản</option>
                        <option value="draft" {{ old('status', $article->status) == 'draft' ? 'selected' : '' }}>Bản nháp</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="image">Ảnh đại diện (tuỳ chọn)</label>
                    <input type="file" id="image" name="image" class="form-control" accept="image/*">
                    @if($article->image)
                        <div style="margin-top: 10px;">
                            <img src="{{ asset('storage/' . $article->image) }}" alt="Current Image" style="max-height: 100px; border-radius: 8px;">
                        </div>
                    @endif
                </div>

                <div class="form-group full-width">
                    <label for="summary">Tóm tắt / Mô tả ngắn</label>
                    <textarea id="summary" name="summary" class="form-control" rows="3">{{ old('summary', $article->summary) }}</textarea>
                </div>

                <div class="form-group full-width">
                    <label for="content">Nội dung <span class="required">*</span></label>
                    <textarea id="content" name="content" class="form-control" rows="10" required>{{ old('content', $article->content) }}</textarea>
                </div>
            </div>

            <div class="form-actions">
                <button type="submit" class="btn-submit">💾 Cập nhật bài viết</button>
            </div>
        </form>
    </div>
@endsection
