@extends('layouts.admin')

@section('title', 'Danh mục Dược liệu')
@section('page-title', 'Dược liệu')

@section('styles')
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
        font-family: inherit;
        outline: none;
        transition: border-color 0.2s, box-shadow 0.2s;
    }

    .search-box input:focus {
        border-color: #2f7d4a;
        box-shadow: 0 0 0 3px rgba(47, 125, 74, 0.1);
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
        transition: background 0.2s;
        white-space: nowrap;
    }

    .btn-add {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 12px 24px;
        background: #2f7d4a;
        color: white;
        border: none;
        border-radius: 12px;
        font-size: 16px;
        font-weight: 600;
        text-decoration: none;
        transition: background 0.2s, transform 0.15s;
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
        font-size: 14px;
        font-weight: 600;
        color: #5a6b5e;
        text-transform: uppercase;
        padding: 16px 18px;
        background: #faf7f2;
        border-bottom: 2px solid #e8e2d8;
        white-space: nowrap;
    }

    .records-table tbody td {
        padding: 16px 18px;
        font-size: 16px;
        border-bottom: 1px solid #f2ede5;
        color: #2d3a2e;
        vertical-align: middle;
    }

    .records-table tbody tr:hover {
        background: #faf7f2;
    }

    .action-btns {
        display: flex;
        gap: 8px;
    }

    .btn-sm {
        display: inline-flex;
        align-items: center;
        gap: 4px;
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

    .status-badge {
        display: inline-block;
        padding: 4px 12px;
        border-radius: 8px;
        font-size: 13px;
        font-weight: 600;
        text-transform: capitalize;
    }

    .status-available { background: #e3f2fd; color: #1565c0; }
    .status-out_of_stock { background: #ffebee; color: #c62828; }
    .status-discontinued { background: #eeeeee; color: #616161; }

    .warning-badge {
        display: inline-block;
        padding: 2px 8px;
        border-radius: 6px;
        font-size: 12px;
        font-weight: 600;
        background: #fff3e0;
        color: #e65100;
        margin-top: 4px;
    }
    
    .danger-badge {
        display: inline-block;
        padding: 2px 8px;
        border-radius: 6px;
        font-size: 12px;
        font-weight: 600;
        background: #ffebee;
        color: #c62828;
        margin-top: 4px;
    }

    .pagination-container {
        margin-top: 24px;
    }
    
    .empty-state {
        padding: 48px 24px;
        text-align: center;
    }
    .empty-state p { margin-bottom: 16px; color: #5a6b5e; font-size: 16px; }
@endsection

@section('content')
    <div class="records-toolbar">
        <form action="{{ route('admin.medicinal-herbs.index') }}" method="GET" class="search-box">
            <input type="text" name="search" placeholder="Tìm tên dược liệu hoặc mã dược liệu" value="{{ request('search') }}">
            <button type="submit" class="btn-search">Tìm kiếm</button>
        </form>

        <a href="{{ route('admin.medicinal-herbs.create') }}" class="btn-add">
            ➕ Thêm dược liệu
        </a>
    </div>

    <div class="records-table-wrapper">
        <div style="overflow-x: auto;">
            <table class="records-table">
                <thead>
                    <tr>
                        <th>Mã DL</th>
                        <th>Tên Dược Liệu</th>
                        <th>Tồn kho</th>
                        <th>Đơn vị</th>
                        <th>Hạn sử dụng</th>
                        <th>Trạng thái</th>
                        <th>Thao tác</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($herbs as $herb)
                        <tr>
                            <td><strong>{{ $herb->herb_code }}</strong></td>
                            <td>{{ $herb->name }}</td>
                            <td>
                                {{ floatval($herb->quantity_in_stock) }}
                                @if($herb->quantity_in_stock > 0 && $herb->quantity_in_stock <= 10)
                                    <br><span class="warning-badge">⚠️ Sắp hết</span>
                                @elseif($herb->quantity_in_stock == 0)
                                    <br><span class="danger-badge">🚨 Hết hàng</span>
                                @endif
                            </td>
                            <td>{{ $herb->unit }}</td>
                            <td>
                                @if($herb->expiry_date)
                                    {{ $herb->expiry_date->format('d/m/Y') }}
                                    @php
                                        $daysToExpiry = now()->diffInDays($herb->expiry_date, false);
                                    @endphp
                                    @if($daysToExpiry < 0)
                                        <br><span class="danger-badge">🚨 Đã hết hạn</span>
                                    @elseif($daysToExpiry <= 30)
                                        <br><span class="warning-badge">⚠️ Sắp hết hạn ({{ intval($daysToExpiry) }} ngày)</span>
                                    @endif
                                @else
                                    <span style="color: #999;">Không có</span>
                                @endif
                            </td>
                            <td>
                                <span class="status-badge status-{{ $herb->status }}">
                                    @if($herb->status == 'available')
                                        Sẵn sàng
                                    @elseif($herb->status == 'out_of_stock')
                                        Hết hàng
                                    @else
                                        Ngừng kinh doanh
                                    @endif
                                </span>
                            </td>
                            <td>
                                <div class="action-btns">
                                    <a href="{{ route('admin.medicinal-herbs.show', $herb) }}" class="btn-sm btn-view">
                                        👁 Xem
                                    </a>
                                    <a href="{{ route('admin.medicinal-herbs.edit', $herb) }}" class="btn-sm btn-edit">
                                        ✏️ Sửa
                                    </a>
                                    <form method="POST" action="{{ route('admin.medicinal-herbs.destroy', $herb) }}"
                                          class="form-delete"
                                          data-name="{{ $herb->name }}"
                                          style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn-sm btn-delete">🗑 Xoá</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="empty-state">
                                <p>Chưa có dược liệu nào.</p>
                                <a href="{{ route('admin.medicinal-herbs.create') }}" class="btn-add">➕ Thêm dược liệu đầu tiên</a>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($herbs->hasPages())
            <div class="pagination-container" style="padding: 16px;">
                {{ $herbs->links() }}
            </div>
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
                title: 'Xác nhận xoá?',
                html: 'Bạn có chắc muốn xoá dược liệu <br><strong>"' + name + '"</strong>?<br><small style="color:#8a9b8e;">Thao tác này không thể hoàn tác.</small>',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#b91c1c',
                cancelButtonColor: '#5a6b5e',
                confirmButtonText: '🗑 Xoá',
                cancelButtonText: 'Huỷ bỏ',
                reverseButtons: true,
                focusCancel: true,
            }).then(function(result) {
                if (result.isConfirmed) {
                    self.submit();
                }
            });
        });
    });
</script>
@endsection
