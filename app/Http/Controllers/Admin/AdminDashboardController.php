<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class AdminDashboardController extends Controller
{
    public function index()
    {
        // Đếm an toàn — nếu bảng chưa tồn tại thì trả 0
        $stats = [
            'patients'      => $this->safeCount('patients'),
            'records'       => $this->safeCount('medical_records'),
            'prescriptions' => $this->safeCount('prescriptions'),
            'herbs'         => $this->safeCount('herbs'),
            'posts'         => $this->safeCount('posts'),
            'comments'      => $this->safeCount('comments'),
            'users'         => $this->safeCount('users'),
            'staff'         => $this->countByRole('staff'),
        ];

        // Lấy 5 user mới nhất
        $recentUsers = [];
        if (Schema::hasTable('users')) {
            $recentUsers = DB::table('users')
                ->orderByDesc('created_at')
                ->limit(5)
                ->get(['id', 'name', 'email', 'phone', 'created_at']);
        }

        return view('admin.dashboard', compact('stats', 'recentUsers'));
    }

    private function safeCount(string $table): int
    {
        try {
            if (Schema::hasTable($table)) {
                return DB::table($table)->count();
            }
        } catch (\Exception $e) {
            // Bảng chưa tồn tại hoặc lỗi — bỏ qua
        }
        return 0;
    }

    private function countByRole(string $roleName): int
    {
        try {
            if (Schema::hasTable('role_user') && Schema::hasTable('roles')) {
                return DB::table('role_user')
                    ->join('roles', 'roles.id', '=', 'role_user.role_id')
                    ->where('roles.name', $roleName)
                    ->count();
            }
        } catch (\Exception $e) {
            // ignore
        }
        return 0;
    }
}