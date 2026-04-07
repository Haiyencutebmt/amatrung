<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MedicalRecord;
use App\Models\Prescription;
use Illuminate\Http\Request;

class PrescriptionController extends Controller
{
    /**
     * Danh sách đơn thuốc
     */
    public function index(Request $request)
    {
        $query = Prescription::with('medicalRecord.patient')->latest();

        // Tìm kiếm
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where('prescription_code', 'like', "%{$search}%")
                  ->orWhereHas('medicalRecord', function ($q) use ($search) {
                      $q->where('record_code', 'like', "%{$search}%")
                        ->orWhereHas('patient', function ($q2) use ($search) {
                            $q2->where('full_name', 'like', "%{$search}%");
                        });
                  });
        }

        $prescriptions = $query->paginate(10)->withQueryString();

        return view('admin.prescriptions.index', compact('prescriptions'));
    }

    /**
     * Show form thêm mới đơn thuốc
     */
    public function create(Request $request)
    {
        $selectedRecordId = $request->get('medical_record_id');
        // Lấy danh sách hồ sơ (có thể chỉ lấy những hồ sơ gần đây hoặc tìm kiếm qua ajax sau, tạm thời lấy hết hoặc limit)
        $records = MedicalRecord::with('patient')->latest()->get();

        return view('admin.prescriptions.create', compact('records', 'selectedRecordId'));
    }

    /**
     * Lưu đơn thuốc
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'medical_record_id' => 'required|exists:medical_records,id',
            'prescribed_date' => 'required|date',
            'general_note' => 'nullable|string',
            'usage_instruction' => 'nullable|string',
            'status' => 'required|in:active,completed,cancelled',
        ], [
            'medical_record_id.required' => 'Vui lòng chọn hồ sơ bệnh án.',
            'prescribed_date.required' => 'Vui lòng chọn ngày kê đơn.',
        ]);

        $validated['prescription_code'] = 'DT-' . date('Ymd') . '-' . strtoupper(substr(uniqid(), -4));

        Prescription::create($validated);

        return redirect()->route('admin.prescriptions.index')
            ->with('success', 'Đã thêm đơn thuốc thành công.');
    }

    /**
     * Chi tiết đơn thuốc
     */
    public function show(Prescription $prescription)
    {
        $prescription->load('medicalRecord.patient');
        return view('admin.prescriptions.show', compact('prescription'));
    }

    /**
     * Show form sửa đơn
     */
    public function edit(Prescription $prescription)
    {
        $records = MedicalRecord::with('patient')->latest()->get();
        return view('admin.prescriptions.edit', compact('prescription', 'records'));
    }

    /**
     * Cập nhật đơn
     */
    public function update(Request $request, Prescription $prescription)
    {
        $validated = $request->validate([
            'medical_record_id' => 'required|exists:medical_records,id',
            'prescribed_date' => 'required|date',
            'general_note' => 'nullable|string',
            'usage_instruction' => 'nullable|string',
            'status' => 'required|in:active,completed,cancelled',
        ]);

        $prescription->update($validated);

        return redirect()->route('admin.prescriptions.index')
            ->with('success', 'Đã cập nhật đơn thuốc thành công.');
    }

    /**
     * Xóa đơn thuốc
     */
    public function destroy(Prescription $prescription)
    {
        try {
            $code = $prescription->prescription_code;
            $prescription->delete();

            return redirect()->route('admin.prescriptions.index')
                ->with('success', 'Đã xóa đơn thuốc "' . $code . '" thành công.');
        } catch (\Exception $e) {
            return redirect()->route('admin.prescriptions.index')
                ->with('error', 'Không thể xóa đơn thuốc này.');
        }
    }
}
