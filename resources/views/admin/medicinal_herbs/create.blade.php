@extends('layouts.admin')

@section('title', 'Thêm Dược liệu mới')
@section('page-title', 'Thêm Dược liệu')

@include('admin.patients._form-styles')

@section('content')
    <div class="form-card">
        <div class="form-header">
            <h2>Thêm Dược liệu mới</h2>
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

        <form action="{{ route('admin.medicinal-herbs.store') }}" method="POST">
            @csrf
            
            <div class="form-grid">
                <div class="form-group full-width">
                    <label for="name">Tên dược liệu <span class="required">*</span></label>
                    <input type="text" id="name" name="name" value="{{ old('name') }}" 
                           class="form-control @error('name') is-invalid @enderror" required placeholder="Ví dụ: Đương quy, Nhân sâm, Bạch truật...">
                </div>

                <div class="form-group">
                    <label for="unit">Đơn vị tính <span class="required">*</span></label>
                    <input type="text" id="unit" name="unit" value="{{ old('unit', 'g') }}" 
                           class="form-control @error('unit') is-invalid @enderror" required placeholder="Ví dụ: g, kg, lít...">
                </div>

                <div class="form-group">
                    <label for="quantity_in_stock">Số lượng tồn kho <span class="required">*</span></label>
                    <input type="number" step="0.01" id="quantity_in_stock" name="quantity_in_stock" value="{{ old('quantity_in_stock', '0') }}" 
                           class="form-control @error('quantity_in_stock') is-invalid @enderror" required>
                </div>

                <div class="form-group">
                    <label for="expiry_date">Ngày hết hạn (Tuỳ chọn)</label>
                    <input type="date" id="expiry_date" name="expiry_date" value="{{ old('expiry_date') }}" 
                           class="form-control @error('expiry_date') is-invalid @enderror">
                </div>

                <div class="form-group">
                    <label for="status">Trạng thái <span class="required">*</span></label>
                    <select name="status" id="status" class="form-control @error('status') is-invalid @enderror" required>
                        <option value="available" {{ old('status') == 'available' ? 'selected' : '' }}>Sẵn sàng (Còn hàng)</option>
                        <option value="out_of_stock" {{ old('status') == 'out_of_stock' ? 'selected' : '' }}>Hết hàng</option>
                        <option value="discontinued" {{ old('status') == 'discontinued' ? 'selected' : '' }}>Ngừng kinh doanh</option>
                    </select>
                </div>

                <div class="form-group full-width">
                    <label for="origin">Nguồn gốc / Xuất xứ</label>
                    <input type="text" id="origin" name="origin" value="{{ old('origin') }}" 
                           class="form-control @error('origin') is-invalid @enderror" placeholder="Ví dụ: Cty Dược Lai Châu, Nhập khẩu TQ...">
                </div>

                <div class="form-group full-width">
                    <label for="note">Ghi chú thêm</label>
                    <textarea id="note" name="note" class="form-control @error('note') is-invalid @enderror" placeholder="Tuỳ chọn...">{{ old('note') }}</textarea>
                </div>
            </div>

            <div class="form-actions">
                <button type="submit" class="btn-submit">
                    💾 Tạo Dược liệu
                </button>
                <a href="{{ route('admin.medicinal-herbs.index') }}" class="btn-cancel">
                    Huỷ bỏ
                </a>
            </div>
        </form>
    </div>
@endsection
