<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MedicalRecord;
use App\Models\Patient;
use Illuminate\Http\Request;

class MedicalRecordController extends Controller
{
    /**
     * Hiển thị danh sách hồ sơ bệnh án
     */
    public function index(Request $request)
    {
        $query = MedicalRecord::with('patient')->latest();

        // Tìm kiếm
        if ($request->filled('search')) {
            $search = $request->search;
            $query->whereHas('patient', function ($q) use ($search) {
                $q->where('full_name', 'like', "%{$search}%")
                  ->orWhere('phone', 'like', "%{$search}%");
            })->orWhere('record_code', 'like', "%{$search}%");
        }

        $records = $query->paginate(10)->withQueryString();

        return view('admin.medical_records.index', compact('records'));
    }

    /**
     * Show form tạo hồ sơ bệnh án
     */
    public function create(Request $request)
    {
        // Có thể truyền patient_id nếu tạo từ trang chi tiết bệnh nhân
        $selectedPatientId = $request->get('patient_id');
        $patients = Patient::orderBy('full_name')->get();
        return view('admin.medical_records.create', compact('patients', 'selectedPatientId'));
    }

    /**
     * Lưu hồ sơ bệnh án mới
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'patient_id' => 'required|exists:patients,id',
            'visit_date' => 'required|date',
            'symptoms' => 'required|string',
            'diagnosis' => 'nullable|string',
            'treatment_note' => 'nullable|string',
            'follow_up_date' => 'nullable|date|after_or_equal:visit_date',
            'note' => 'nullable|string',
        ], [
            'patient_id.required' => 'Vui lòng chọn bệnh nhân.',
            'patient_id.exists' => 'Bệnh nhân không hợp lệ.',
            'visit_date.required' => 'Vui lòng chọn ngày khám.',
            'visit_date.date' => 'Ngày khám không hợp lệ.',
            'symptoms.required' => 'Vui lòng nhập triệu chứng.',
            'follow_up_date.after_or_equal' => 'Ngày tái khám phải sau hoặc bằng ngày khám.',
        ]);

        // Tạo mã hồ sơ tự động (HSBA-YYYYMMDD-Rand)
        $validated['record_code'] = 'HSBA-' . date('Ymd') . '-' . strtoupper(substr(uniqid(), -4));

        MedicalRecord::create($validated);

        return redirect()->route('admin.medical-records.index')
            ->with('success', 'Đã thêm hồ sơ bệnh án thành công.');
    }

    /**
     * Xem chi tiết hồ sơ
     */
    public function show(MedicalRecord $medicalRecord)
    {
        $medicalRecord->load('patient');
        return view('admin.medical_records.show', compact('medicalRecord'));
    }

    /**
     * Show form sửa hồ sơ
     */
    public function edit(MedicalRecord $medicalRecord)
    {
        $patients = Patient::orderBy('full_name')->get();
        return view('admin.medical_records.edit', compact('medicalRecord', 'patients'));
    }

    /**
     * Cập nhật hồ sơ
     */
    public function update(Request $request, MedicalRecord $medicalRecord)
    {
        $validated = $request->validate([
            'patient_id' => 'required|exists:patients,id',
            'visit_date' => 'required|date',
            'symptoms' => 'required|string',
            'diagnosis' => 'nullable|string',
            'treatment_note' => 'nullable|string',
            'follow_up_date' => 'nullable|date|after_or_equal:visit_date',
            'note' => 'nullable|string',
        ], [
            'patient_id.required' => 'Vui lòng chọn bệnh nhân.',
            'patient_id.exists' => 'Bệnh nhân không hợp lệ.',
            'visit_date.required' => 'Vui lòng chọn ngày khám.',
            'visit_date.date' => 'Ngày khám không hợp lệ.',
            'symptoms.required' => 'Vui lòng nhập triệu chứng.',
            'follow_up_date.after_or_equal' => 'Ngày tái khám phải sau hoặc bằng ngày khám.',
        ]);

        $medicalRecord->update($validated);

        return redirect()->route('admin.medical-records.index')
            ->with('success', 'Đã cập nhật hồ sơ bệnh án thành công.');
    }

    /**
     * Xoá hồ sơ
     */
    public function destroy(MedicalRecord $medicalRecord)
    {
        try {
            $recordCode = $medicalRecord->record_code;
            $medicalRecord->delete();

            return redirect()->route('admin.medical-records.index')
                ->with('success', 'Đã xoá hồ sơ "' . $recordCode . '" thành công.');
        } catch (\Exception $e) {
            return redirect()->route('admin.medical-records.index')
                ->with('error', 'Không thể xoá hồ sơ này.');
        }
    }
}
