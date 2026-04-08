@extends('layouts.admin')

@section('title', 'Danh sách bệnh nhân')
@section('page-title', 'Bệnh nh�@section('styles')
<style>
    .patients-toolbar {
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

    /* Table */
    .patients-table-wrapper {
        background: var(--bg-card);
        border-radius: var(--radius-lg);
        box-shadow: var(--shadow-md);
        border: 1px solid var(--border);
        overflow: hidden;
    }

    .patients-table {
        width: 100%;
        border-collapse: separate;
        border-spacing: 0;
    }

    .patients-table thead th {
        text-align: left;
        font-size: 13px;
        font-weight: 700;
        color: var(--text-muted);
        text-transform: uppercase;
        letter-spacing: 1px;
        padding: 20px;
        background: #f8fafc;
        border-bottom: 1px solid var(--border);
    }

    .patients-table tbody td {
        padding: 20px;
        font-size: 16px;
        border-bottom: 1px solid var(--border);
        color: var(--text-main);
        vertical-align: middle;
    }

    .patients-table tbody tr:hover {
        background: #f1f5f9;
    }

    .patients-table tbody tr:last-child td {
        border-bottom: none;
    }

    .patient-name {
        font-weight: 800;
        color: var(--text-main);
        font-size: 16px;
    }

    .gender-badge {
        display: inline-flex;
        align-items: center;
        padding: 5px 14px;
        border-radius: 10px;
        font-size: 13px;
        font-weight: 800;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .gender-badge.male   { background: #eff6ff; color: #2563eb; }
    .gender-badge.female { background: #fff1f2; color: #e11d48; }
    .gender-badge.other  { background: #faf5ff; color: #9333ea; }

    /* Action buttons */
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

    /* Empty state */
    .empty-state {
        text-align: center;
        padding: 60px 24px;
        color: var(--text-muted);
    }

    .empty-state-icon {
        font-size: 64px;
        margin-bottom: 20px;
        opacity: 0.5;
    }

    /* Pagination Override */
    .pagination-wrapper {
        padding: 24px;
        border-top: 1px solid var(--border);
    }

    .result-count {
        font-size: 15px;
        color: var(--text-muted);
        margin-bottom: 16px;
        font-weight: 500;
    }

    @media (max-width: 768px) {
        .patients-toolbar { flex-direction: column; align-items: stretch; }
        .search-box { max-width: 100%; }
        .patients-table-wrapper { overflow-x: auto; }
    }
</style>
@endsection
ection

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
