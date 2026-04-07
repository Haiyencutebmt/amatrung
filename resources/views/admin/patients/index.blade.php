@extends('layouts.admin')

@section('title', 'Danh sách bệnh nhân')
@section('page-title', 'Bệnh nhân')

@section('styles')
    .patients-toolbar {
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
        font-family: inherit;
        transition: background 0.2s;
        white-space: nowrap;
    }

    .btn-search:hover {
        background: #1a5632;
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
        cursor: pointer;
        text-decoration: none;
        font-family: inherit;
        transition: background 0.2s, transform 0.15s;
        white-space: nowrap;
    }

    .btn-add:hover {
        background: #1a5632;
        transform: translateY(-1px);
        color: white;
    }

    /* Table */
    .patients-table-wrapper {
        background: #ffffff;
        border-radius: 16px;
        box-shadow: 0 2px 12px rgba(0, 0, 0, 0.04);
        border: 1px solid #e8e2d8;
        overflow: hidden;
    }

    .patients-table {
        width: 100%;
        border-collapse: collapse;
    }

    .patients-table thead th {
        text-align: left;
        font-size: 14px;
        font-weight: 600;
        color: #5a6b5e;
        text-transform: uppercase;
        letter-spacing: 0.4px;
        padding: 16px 18px;
        background: #faf7f2;
        border-bottom: 2px solid #e8e2d8;
        white-space: nowrap;
    }

    .patients-table tbody td {
        padding: 16px 18px;
        font-size: 16px;
        border-bottom: 1px solid #f2ede5;
        color: #2d3a2e;
        vertical-align: middle;
    }

    .patients-table tbody tr:hover {
        background: #faf7f2;
    }

    .patients-table tbody tr:last-child td {
        border-bottom: none;
    }

    .patient-name {
        font-weight: 600;
        color: #1a5632;
        font-size: 16px;
    }

    .gender-badge {
        display: inline-block;
        padding: 3px 12px;
        border-radius: 8px;
        font-size: 13px;
        font-weight: 600;
    }

    .gender-badge.male   { background: #e8f0fe; color: #1a56db; }
    .gender-badge.female { background: #fce4ec; color: #c62828; }
    .gender-badge.other  { background: #f3e8ff; color: #7c3aed; }

    /* Action buttons */
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
        font-family: inherit;
        transition: all 0.15s;
        white-space: nowrap;
    }

    .btn-view {
        background: #e8f5e9;
        color: #1a5632;
    }
    .btn-view:hover { background: #c8e6c9; }

    .btn-edit {
        background: #fff3e0;
        color: #e65100;
    }
    .btn-edit:hover { background: #ffe0b2; }

    .btn-delete {
        background: #fff5f5;
        color: #b91c1c;
    }
    .btn-delete:hover { background: #fee2e2; }

    /* Empty state */
    .empty-state {
        text-align: center;
        padding: 48px 24px;
        color: #8a9b8e;
        font-size: 16px;
    }

    .empty-state-icon {
        font-size: 56px;
        margin-bottom: 12px;
    }

    /* Pagination */
    .pagination-wrapper {
        padding: 16px 18px;
        display: flex;
        justify-content: center;
        border-top: 1px solid #f2ede5;
    }

    .pagination-wrapper nav {
        display: flex;
        gap: 4px;
    }

    .pagination-wrapper .page-link,
    .pagination-wrapper a,
    .pagination-wrapper span {
        padding: 8px 14px;
        border-radius: 8px;
        font-size: 14px;
        font-weight: 500;
        text-decoration: none;
        color: #2d3a2e;
        background: #faf7f2;
        border: 1px solid #e8e2d8;
        transition: all 0.15s;
    }

    .pagination-wrapper a:hover {
        background: #e8f5e9;
        border-color: #2f7d4a;
        color: #1a5632;
    }

    .pagination-wrapper span[aria-current="page"] span,
    .pagination-wrapper .active span {
        background: #2f7d4a;
        color: white;
        border-color: #2f7d4a;
    }

    .pagination-wrapper span[aria-disabled="true"] span,
    .pagination-wrapper .disabled span {
        color: #c5c5c5;
        cursor: not-allowed;
    }

    .result-count {
        font-size: 14px;
        color: #5a6b5e;
        margin-bottom: 12px;
    }

    @media (max-width: 768px) {
        .patients-toolbar {
            flex-direction: column;
            align-items: stretch;
        }
        .search-box {
            max-width: 100%;
        }
        .patients-table-wrapper {
            overflow-x: auto;
        }
    }
@endsection

@section('content')
    {{-- Toolbar: tìm kiếm + nút thêm --}}
    <div class="patients-toolbar">
        <form method="GET" action="{{ route('admin.patients.index') }}" class="search-box">
            <input type="text" name="search" value="{{ request('search') }}"
                   placeholder="🔍 Tìm theo tên hoặc số điện thoại...">
            <button type="submit" class="btn-search">Tìm kiếm</button>
        </form>
        <a href="{{ route('admin.patients.create') }}" class="btn-add">
            ➕ Thêm bệnh nhân
        </a>
    </div>

    {{-- Kết quả --}}
    @if(request('search'))
        <div class="result-count">
            Tìm thấy <strong>{{ $patients->total() }}</strong> kết quả cho
            "<strong>{{ request('search') }}</strong>"
            — <a href="{{ route('admin.patients.index') }}" style="color: #2f7d4a;">Xoá bộ lọc</a>
        </div>
    @endif

    {{-- Bảng danh sách --}}
    <div class="patients-table-wrapper">
        @if($patients->count() > 0)
            <table class="patients-table">
                <thead>
                    <tr>
                        <th>STT</th>
                        <th>Họ và tên</th>
                        <th>Giới tính</th>
                        <th>Năm sinh</th>
                        <th>SĐT</th>
                        <th>Địa chỉ</th>
                        <th>Thao tác</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($patients as $index => $patient)
                        <tr>
                            <td>{{ $patients->firstItem() + $index }}</td>
                            <td>
                                <span class="patient-name">{{ $patient->full_name }}</span>
                            </td>
                            <td>
                                <span class="gender-badge {{ $patient->gender }}">
                                    {{ $patient->gender_label }}
                                </span>
                            </td>
                            <td>{{ $patient->date_of_birth ? $patient->date_of_birth->format('d/m/Y') : '—' }}</td>
                            <td>{{ $patient->phone ?? '—' }}</td>
                            <td style="max-width: 200px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">
                                {{ $patient->address ?? '—' }}
                            </td>
                            <td>
                                <div class="action-btns">
                                    <a href="{{ route('admin.patients.show', $patient) }}" class="btn-sm btn-view">
                                        👁 Xem
                                    </a>
                                    <a href="{{ route('admin.patients.edit', $patient) }}" class="btn-sm btn-edit">
                                        ✏️ Sửa
                                    </a>
                                    <form method="POST" action="{{ route('admin.patients.destroy', $patient) }}"
                                          class="form-delete"
                                          data-name="{{ $patient->full_name }}"
                                          style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn-sm btn-delete">🗑 Xoá</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            {{-- Phân trang --}}
            @if($patients->hasPages())
                <div class="pagination-wrapper">
                    {{ $patients->links() }}
                </div>
            @endif
        @else
            <div class="empty-state">
                <div class="empty-state-icon">📋</div>
                @if(request('search'))
                    <p>Không tìm thấy bệnh nhân nào phù hợp.</p>
                @else
                    <p>Chưa có dữ liệu bệnh nhân nào.</p>
                    <p style="margin-top: 8px;">
                        <a href="{{ route('admin.patients.create') }}" class="btn-add" style="display: inline-flex; margin-top: 8px;">
                            ➕ Thêm bệnh nhân đầu tiên
                        </a>
                    </p>
                @endif
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
                html: 'Bạn có chắc muốn xoá bệnh nhân<br><strong>"' + name + '"</strong>?<br><small style="color:#8a9b8e;">Thao tác này không thể hoàn tác.</small>',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#b91c1c',
                cancelButtonColor: '#5a6b5e',
                confirmButtonText: '🗑 Xoá bệnh nhân',
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
