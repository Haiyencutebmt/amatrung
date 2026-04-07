<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;

class UserDashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        // Tính tuổi nếu có ngày sinh
        $age = null;
        if ($user->date_of_birth) {
            $age = $user->date_of_birth->age;
        }

        // Map giới tính
        $genderMap = [
            'male'   => 'Nam',
            'female' => 'Nữ',
            'other'  => 'Khác',
        ];
        $gender = $genderMap[$user->gender] ?? '—';

        return view('user.dashboard', compact('user', 'age', 'gender'));
    }
}