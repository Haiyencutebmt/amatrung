@extends('layouts.admin')

@section('title', 'Quản lý Bình luận')
@section('page-title', 'Bình luận')

@section('styles')
    <style>
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

        .status-approved { background: #e8f5e9; color: #2e7d32; }
        .status-hidden { background: #ffebee; color: #c62828; }

        .btn-sm {
            padding: 7px 14px;
            border-radius: 8px;
            font-size: 13px;
            font-weight: 600;
            text-decoration: none;
            border: none;
            cursor: pointer;
            margin-right: 5px;
        }
        .btn-toggle { background: #fff3e0; color: #e65100; }
        .btn-delete { background: #ffebee; color: #b91c1c; }
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
                        <td><strong>{{ $comment->user->name }}</strong><br><small>{{ $comment->user->email }}</small></td>
                        <td>{{ Str::limit($comment->content, 60) }}</td>
                        <td><a href="{{ route('admin.articles.show', $comment->article_id) }}" style="color: #2f7d4a; text-decoration: none;">{{ Str::limit($comment->article->title, 40) }}</a></td>
                        <td>{{ $comment->created_at->format('d/m/Y H:i') }}</td>
                        <td>
                            <span class="status-badge status-{{ $comment->status }}">
                                {{ $comment->status == 'approved' ? 'Hiển thị' : 'Đã ẩn' }}
                            </span>
                        </td>
                        <td>
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
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" style="padding: 40px; text-align: center; color:#5a6b5e;">Không có bình luận nào.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
        @if($comments->hasPages())
            <div style="padding: 16px;">{{ $comments->links() }}</div>
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
