<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Patient;
use Illuminate\Http\Request;

class PatientController extends Controller
{
    /**
     * Danh sách bệnh nhân — tìm kiếm + phân trang
     */
    public function index(Request $request)
    {
        $query = Patient::query();

        // Tìm kiếm theo tên hoặc SĐT
        if ($search = $request->input('search')) {
            $query->where(function ($q) use ($search) {
                $q->where('full_name', 'like', "%{$search}%")
                  ->orWhere('phone', 'like', "%{$search}%");
            });
        }

        $patients = $query->orderByDesc('created_at')->paginate(10)->withQueryString();

        return view('admin.patients.index', compact('patients'));
    }

    /**
     * Form thêm bệnh nhân mới
     */
    public function create()
    {
        return view('admin.patients.create');
    }

    /**
     * Lưu bệnh nhân mới vào database
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'full_name'     => 'required|string|max:255',
            'gender'        => 'required|in:male,female,other',
            'date_of_birth' => 'nullable|date|before:today',
            'phone'         => 'nullable|string|max:20|unique:patients,phone',
            'address'       => 'nullable|string|max:500',
            'note'          => 'nullable|string|max:1000',
        ], [
            'full_name.required'     => 'Vui lòng nhập họ và tên bệnh nhân.',
            'full_name.max'          => 'Họ tên không được vượt quá 255 ký tự.',
            'gender.required'        => 'Vui lòng chọn giới tính.',
            'gender.in'              => 'Giới tính không hợp lệ.',
            'date_of_birth.date'     => 'Ngày sinh không hợp lệ.',
            'date_of_birth.before'   => 'Ngày sinh phải trước ngày hôm nay.',
            'phone.max'              => 'Số điện thoại không được vượt quá 20 ký tự.',
            'phone.unique'           => 'Số điện thoại này đã được đăng ký cho bệnh nhân khác.',
            'address.max'            => 'Địa chỉ không được vượt quá 500 ký tự.',
            'note.max'               => 'Ghi chú không được vượt quá 1000 ký tự.',
        ]);

        Patient::create($validated);

        return redirect()->route('admin.patients.index')
            ->with('success', 'Đã thêm bệnh nhân thành công.');
    }

    /**
     * Xem chi tiết bệnh nhân
     */
    public function show(Patient $patient)
    {
        return view('admin.patients.show', compact('patient'));
    }

    /**
     * Form chỉnh sửa bệnh nhân
     */
    public function edit(Patient $patient)
    {
        return view('admin.patients.edit', compact('patient'));
    }

    /**
     * Cập nhật thông tin bệnh nhân
     */
    public function update(Request $request, Patient $patient)
    {
        $validated = $request->validate([
            'full_name'     => 'required|string|max:255',
            'gender'        => 'required|in:male,female,other',
            'date_of_birth' => 'nullable|date|before:today',
            'phone'         => 'nullable|string|max:20|unique:patients,phone,' . $patient->id,
            'address'       => 'nullable|string|max:500',
            'note'          => 'nullable|string|max:1000',
        ], [
            'full_name.required'     => 'Vui lòng nhập họ và tên bệnh nhân.',
            'full_name.max'          => 'Họ tên không được vượt quá 255 ký tự.',
            'gender.required'        => 'Vui lòng chọn giới tính.',
            'gender.in'              => 'Giới tính không hợp lệ.',
            'date_of_birth.date'     => 'Ngày sinh không hợp lệ.',
            'date_of_birth.before'   => 'Ngày sinh phải trước ngày hôm nay.',
            'phone.max'              => 'Số điện thoại không được vượt quá 20 ký tự.',
            'phone.unique'           => 'Số điện thoại này đã được đăng ký cho bệnh nhân khác.',
            'address.max'            => 'Địa chỉ không được vượt quá 500 ký tự.',
            'note.max'               => 'Ghi chú không được vượt quá 1000 ký tự.',
        ]);

        $patient->update($validated);

        return redirect()->route('admin.patients.index')
            ->with('success', 'Đã cập nhật thông tin bệnh nhân thành công.');
    }

    /**
     * Xoá bệnh nhân
     */
    public function destroy(Patient $patient)
    {
        try {
            $patient->delete();

            return redirect()->route('admin.patients.index')
                ->with('success', 'Đã xoá bệnh nhân "' . $patient->full_name . '" thành công.');
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect()->route('admin.patients.index')
                ->with('error', 'Không thể xoá bệnh nhân "' . $patient->full_name . '" vì đang có hồ sơ bệnh án hoặc đơn thuốc liên quan.');
        }
    }
}
