@extends('layouts.admin')

@section('title', 'Danh sách Đơn thuốc')
@section('page-title', 'Đơn thuốc')

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

    .status-active { background: #e3f2fd; color: #1565c0; }
    .status-completed { background: #e8f5e9; color: #2e7d32; }
    .status-cancelled { background: #ffebee; color: #c62828; }

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
        <form action="{{ route('admin.prescriptions.index') }}" method="GET" class="search-box">
            <input type="text" name="search" placeholder="Tìm tên bệnh nhân, mã hồ sơ hoặc mã đơn" value="{{ request('search') }}">
            <button type="submit" class="btn-search">Tìm kiếm</button>
        </form>

        <a href="{{ route('admin.prescriptions.create') }}" class="btn-add">
            ➕ Thêm đơn thuốc
        </a>
    </div>

    <div class="records-table-wrapper">
        <div style="overflow-x: auto;">
            <table class="records-table">
                <thead>
                    <tr>
                        <th>Mã Đơn Thuốc</th>
                        <th>Ngày kê đơn</th>
                        <th>Bệnh nhân</th>
                        <th>Mã Hồ Sơ</th>
                        <th>Trạng thái</th>
                        <th>Thao tác</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($prescriptions as $prescription)
                        <tr>
                            <td><strong>{{ $prescription->prescription_code }}</strong></td>
                            <td>{{ $prescription->prescribed_date->format('d/m/Y') }}</td>
                            <td>{{ $prescription->medicalRecord->patient->full_name }}</td>
                            <td>
                                <a href="{{ route('admin.medical-records.show', $prescription->medicalRecord) }}" style="color: #2f7d4a; text-decoration: none;">
                                    {{ $prescription->medicalRecord->record_code }}
                                </a>
                            </td>
                            <td>
                                <span class="status-badge status-{{ $prescription->status }}">
                                    @if($prescription->status == 'active')
                                        Đang sử dụng
                                    @elseif($prescription->status == 'completed')
                                        Hoàn thành
                                    @else
                                        Đã hủy
                                    @endif
                                </span>
                            </td>
                            <td>
                                <div class="action-btns">
                                    <a href="{{ route('admin.prescriptions.show', $prescription) }}" class="btn-sm btn-view">
                                        👁 Xem
                                    </a>
                                    <a href="{{ route('admin.prescriptions.edit', $prescription) }}" class="btn-sm btn-edit">
                                        ✏️ Sửa
                                    </a>
                                    <form method="POST" action="{{ route('admin.prescriptions.destroy', $prescription) }}"
                                          class="form-delete"
                                          data-name="{{ $prescription->prescription_code }}"
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
                            <td colspan="6" class="empty-state">
                                <p>Chưa có đơn thuốc nào.</p>
                                <a href="{{ route('admin.prescriptions.create') }}" class="btn-add">➕ Thêm đơn thuốc đầu tiên</a>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($prescriptions->hasPages())
            <div class="pagination-container" style="padding: 16px;">
                {{ $prescriptions->links() }}
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
                html: 'Bạn có chắc muốn xoá đơn thuốc <br><strong>"' + name + '"</strong>?<br><small style="color:#8a9b8e;">Thao tác này không thể hoàn tác.</small>',
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
