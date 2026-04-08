@extends('layouts.admin')

@section('title', 'Danh sách Hồ sơ bệnh án')
@section('page-title', 'Hồ sơ bệnh án')

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

        .btn-view {
            background: var(--primary-soft);
            color: var(--primary);
        }

        .btn-view:hover {
            background: var(--primary);
            color: #fff;
            transform: translateY(-2px);
        }

        .btn-edit {
            background: #fff7ed;
            color: #ea580c;
        }

        .btn-edit:hover {
            background: #ea580c;
            color: #fff;
            transform: translateY(-2px);
        }

        .btn-delete {
            background: #fef2f2;
            color: #dc2626;
        }

        .btn-delete:hover {
            background: #dc2626;
            color: #fff;
            transform: translateY(-2px);
        }

        .pagination-container {
            padding: 24px;
            border-top: 1px solid var(--border);
        }

        .empty-state {
            text-align: center;
            padding: 60px 24px;
        }

        .empty-state p {
            margin-bottom: 24px;
            color: var(--text-muted);
            font-size: 18px;
            font-weight: 500;
        }

        @media (max-width: 768px) {
            .records-toolbar {
                flex-direction: column;
                align-items: stretch;
            }

            .search-box {
                max-width: 100%;
            }

            .records-table-wrapper {
                overflow-x: auto;
            }
        }
    </style>
@endsection

@section('content')
    <div class="records-toolbar">
        <form action="{{ route('admin.medical-records.index') }}" method="GET" class="search-box">
            <input type="text" name="search" placeholder="Tìm theo tên bệnh nhân, SĐT hoặc mã HSBA"
                value="{{ request('search') }}">
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
                            <td><span class="record-code-badge">{{ $record->record_code }}</span></td>
                            <td>{{ $record->visit_date->format('d/m/Y') }}</td>
                            <td><strong>{{ $record->patient->full_name }}</strong></td>
                            <td>{{ Str::limit($record->diagnosis ?: '—', 40) }}</td>
                            <td>{{ $record->follow_up_date ? $record->follow_up_date->format('d/m/Y') : '—' }}</td>
                            <td>
                                <div class="action-btns">
                                    <a href="{{ route('admin.medical-records.show', $record) }}" class="btn-sm btn-view">
                                        👁
                                    </a>
                                    <a href="{{ route('admin.medical-records.edit', $record) }}" class="btn-sm btn-edit">
                                        ✏️
                                    </a>
                                    <form method="POST" action="{{ route('admin.medical-records.destroy', $record) }}"
                                        class="form-delete" data-name="{{ $record->record_code }}" style="display:inline;">
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
                                <p>Chưa có hồ sơ bệnh án nào.</p>
                                <a href="{{ route('admin.medical-records.create') }}" class="btn-add">➕ Thêm hồ sơ đầu tiên</a>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($records->hasPages())
            <div class="pagination-container">
                {{ $records->links() }}
            </div>
        @endif
    </div>

@endsection

@section('scripts')
    <script>
        document.querySelectorAll('.form-delete').forEach(function (form) {
            form.addEventListener('submit', function (e) {
                e.preventDefault();
                var self = this;
                var name = this.getAttribute('data-name');

                Swal.fire({
                    title: 'Xác nhận xoá?',
                    html: 'Bạn có chắc muốn xoá hồ sơ <br><strong>"' + name + '"</strong>?<br><small style="color:#8a9b8e;">Thao tác này không thể hoàn tác.</small>',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#dc2626',
                    cancelButtonColor: '#64748b',
                    confirmButtonText: '🗑 Xoá',
                    cancelButtonText: 'Huỷ bỏ',
                    reverseButtons: true,
                    focusCancel: true,
                }).then(function (result) {
                    if (result.isConfirmed) {
                        self.submit();
                    }
                });
            });
        });
    </script>
@endsection