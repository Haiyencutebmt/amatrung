@extends('layouts.admin')

@section('title', 'Quản lý Bình luận')
@section('page-title', 'Bình luận')

@section('styles')
<style>
    .records-table-wrapper {
        background: var(--bg-card);
        border-radius: var(--radius-lg);
        box-shadow: var(--shadow-md);
        border: 1px solid var(--border);
        overflow: hidden;
        width: 100%;
        margin-top: 24px;
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

    .status-approved { background: #ecfdf5; color: #10b981; }
    .status-hidden { background: #fef2f2; color: #dc2626; }

    .action-btns {
        display: flex;
        gap: 10px;
    }

    .btn-sm {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        padding: 8px 16px;
        border-radius: 10px;
        font-size: 14px;
        font-weight: 700;
        text-decoration: none;
        border: none;
        cursor: pointer;
        font-family: inherit;
        transition: var(--transition);
    }

    .btn-toggle { background: var(--primary-soft); color: var(--primary); }
    .btn-toggle:hover { background: var(--primary); color: #fff; transform: translateY(-2px); }

    .btn-delete { background: #fef2f2; color: #dc2626; }
    .btn-delete:hover { background: #dc2626; color: #fff; transform: translateY(-2px); }

    .pagination-container {
        padding: 24px;
        border-top: 1px solid var(--border);
    }
    
    .comment-content {
        color: var(--text-main);
        line-height: 1.5;
        font-weight: 500;
    }

    .article-link {
        color: var(--primary);
        font-weight: 700;
        text-decoration: none;
    }

    .article-link:hover {
        text-decoration: underline;
    }
</style>
@endsection

@section('content')
    <div class="records-table-wrapper">
        <table class="records-table">
            <thead>
                <tr>
                    <th>Người dùng</th>
                    <th>Nội dung</th>
                    <th width="25%">Bài viết</th>
                    <th>Ngày đăng</th>
                    <th>Trạng thái</th>
                    <th>Thao tác</th>
                </tr>
            </thead>
            <tbody>
                @forelse($comments as $comment)
                    <tr>
                        <td>
                            <strong>{{ $comment->user->name }}</strong><br>
                            <small class="text-muted">{{ $comment->user->email }}</small>
                        </td>
                        <td class="comment-content">{{ Str::limit($comment->content, 60) }}</td>
                        <td>
                            <a href="{{ route('admin.articles.show', $comment->article_id) }}" class="article-link">
                                {{ Str::limit($comment->article->title, 40) }}
                            </a>
                        </td>
                        <td>{{ $comment->created_at->format('d/m/Y H:i') }}</td>
                        <td>
                            <span class="status-badge status-{{ $comment->status }}">
                                {{ $comment->status == 'approved' ? 'Hiển thị' : 'Đã ẩn' }}
                            </span>
                        </td>
                        <td>
                            <div class="action-btns">
                                <form method="POST" action="{{ route('admin.comments.toggle-status', $comment) }}" style="display:inline;">
                                    @csrf
                                    <button type="submit" class="btn-sm btn-toggle">
                                        {{ $comment->status == 'approved' ? '👁 Ẩn' : '✅ Hiện' }}
                                    </button>
                                </form>
                                <form method="POST" action="{{ route('admin.comments.destroy', $comment) }}" class="form-delete" data-name="bình luận của {{ $comment->user->name }}" style="display:inline;">
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
                            <p>Không có bình luận nào.</p>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
        @if($comments->hasPages())
            <div class="pagination-container">{{ $comments->links() }}</div>
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
                title: 'Xóa bình luận?',
                text: 'Bạn có chắc xoá ' + name + '?',
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
