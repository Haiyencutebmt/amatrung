@extends('layouts.admin')

@section('title', 'Sửa Dược liệu')
@section('page-title', 'Sửa Dược liệu')

@include('admin.patients._form-styles')

@section('content')
    <div class="form-card">
        <div class="form-header">
            <h2>Cập nhật Dược liệu: {{ $medicinalHerb->name }}</h2>
            <a href="{{ route('admin.medicinal-herbs.index') }}" class="btn-back">
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

        <form action="{{ route('admin.medicinal-herbs.update', $medicinalHerb) }}" method="POST">
            @csrf
            @method('PUT')
            
            <div class="form-grid">
                <div class="form-group full-width">
                    <label for="name">Tên dược liệu <span class="required">*</span></label>
                    <input type="text" id="name" name="name" value="{{ old('name', $medicinalHerb->name) }}" 
                           class="form-control @error('name') is-invalid @enderror" required placeholder="Ví dụ: Đương quy...">
                </div>

                <div class="form-group">
                    <label for="unit">Đơn vị tính <span class="required">*</span></label>
                    <input type="text" id="unit" name="unit" value="{{ old('unit', $medicinalHerb->unit) }}" 
                           class="form-control @error('unit') is-invalid @enderror" required>
                </div>

                <div class="form-group">
                    <label for="quantity_in_stock">Số lượng tồn kho <span class="required">*</span></label>
                    <input type="number" step="0.01" id="quantity_in_stock" name="quantity_in_stock" value="{{ old('quantity_in_stock', floatval($medicinalHerb->quantity_in_stock)) }}" 
                           class="form-control @error('quantity_in_stock') is-invalid @enderror" required>
                </div>

                <div class="form-group">
                    <label for="expiry_date">Ngày hết hạn (Tuỳ chọn)</label>
                    <input type="date" id="expiry_date" name="expiry_date" value="{{ old('expiry_date', $medicinalHerb->expiry_date ? $medicinalHerb->expiry_date->format('Y-m-d') : '') }}" 
                           class="form-control @error('expiry_date') is-invalid @enderror">
                </div>

                <div class="form-group">
                    <label for="status">Trạng thái <span class="required">*</span></label>
                    <select name="status" id="status" class="form-control @error('status') is-invalid @enderror" required>
                        <option value="available" {{ old('status', $medicinalHerb->status) == 'available' ? 'selected' : '' }}>Sẵn sàng (Còn hàng)</option>
                        <option value="out_of_stock" {{ old('status', $medicinalHerb->status) == 'out_of_stock' ? 'selected' : '' }}>Hết hàng</option>
                        <option value="discontinued" {{ old('status', $medicinalHerb->status) == 'discontinued' ? 'selected' : '' }}>Ngừng kinh doanh</option>
                    </select>
                </div>

                <div class="form-group full-width">
                    <label for="origin">Nguồn gốc / Xuất xứ</label>
                    <input type="text" id="origin" name="origin" value="{{ old('origin', $medicinalHerb->origin) }}" 
                           class="form-control @error('origin') is-invalid @enderror" placeholder="Tuỳ chọn...">
                </div>

                <div class="form-group full-width">
                    <label for="note">Ghi chú thêm</label>
                    <textarea id="note" name="note" class="form-control @error('note') is-invalid @enderror" placeholder="Tuỳ chọn...">{{ old('note', $medicinalHerb->note) }}</textarea>
                </div>
            </div>

            <div class="form-actions">
                <button type="submit" class="btn-submit">
                    💾 Cập nhật Dược liệu
                </button>
                <a href="{{ route('admin.medicinal-herbs.index') }}" class="btn-cancel">
                    Huỷ bỏ
                </a>
            </div>
        </form>
    </div>
@endsection
