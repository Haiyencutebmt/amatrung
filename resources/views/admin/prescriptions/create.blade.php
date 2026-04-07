@extends('layouts.admin')

@section('title', 'Thêm Đơn thuốc mới')
@section('page-title', 'Thêm Đơn thuốc')

@include('admin.patients._form-styles')

@section('styles')
<style>
    .items-wrapper {
        margin-top: 30px;
        border-top: 2px solid #e8f5e9;
        padding-top: 20px;
    }
    .items-table {
        width: 100%;
        border-collapse: collapse;
        margin-bottom: 20px;
    }
    .items-table th {
        background: #faf7f2;
        padding: 12px;
        text-align: left;
        color: #5a6b5e;
        font-weight: 600;
        border-bottom: 2px solid #e8e2d8;
    }
    .items-table td {
        padding: 12px;
        border-bottom: 1px solid #f2ede5;
        vertical-align: top;
    }
    .form-control-sm {
        width: 100%;
        padding: 8px 12px;
        border: 1px solid #d9e4d8;
        border-radius: 8px;
        font-size: 14px;
        font-family: inherit;
    }
    .btn-remove {
        background: #ffebee;
        color: #c62828;
        border: none;
        padding: 8px 12px;
        border-radius: 8px;
        cursor: pointer;
        font-weight: bold;
    }
    .btn-add-item {
        background: #e8f5e9;
        color: #1a5632;
        border: 1px dashed #2f7d4a;
        padding: 10px 20px;
        border-radius: 8px;
        cursor: pointer;
        font-weight: bold;
        width: 100%;
        text-align: center;
        transition: 0.2s;
    }
    .btn-add-item:hover {
        background: #c8e6c9;
    }
</style>
@endsection

@section('content')
    <div class="form-card">
        <div class="form-header">
            <h2>Kê đơn thuốc mới</h2>
            <a href="{{ route('admin.prescriptions.index') }}" class="btn-back">
                Quay lại
            </a>
        </div>

        @if($errors->any())
            <div class="error-summary">
                <strong>Vui lòng kiểm tra lại thông tin:</strong>
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.prescriptions.store') }}" method="POST" id="prescription-form">
            @csrf
            
            <div class="form-grid">
                <div class="form-group full-width">
                    <label for="medical_record_id">Hồ sơ bệnh án & Bệnh nhân <span class="required">*</span></label>
                    <select name="medical_record_id" id="medical_record_id" class="form-control @error('medical_record_id') is-invalid @enderror" required>
                        <option value="">-- Chọn hồ sơ bệnh án --</option>
                        @foreach($records as $record)
                            <option value="{{ $record->id }}" {{ (old('medical_record_id') ?? $selectedRecordId) == $record->id ? 'selected' : '' }}>
                                {{ $record->record_code }} - {{ $record->patient->full_name }} (Khám ngày: {{ $record->visit_date->format('d/m/Y') }})
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="prescribed_date">Ngày kê đơn <span class="required">*</span></label>
                    <input type="date" id="prescribed_date" name="prescribed_date" value="{{ old('prescribed_date', date('Y-m-d')) }}" 
                           class="form-control @error('prescribed_date') is-invalid @enderror" required>
                </div>

                <div class="form-group">
                    <label for="status">Trạng thái <span class="required">*</span></label>
                    <select name="status" id="status" class="form-control @error('status') is-invalid @enderror" required>
                        <option value="active" {{ old('status') == 'active' ? 'selected' : '' }}>Đang sử dụng</option>
                        <option value="completed" {{ old('status') == 'completed' ? 'selected' : '' }}>Hoàn thành</option>
                        <option value="cancelled" {{ old('status') == 'cancelled' ? 'selected' : '' }}>Đã hủy</option>
                    </select>
                </div>

                <div class="form-group full-width">
                    <label for="usage_instruction">Hướng dẫn sử dụng chung (Cách sắc, uống)</label>
                    <textarea id="usage_instruction" name="usage_instruction" class="form-control @error('usage_instruction') is-invalid @enderror" placeholder="Ví dụ: Sắc 3 bát nước còn 1 bát...">{{ old('usage_instruction') }}</textarea>
                </div>

                <div class="form-group full-width">
                    <label for="general_note">Ghi chú, lời dặn riêng</label>
                    <textarea id="general_note" name="general_note" class="form-control @error('general_note') is-invalid @enderror" placeholder="Ví dụ: Kiêng đồ tanh, cay nóng...">{{ old('general_note') }}</textarea>
                </div>
            </div>

            <div class="items-wrapper">
                <h3>Chi tiết các vị thuốc <span class="required">*</span></h3>
                <p style="color: #5a6b5e; font-size: 14px; margin-bottom: 15px;">Thêm các dược liệu vào đơn thuốc. Tổng số vị: <span id="total-items">0</span></p>
                
                <table class="items-table" id="items-table">
                    <thead>
                        <tr>
                            <th width="30%">Dược liệu</th>
                            <th width="15%">Số lượng</th>
                            <th width="15%">Đơn vị</th>
                            <th width="30%">Ghi chú / Cách dùng riêng</th>
                            <th width="10%">Xoá</th>
                        </tr>
                    </thead>
                    <tbody id="items-body">
                        <!-- Rows will be added here -->
                    </tbody>
                </table>
                <button type="button" class="btn-add-item" onclick="addItemRow()">➕ Thêm vị thuốc</button>
            </div>

            <div class="form-actions" style="margin-top: 30px;">
                <button type="submit" class="btn-submit">
                    💾 Tạo Đơn thuốc
                </button>
                <a href="{{ route('admin.prescriptions.index') }}" class="btn-cancel">
                    Huỷ bỏ
                </a>
            </div>
        </form>
    </div>

    <!-- Template for herb row -->
    <template id="item-template">
        <tr>
            <td>
                <select name="items[INDEX][medicinal_herb_id]" class="form-control-sm herb-select" required onchange="updateUnit(this)">
                    <option value="">-- Chọn --</option>
                    @foreach($herbs as $herb)
                        <option value="{{ $herb->id }}" data-unit="{{ $herb->unit }}" data-stock="{{ floatval($herb->quantity_in_stock) }}">
                            {{ $herb->name }} (Tồn: {{ floatval($herb->quantity_in_stock) }})
                        </option>
                    @endforeach
                </select>
            </td>
            <td>
                <input type="number" name="items[INDEX][quantity]" class="form-control-sm" step="0.01" min="0.01" required placeholder="0.0">
            </td>
            <td>
                <input type="text" name="items[INDEX][unit]" class="form-control-sm unit-input" placeholder="Đơn vị">
            </td>
            <td>
                <input type="text" name="items[INDEX][instruction]" class="form-control-sm" placeholder="Gói riêng, sắc sau...">
            </td>
            <td>
                <button type="button" class="btn-remove" onclick="removeRow(this)">🗑</button>
            </td>
        </tr>
    </template>

@endsection

@section('scripts')
<script>
    let itemIndex = 0;

    function addItemRow() {
        const tbody = document.getElementById('items-body');
        const template = document.getElementById('item-template').innerHTML;
        const html = template.replace(/INDEX/g, itemIndex++);
        tbody.insertAdjacentHTML('beforeend', html);
        updateTotal();
    }

    function removeRow(btn) {
        btn.closest('tr').remove();
        updateTotal();
    }

    function updateUnit(select) {
        const option = select.options[select.selectedIndex];
        const unit = option.getAttribute('data-unit');
        const row = select.closest('tr');
        if (unit) {
            row.querySelector('.unit-input').value = unit;
        }
    }

    function updateTotal() {
        const rows = document.querySelectorAll('#items-body tr').length;
        document.getElementById('total-items').innerText = rows;
    }

    // Add initial row if no old input (for newly created form)
    document.addEventListener('DOMContentLoaded', function() {
        @if(old('items'))
            // Here you would normally reconstruct the validation failed items. 
            // For simplicity, we just add one empty row if none exists.
        @endif
        if (document.querySelectorAll('#items-body tr').length === 0) {
            addItemRow();
        }
    });
</script>
@endsection
