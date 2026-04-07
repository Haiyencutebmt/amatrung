<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MedicinalHerb;
use Illuminate\Http\Request;

class MedicinalHerbController extends Controller
{
    /**
     * Danh sách dược liệu
     */
    public function index(Request $request)
    {
        $query = MedicinalHerb::query()->latest();

        // Tìm kiếm
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where('name', 'like', "%{$search}%")
                  ->orWhere('herb_code', 'like', "%{$search}%");
        }

        $herbs = $query->paginate(10)->withQueryString();

        return view('admin.medicinal_herbs.index', compact('herbs'));
    }

    /**
     * Show form thêm mới
     */
    public function create()
    {
        return view('admin.medicinal_herbs.create');
    }

    /**
     * Lưu dược liệu
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'unit' => 'required|string|max:50',
            'quantity_in_stock' => 'required|numeric|min:0',
            'expiry_date' => 'nullable|date',
            'origin' => 'nullable|string|max:255',
            'note' => 'nullable|string',
            'status' => 'required|in:available,out_of_stock,discontinued',
        ], [
            'name.required' => 'Vui lòng nhập tên dược liệu.',
            'unit.required' => 'Vui lòng nhập đơn vị tính.',
            'quantity_in_stock.required' => 'Vui lòng nhập số lượng tồn kho.',
            'quantity_in_stock.numeric' => 'Số lượng phải là một chữ số.',
        ]);

        // Tạo mã dược liệu duy nhất
        $validated['herb_code'] = 'DL-' . strtoupper(substr(uniqid(), -6));

        MedicinalHerb::create($validated);

        return redirect()->route('admin.medicinal-herbs.index')
            ->with('success', 'Đã thêm dược liệu thành công.');
    }

    /**
     * Chi tiết dược liệu
     */
    public function show(MedicinalHerb $medicinalHerb)
    {
        return view('admin.medicinal_herbs.show', compact('medicinalHerb'));
    }

    /**
     * Show form sửa
     */
    public function edit(MedicinalHerb $medicinalHerb)
    {
        return view('admin.medicinal_herbs.edit', compact('medicinalHerb'));
    }

    /**
     * Cập nhật
     */
    public function update(Request $request, MedicinalHerb $medicinalHerb)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'unit' => 'required|string|max:50',
            'quantity_in_stock' => 'required|numeric|min:0',
            'expiry_date' => 'nullable|date',
            'origin' => 'nullable|string|max:255',
            'note' => 'nullable|string',
            'status' => 'required|in:available,out_of_stock,discontinued',
        ], [
            'name.required' => 'Vui lòng nhập tên dược liệu.',
            'unit.required' => 'Vui lòng nhập đơn vị tính.',
            'quantity_in_stock.required' => 'Vui lòng nhập số lượng tồn kho.',
        ]);

        $medicinalHerb->update($validated);

        return redirect()->route('admin.medicinal-herbs.index')
            ->with('success', 'Đã cập nhật dược liệu thành công.');
    }

    /**
     * Xóa dược liệu
     */
    public function destroy(MedicinalHerb $medicinalHerb)
    {
        try {
            $name = $medicinalHerb->name;
            $medicinalHerb->delete();

            return redirect()->route('admin.medicinal-herbs.index')
                ->with('success', 'Đã xóa dược liệu "' . $name . '" thành công.');
        } catch (\Exception $e) {
            return redirect()->route('admin.medicinal-herbs.index')
                ->with('error', 'Không thể xóa dược liệu này do đang được sử dụng ở nơi khác.');
        }
    }
}
