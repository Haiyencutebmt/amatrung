@extends('layouts.admin')

@section('title', 'Sửa đơn thuốc')
@section('page-title', 'Sửa đơn thuốc')

@include('admin.patients._form-styles')

@section('content')
    <div class="form-card">
        <div class="form-header">
            <h2>Cập nhật Đơn thuốc {{ $prescription->prescription_code }}</h2>
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

        <form action="{{ route('admin.prescriptions.update', $prescription) }}" method="POST">
            @csrf
            @method('PUT')
            
            <div class="form-grid">
                <div class="form-group full-width">
                    <label for="medical_record_id">Hồ sơ bệnh án <span class="required">*</span></label>
                    <select name="medical_record_id" id="medical_record_id" class="form-control @error('medical_record_id') is-invalid @enderror" required>
                        <option value="">-- Chọn hồ sơ bệnh án --</option>
                        @foreach($records as $record)
                            <option value="{{ $record->id }}" 
                                {{ old('medical_record_id', $prescription->medical_record_id) == $record->id ? 'selected' : '' }}>
                                {{ $record->record_code }} - {{ $record->patient->full_name }} (Khám ngày: {{ $record->visit_date->format('d/m/Y') }})
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="prescribed_date">Ngày kê đơn <span class="required">*</span></label>
                    <input type="date" id="prescribed_date" name="prescribed_date" value="{{ old('prescribed_date', $prescription->prescribed_date->format('Y-m-d')) }}" 
                           class="form-control @error('prescribed_date') is-invalid @enderror" required>
                </div>

                <div class="form-group">
                    <label for="status">Trạng thái <span class="required">*</span></label>
                    <select name="status" id="status" class="form-control @error('status') is-invalid @enderror" required>
                        <option value="active" {{ old('status', $prescription->status) == 'active' ? 'selected' : '' }}>Đang sử dụng</option>
                        <option value="completed" {{ old('status', $prescription->status) == 'completed' ? 'selected' : '' }}>Hoàn thành</option>
                        <option value="cancelled" {{ old('status', $prescription->status) == 'cancelled' ? 'selected' : '' }}>Đã hủy</option>
                    </select>
                </div>

                <div class="form-group full-width">
                    <label for="usage_instruction">Hướng dẫn sử dụng chung</label>
                    <textarea id="usage_instruction" name="usage_instruction" class="form-control @error('usage_instruction') is-invalid @enderror" placeholder="Ví dụ: Sắc uống ngày 1 thang, chia 3 lần...">{{ old('usage_instruction', $prescription->usage_instruction) }}</textarea>
                </div>

                <div class="form-group full-width">
                    <label for="general_note">Ghi chú, lời dặn thêm</label>
                    <textarea id="general_note" name="general_note" class="form-control @error('general_note') is-invalid @enderror" placeholder="Ví dụ: Kiêng đồ cay nóng, hải sản...">{{ old('general_note', $prescription->general_note) }}</textarea>
                </div>
            </div>

            <div class="form-actions">
                <button type="submit" class="btn-submit">
                    💾 Cập nhật đơn thuốc
                </button>
                <a href="{{ route('admin.prescriptions.index') }}" class="btn-cancel">
                    Huỷ bỏ
                </a>
            </div>
        </form>
    </div>
@endsection
