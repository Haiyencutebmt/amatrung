@extends('layouts.admin')

@section('title', 'Danh sách Hồ sơ bệnh án')
@section('page-title', 'Hồ sơ bệnh án')

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

    /* Reusing some patients classes */
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
        <form action="{{ route('admin.medical-records.index') }}" method="GET" class="search-box">
            <input type="text" name="search" placeholder="Tìm theo tên bệnh nhân, SĐT hoặc mã HSBA" value="{{ request('search') }}">
            <button type="submit" class="btn-search">Tìm kiếm</button>
        </form>

        <a href="{{ route('admin.medical-records.create') }}" class="btn-add">
            ➕ Thêm hồ sơ
        </a>
    </div>

    <div class="records-table-wrapper">
        <div style="overflow-x: auto;">
            <table class="records-table">
                <thead>
                    <tr>
                        <th>Mã HSBA</th>
                        <th>Ngày khám</th>
                        <th>Bệnh nhân</th>
                        <th>Chẩn đoán</th>
                        <th>Tái khám</th>
                        <th>Thao tác</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($records as $record)
                        <tr>
                            <td><strong>{{ $record->record_code }}</strong></td>
                            <td>{{ $record->visit_date->format('d/m/Y') }}</td>
                            <td>{{ $record->patient->full_name }}</td>
                            <td>{{ Str::limit($record->diagnosis ?: '—', 40) }}</td>
                            <td>{{ $record->follow_up_date ? $record->follow_up_date->format('d/m/Y') : '—' }}</td>
                            <td>
                                <div class="action-btns">
                                    <a href="{{ route('admin.medical-records.show', $record) }}" class="btn-sm btn-view">
                                        👁 Xem
                                    </a>
                                    <a href="{{ route('admin.medical-records.edit', $record) }}" class="btn-sm btn-edit">
                                        ✏️ Sửa
                                    </a>
                                    <form method="POST" action="{{ route('admin.medical-records.destroy', $record) }}"
                                          class="form-delete"
                                          data-name="{{ $record->record_code }}"
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
                                <p>Chưa có hồ sơ bệnh án nào.</p>
                                <a href="{{ route('admin.medical-records.create') }}" class="btn-add">➕ Thêm hồ sơ đầu tiên</a>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($records->hasPages())
            <div class="pagination-container" style="padding: 16px;">
                {{ $records->links() }}
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
                html: 'Bạn có chắc muốn xoá hồ sơ <br><strong>"' + name + '"</strong>?<br><small style="color:#8a9b8e;">Thao tác này không thể hoàn tác.</small>',
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
