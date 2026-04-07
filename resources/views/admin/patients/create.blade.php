@extends('layouts.admin')

@section('title', 'Thêm bệnh nhân')
@section('page-title', 'Thêm bệnh nhân mới')

@include('admin.patients._form-styles')

@section('content')
    <div class="form-card">
        <div class="form-header">
            <h2>📝 Thêm bệnh nhân mới</h2>
            <a href="{{ route('admin.patients.index') }}" class="btn-back">← Quay lại</a>
        </div>

        @if($errors->any())
            <div class="error-summary">
                <strong>⚠️ Vui lòng kiểm tra lại thông tin:</strong>
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('admin.patients.store') }}">
            @csrf

            <div class="form-grid">
                {{-- Họ và tên --}}
                <div class="form-group full-width">
                    <label>Họ và tên <span class="required">*</span></label>
                    <input type="text" name="full_name" value="{{ old('full_name') }}"
                           class="form-control {{ $errors->has('full_name') ? 'is-invalid' : '' }}"
                           placeholder="Nhập họ và tên bệnh nhân">
                    @error('full_name')
                        <div class="invalid-feedback">⚠ {{ $message }}</div>
                    @enderror
                </div>

                {{-- Giới tính --}}
                <div class="form-group">
                    <label>Giới tính <span class="required">*</span></label>
                    <select name="gender" class="form-control {{ $errors->has('gender') ? 'is-invalid' : '' }}">
                        <option value="male" {{ old('gender') == 'male' ? 'selected' : '' }}>Nam</option>
                        <option value="female" {{ old('gender') == 'female' ? 'selected' : '' }}>Nữ</option>
                        <option value="other" {{ old('gender') == 'other' ? 'selected' : '' }}>Khác</option>
                    </select>
                    @error('gender')
                        <div class="invalid-feedback">⚠ {{ $message }}</div>
                    @enderror
                </div>

                {{-- Ngày sinh --}}
                <div class="form-group">
                    <label>Ngày sinh</label>
                    <input type="date" name="date_of_birth" value="{{ old('date_of_birth') }}"
                           class="form-control {{ $errors->has('date_of_birth') ? 'is-invalid' : '' }}">
                    @error('date_of_birth')
                        <div class="invalid-feedback">⚠ {{ $message }}</div>
                    @enderror
                </div>

                {{-- Số điện thoại --}}
                <div class="form-group">
                    <label>Số điện thoại</label>
                    <input type="text" name="phone" value="{{ old('phone') }}"
                           class="form-control {{ $errors->has('phone') ? 'is-invalid' : '' }}"
                           placeholder="VD: 0912345678">
                    @error('phone')
                        <div class="invalid-feedback">⚠ {{ $message }}</div>
                    @enderror
                </div>

                {{-- Địa chỉ --}}
                <div class="form-group full-width">
                    <label>Địa chỉ</label>
                    <input type="text" name="address" value="{{ old('address') }}"
                           class="form-control {{ $errors->has('address') ? 'is-invalid' : '' }}"
                           placeholder="VD: 123 Đường ABC, Phường XYZ, TP. HCM">
                    @error('address')
                        <div class="invalid-feedback">⚠ {{ $message }}</div>
                    @enderror
                </div>

                {{-- Ghi chú --}}
                <div class="form-group full-width">
                    <label>Ghi chú</label>
                    <textarea name="note"
                              class="form-control {{ $errors->has('note') ? 'is-invalid' : '' }}"
                              placeholder="Tiền sử bệnh, dị ứng, ghi chú đặc biệt...">{{ old('note') }}</textarea>
                    @error('note')
                        <div class="invalid-feedback">⚠ {{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="form-actions">
                <button type="submit" class="btn-submit">💾 Lưu bệnh nhân</button>
                <a href="{{ route('admin.patients.index') }}" class="btn-cancel">Huỷ bỏ</a>
            </div>
        </form>
    </div>
@endsection
