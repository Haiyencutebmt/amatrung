<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\MedicinalHerb;
use Illuminate\Http\Request;

class MedicinalHerbController extends Controller
{
    public function index(Request $request)
    {
        // Chỉ hiện những dược liệu đang kinh doanh hoặc sẵn sàng
        $query = MedicinalHerb::whereIn('status', ['available', 'out_of_stock'])->latest();
        
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('herb_code', 'like', "%{$search}%")
                  ->orWhere('note', 'like', "%{$search}%");
            });
        }

        $herbs = $query->paginate(12)->withQueryString();

        return view('user.medicinal_herbs.index', compact('herbs'));
    }

    public function show($id)
    {
        $herb = MedicinalHerb::where('id', $id)
            ->whereIn('status', ['available', 'out_of_stock'])
            ->firstOrFail();

        return view('user.medicinal_herbs.show', compact('herb'));
    }
}
