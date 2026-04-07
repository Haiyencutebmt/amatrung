@extends('layouts.admin')

@section('title', 'Danh sách Bài viết')
@section('page-title', 'Bài viết')

@section('styles')
    <style>
        .records-toolbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 16px;
            margin-bottom: 24px;
        }

        .search-box {
            display: flex;
            align-items: center;
            gap: 10px;
            flex: 1;
            max-width: 420px;
        }

        .search-box input {
            flex: 1;
            padding: 12px 18px;
            border: 1px solid #d9e4d8;
            border-radius: 12px;
            font-size: 16px;
            outline: none;
        }

        .btn-search {
            padding: 12px 20px;
            background: #2f7d4a;
            color: white;
            border: none;
            border-radius: 12px;
            font-size: 15px;
            font-weight: 600;
            cursor: pointer;
        }

        .btn-add {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 12px 24px;
            background: #2f7d4a;
            color: white;
            border-radius: 12px;
            font-size: 16px;
            font-weight: 600;
            text-decoration: none;
        }

        .records-table-wrapper {
            background: #ffffff;
            border-radius: 16px;
            box-shadow: 0 2px 12px rgba(0, 0, 0, 0.04);
            border: 1px solid #e8e2d8;
            overflow: hidden;
            width: 100%;
        }

        .records-table {
            width: 100%;
            border-collapse: collapse;
        }

        .records-table thead th {
            text-align: left;
            font-weight: 600;
            color: #5a6b5e;
            padding: 16px 18px;
            background: #faf7f2;
            border-bottom: 2px solid #e8e2d8;
        }

        .records-table tbody td {
            padding: 16px 18px;
            border-bottom: 1px solid #f2ede5;
            vertical-align: middle;
        }

        .status-badge {
            display: inline-block;
            padding: 4px 12px;
            border-radius: 8px;
            font-size: 13px;
            font-weight: 600;
        }

        .status-published { background: #e8f5e9; color: #2e7d32; }
        .status-draft { background: #eeeeee; color: #616161; }

        .action-btns {
            display: flex;
            gap: 8px;
        }
        .btn-sm {
            padding: 7px 14px;
            border-radius: 8px;
            font-size: 13px;
            font-weight: 600;
            text-decoration: none;
            border: none;
            cursor: pointer;
        }
        .btn-view { background: #e8f5e9; color: #1a5632; }
        .btn-edit { background: #fff8e1; color: #e65100; }
        .btn-delete { background: #ffebee; color: #b91c1c; }
    </style>
@endsection

@section('content')
    <div class="records-toolbar">
        <form action="{{ route('admin.articles.index') }}" method="GET" class="search-box">
            <input type="text" name="search" placeholder="Tìm tiêu đề..." value="{{ request('search') }}">
            <button type="submit" class="btn-search">Tìm kiếm</button>
        </form>

        <a href="{{ route('admin.articles.create') }}" class="btn-add">➕ Thêm bài viết</a>
    </div>

    <div class="records-table-wrapper">
        <table class="records-table">
            <thead>
                <tr>
                    <th>Tiêu đề</th>
                    <th>Ngày đăng</th>
                    <th>Tác giả</th>
                    <th>Lượt xem</th>
                    <th>Trạng thái</th>
                    <th>Thao tác</th>
                </tr>
            </thead>
            <tbody>
                @forelse($articles as $article)
                    <tr>
                        <td>
                            @if($article->image)
                                <img src="{{ asset('storage/' . $article->image) }}" alt="" style="width: 40px; height: 40px; object-fit: cover; border-radius: 8px; vertical-align: middle; margin-right: 10px;">
                            @endif
                            <strong style="vertical-align: middle;">{{ Str::limit($article->title, 40) }}</strong>
                        </td>
                        <td>{{ $article->created_at->format('d/m/Y') }}</td>
                        <td>{{ $article->author->name }}</td>
                        <td>{{ $article->views }}</td>
                        <td>
                            <span class="status-badge status-{{ $article->status }}">
                                {{ $article->status == 'published' ? 'Xuất bản' : 'Bản nháp' }}
                            </span>
                        </td>
                        <td>
                            <div class="action-btns">
                                <a href="{{ route('admin.articles.show', $article) }}" class="btn-sm btn-view">👁</a>
                                <a href="{{ route('admin.articles.edit', $article) }}" class="btn-sm btn-edit">✏️</a>
                                <form method="POST" action="{{ route('admin.articles.destroy', $article) }}" class="form-delete" data-name="{{ $article->title }}" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn-sm btn-delete">🗑</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" style="padding: 40px; text-align: center; color:#5a6b5e;">Không có bài viết nào.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
        @if($articles->hasPages())
            <div style="padding: 16px;">{{ $articles->links() }}</div>
        @endif
    </div>
@endsection

@section('scripts')
<script>
    document.querySelectorAll('.form-delete').forEach(function(form) {
        form.addEventListener('submit', function(e) {
            e.preventDefault();
            var self = this;
            var name = this.getAttribute('data-name');
            Swal.fire({
                title: 'Xóa bài viết?',
                text: 'Bạn có chắc xoá: ' + name,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#b91c1c',
                cancelButtonText: 'Huỷ',
                confirmButtonText: 'Xoá'
            }).then((result) => {
                if (result.isConfirmed) self.submit();
            });
        });
    });
</script>
@endsection
