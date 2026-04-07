<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MedicalRecord;
use App\Models\MedicinalHerb;
use App\Models\Prescription;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
        $records = MedicalRecord::with('patient')->latest()->get();
        $herbs = MedicinalHerb::where('status', '!=', 'discontinued')->orderBy('name')->get();

        return view('admin.prescriptions.create', compact('records', 'selectedRecordId', 'herbs'));
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
            'items' => 'required|array|min:1',
            'items.*.medicinal_herb_id' => 'required|exists:medicinal_herbs,id',
            'items.*.quantity' => 'required|numeric|min:0.01',
            'items.*.unit' => 'nullable|string|max:50',
            'items.*.instruction' => 'nullable|string',
        ], [
            'medical_record_id.required' => 'Vui lòng chọn hồ sơ bệnh án.',
            'prescribed_date.required' => 'Vui lòng chọn ngày kê đơn.',
            'items.required' => 'Đơn thuốc phải có ít nhất một vị thuốc.',
        ]);

        DB::beginTransaction();
        try {
            // Kiểm tra tồn kho
            foreach ($request->items as $item) {
                $herb = MedicinalHerb::find($item['medicinal_herb_id']);
                if ($herb->quantity_in_stock < $item['quantity']) {
                    return back()->withInput()->withErrors(['items' => "Dược liệu '{$herb->name}' không đủ tồn kho (còn: " . floatval($herb->quantity_in_stock) . "). Cần: {$item['quantity']}."]);
                }
            }

            $validated['prescription_code'] = 'DT-' . date('Ymd') . '-' . strtoupper(substr(uniqid(), -4));

            $prescription = Prescription::create($validated);

            foreach ($request->items as $item) {
                $prescription->items()->create($item);
                
                // Trừ tồn kho
                $herb = MedicinalHerb::find($item['medicinal_herb_id']);
                $herb->decrement('quantity_in_stock', $item['quantity']);
            }

            DB::commit();
            return redirect()->route('admin.prescriptions.index')
                ->with('success', 'Đã thêm đơn thuốc thành công.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withInput()->withErrors(['error' => 'Đã xảy ra lỗi khi tạo đơn thuốc: ' . $e->getMessage()]);
        }
    }

    /**
     * Chi tiết đơn thuốc
     */
    public function show(Prescription $prescription)
    {
        $prescription->load(['medicalRecord.patient', 'items.herb']);
        return view('admin.prescriptions.show', compact('prescription'));
    }

    /**
     * In đơn thuốc
     */
    public function print(Prescription $prescription)
    {
        $prescription->load(['medicalRecord.patient', 'items.herb']);
        return view('admin.prescriptions.print', compact('prescription'));
    }

    /**
     * Show form sửa đơn
     */
    public function edit(Prescription $prescription)
    {
        $prescription->load('items.herb');
        $records = MedicalRecord::with('patient')->latest()->get();
        $herbs = MedicinalHerb::where('status', '!=', 'discontinued')->orderBy('name')->get();
        return view('admin.prescriptions.edit', compact('prescription', 'records', 'herbs'));
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
            'items' => 'required|array|min:1',
            'items.*.medicinal_herb_id' => 'required|exists:medicinal_herbs,id',
            'items.*.quantity' => 'required|numeric|min:0.01',
            'items.*.unit' => 'nullable|string|max:50',
            'items.*.instruction' => 'nullable|string',
        ], [
            'items.required' => 'Đơn thuốc phải có ít nhất một vị thuốc.',
        ]);

        DB::beginTransaction();
        try {
            // Hoàn lại kho cũ tạm thời
            $prescription->load('items');
            foreach ($prescription->items as $oldItem) {
                MedicinalHerb::find($oldItem->medicinal_herb_id)->increment('quantity_in_stock', $oldItem->quantity);
            }

            // Kiểm tra tồn kho cho các item mới
            foreach ($request->items as $item) {
                $herb = MedicinalHerb::find($item['medicinal_herb_id']);
                if ($herb->quantity_in_stock < $item['quantity']) {
                    DB::rollBack();
                    return back()->withInput()->withErrors(['items' => "Dược liệu '{$herb->name}' không đủ tồn kho (còn: " . floatval($herb->quantity_in_stock) . ")."]);
                }
            }

            $prescription->update($validated);
            $prescription->items()->delete(); // Xoá item cũ

            foreach ($request->items as $item) {
                $prescription->items()->create($item);
                // Trừ tồn kho
                MedicinalHerb::find($item['medicinal_herb_id'])->decrement('quantity_in_stock', $item['quantity']);
            }

            DB::commit();
            return redirect()->route('admin.prescriptions.index')
                ->with('success', 'Đã cập nhật đơn thuốc thành công.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withInput()->withErrors(['error' => 'Đã xảy ra lỗi: ' . $e->getMessage()]);
        }
    }

    /**
     * Xóa đơn thuốc
     */
    public function destroy(Prescription $prescription)
    {
        DB::beginTransaction();
        try {
            $code = $prescription->prescription_code;
            
            // Hoàn lại tồn kho
            foreach ($prescription->items as $oldItem) {
                MedicinalHerb::find($oldItem->medicinal_herb_id)->increment('quantity_in_stock', $oldItem->quantity);
            }

            $prescription->delete();
            DB::commit();

            return redirect()->route('admin.prescriptions.index')
                ->with('success', 'Đã xóa đơn thuốc "' . $code . '" thành công.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('admin.prescriptions.index')
                ->with('error', 'Không thể xóa đơn thuốc này.');
        }
    }
}
