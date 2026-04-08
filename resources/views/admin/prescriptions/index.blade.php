@extends('layouts.admin')

@section('title', 'Danh sách Đơn thuốc')
@section('page-title', 'Đơn thuốc')

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

    .record-code-badge {
        font-weight: 800;
        color: var(--primary);
        font-size: 15px;
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
        font-size: 13px;
        font-weight: 800;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .status-active { background: #eff6ff; color: #2563eb; }
    .status-completed { background: #ecfdf5; color: #10b981; }
    .status-cancelled { background: #fef2f2; color: #dc2626; }

    .pagination-container {
        padding: 24px;
        border-top: 1px solid var(--border);
    }
    
    .empty-state {
        text-align: center;
        padding: 60px 24px;
    }
    .empty-state p { margin-bottom: 24px; color: var(--text-muted); font-size: 18px; font-weight: 500; }

    @media (max-width: 768px) {
        .records-toolbar { flex-direction: column; align-items: stretch; }
        .search-box { max-width: 100%; }
        .records-table-wrapper { overflow-x: auto; }
    }
</style>
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
                            <td><span class="record-code-badge">{{ $prescription->prescription_code }}</span></td>
                            <td>{{ $prescription->prescribed_date->format('d/m/Y') }}</td>
                            <td><strong>{{ $prescription->medicalRecord->patient->full_name }}</strong></td>
                            <td>
                                <a href="{{ route('admin.medical-records.show', $prescription->medicalRecord) }}" class="record-code-badge" style="text-decoration: underline; background: var(--bg-page); color: var(--text-muted);">
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
                                        👁
                                    </a>
                                    <a href="{{ route('admin.prescriptions.edit', $prescription) }}" class="btn-sm btn-edit">
                                        ✏️
                                    </a>
                                    <form method="POST" action="{{ route('admin.prescriptions.destroy', $prescription) }}"
                                          class="form-delete"
                                          data-name="{{ $prescription->prescription_code }}"
                                          style="display:inline;">
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
                                <p>Chưa có đơn thuốc nào.</p>
                                <a href="{{ route('admin.prescriptions.create') }}" class="btn-add">➕ Thêm đơn thuốc đầu tiên</a>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($prescriptions->hasPages())
            <div class="pagination-container">
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
