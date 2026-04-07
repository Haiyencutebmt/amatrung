@extends('layouts.admin')

@section('title', 'Thêm hồ sơ bệnh án mới')
@section('page-title', 'Thêm hồ sơ bệnh án')

@include('admin.patients._form-styles')

@section('content')
    <div class="form-card">
        <div class="form-header">
            <h2>Hồ sơ khám bệnh</h2>
            <a href="{{ route('admin.medical-records.index') }}" class="btn-back">
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

        <form action="{{ route('admin.medical-records.store') }}" method="POST">
            @csrf
            
            <div class="form-grid">
                <div class="form-group full-width">
                    <label for="patient_id">Bệnh nhân <span class="required">*</span></label>
                    <select name="patient_id" id="patient_id" class="form-control @error('patient_id') is-invalid @enderror" required>
                        <option value="">-- Chọn bệnh nhân --</option>
                        @foreach($patients as $patient)
                            <option value="{{ $patient->id }}" 
                                {{ (old('patient_id') == $patient->id || $selectedPatientId == $patient->id) ? 'selected' : '' }}>
                                {{ $patient->full_name }} ({{ $patient->phone ?: 'Không có SĐT' }})
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="visit_date">Ngày khám <span class="required">*</span></label>
                    <input type="date" id="visit_date" name="visit_date" value="{{ old('visit_date', date('Y-m-d')) }}" 
                           class="form-control @error('visit_date') is-invalid @enderror" required>
                </div>

                <div class="form-group">
                    <label for="follow_up_date">Ngày tái khám (nếu có)</label>
                    <input type="date" id="follow_up_date" name="follow_up_date" value="{{ old('follow_up_date') }}" 
                           class="form-control @error('follow_up_date') is-invalid @enderror">
                </div>

                <div class="form-group full-width">
                    <label for="symptoms">Triệu chứng <span class="required">*</span></label>
                    <textarea id="symptoms" name="symptoms" class="form-control @error('symptoms') is-invalid @enderror" required>{{ old('symptoms') }}</textarea>
                </div>

                <div class="form-group full-width">
                    <label for="diagnosis">Chẩn đoán</label>
                    <textarea id="diagnosis" name="diagnosis" class="form-control @error('diagnosis') is-invalid @enderror">{{ old('diagnosis') }}</textarea>
                </div>

                <div class="form-group full-width">
                    <label for="treatment_note">Ghi chú điều trị / Hướng xử lý</label>
                    <textarea id="treatment_note" name="treatment_note" class="form-control @error('treatment_note') is-invalid @enderror">{{ old('treatment_note') }}</textarea>
                </div>

                <div class="form-group full-width">
                    <label for="note">Ghi chú thêm</label>
                    <textarea id="note" name="note" class="form-control @error('note') is-invalid @enderror">{{ old('note') }}</textarea>
                </div>
            </div>

            <div class="form-actions">
                <button type="submit" class="btn-submit">
                    💾 Lưu hồ sơ
                </button>
                <a href="{{ route('admin.medical-records.index') }}" class="btn-cancel">
                    Huỷ bỏ
                </a>
            </div>
        </form>
    </div>
@endsection
