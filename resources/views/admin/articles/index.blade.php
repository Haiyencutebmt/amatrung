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
        gap: 20px;
        margin-bottom: 32px;
    }

    .search-box {
        display: flex;
        align-items: center;
        gap: 12px;
        flex: 1;
        max-width: 500px;
        background: #fff;
        padding: 6px;
        border-radius: 16px;
        box-shadow: var(--shadow-sm);
        border: 1px solid var(--border);
    }

    .search-box input {
        flex: 1;
        padding: 12px 20px;
        border: 1px solid transparent;
        border-radius: 12px;
        font-size: 16px;
        font-family: inherit;
        outline: none;
        transition: var(--transition);
        background: var(--bg-page);
    }

    .search-box input:focus {
        background: #fff;
        border-color: var(--primary);
        box-shadow: 0 0 0 4px var(--primary-soft);
    }

    .btn-search {
        padding: 12px 24px;
        background: var(--primary);
        color: white;
        border: none;
        border-radius: 12px;
        font-size: 15px;
        font-weight: 700;
        cursor: pointer;
        font-family: inherit;
        transition: var(--transition);
        white-space: nowrap;
    }

    .btn-search:hover {
        background: var(--primary-hover);
        transform: translateY(-1px);
    }

    .btn-add {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 14px 28px;
        background: var(--accent);
        color: white;
        border: none;
        border-radius: 14px;
        font-size: 16px;
        font-weight: 700;
        cursor: pointer;
        text-decoration: none;
        font-family: inherit;
        transition: var(--transition);
        white-space: nowrap;
        box-shadow: 0 4px 12px rgba(16, 185, 129, 0.2);
    }

    .btn-add:hover {
        background: var(--accent-hover);
        transform: translateY(-2px);
        box-shadow: 0 6px 16px rgba(16, 185, 129, 0.3);
        color: white;
    }

    .records-table-wrapper {
        background: var(--bg-card);
        border-radius: var(--radius-lg);
        box-shadow: var(--shadow-md);
        border: 1px solid var(--border);
        overflow: hidden;
        width: 100%;
    }

    .records-table {
        width: 100%;
        border-collapse: separate;
        border-spacing: 0;
    }

    .records-table thead th {
        text-align: left;
        font-size: 13px;
        font-weight: 700;
        color: var(--text-muted);
        text-transform: uppercase;
        letter-spacing: 1px;
        padding: 20px;
        background: #f8fafc;
        border-bottom: 1px solid var(--border);
        white-space: nowrap;
    }

    .records-table tbody td {
        padding: 20px;
        font-size: 16px;
        border-bottom: 1px solid var(--border);
        color: var(--text-main);
        vertical-align: middle;
    }

    .records-table tbody tr:hover {
        background: #f1f5f9;
        transition: var(--transition);
    }

    .records-table tbody tr:last-child td {
        border-bottom: none;
    }

    .action-btns {
        display: flex;
        gap: 10px;
    }

    .btn-sm {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 36px;
        height: 36px;
        border-radius: 10px;
        font-size: 16px;
        text-decoration: none;
        border: none;
        cursor: pointer;
        font-family: inherit;
        transition: var(--transition);
    }

    .btn-view { background: var(--primary-soft); color: var(--primary); }
    .btn-view:hover { background: var(--primary); color: #fff; transform: translateY(-2px); }

    .btn-edit { background: #fff7ed; color: #ea580c; }
    .btn-edit:hover { background: #ea580c; color: #fff; transform: translateY(-2px); }

    .btn-delete { background: #fef2f2; color: #dc2626; }
    .btn-delete:hover { background: #dc2626; color: #fff; transform: translateY(-2px); }

    .status-badge {
        display: inline-flex;
        align-items: center;
        padding: 5px 14px;
        border-radius: 10px;
        font-size: 12px;
        font-weight: 800;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .status-published { background: #ecfdf5; color: #10b981; }
    .status-draft { background: #f1f5f9; color: #64748b; }

    .article-thumb {
        width: 48px;
        height: 48px;
        object-fit: cover;
        border-radius: 12px;
        vertical-align: middle;
        margin-right: 12px;
        border: 1px solid var(--border);
        box-shadow: var(--shadow-sm);
    }

    .article-title {
        font-weight: 700;
        color: var(--text-main);
        vertical-align: middle;
    }

    .pagination-container {
        padding: 24px;
        border-top: 1px solid var(--border);
    }
    
    @media (max-width: 768px) {
        .records-toolbar { flex-direction: column; align-items: stretch; }
        .search-box { max-width: 100%; }
        .records-table-wrapper { overflow-x: auto; }
    }
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
                                <img src="{{ asset('storage/' . $article->image) }}" alt="" class="article-thumb">
                            @endif
                            <span class="article-title">{{ Str::limit($article->title, 40) }}</span>
                        </td>
                        <td>{{ $article->created_at->format('d/m/Y') }}</td>
                        <td><strong>{{ $article->author->name }}</strong></td>
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
                        <td colspan="6" class="empty-state">
                            <p>Không có bài viết nào.</p>
                            <a href="{{ route('admin.articles.create') }}" class="btn-add">➕ Thêm bài viết đầu tiên</a>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
        @if($articles->hasPages())
            <div class="pagination-container">{{ $articles->links() }}</div>
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
