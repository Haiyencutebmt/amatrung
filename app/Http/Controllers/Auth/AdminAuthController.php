<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class AdminAuthController extends Controller
{
    public function showLogin()
    {
        return view('admin.auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'login' => 'required|string',
            'password' => 'required|string',
        ], [
            'login.required' => 'Vui lòng nhập email hoặc số điện thoại.',
            'password.required' => 'Vui lòng nhập mật khẩu.',
        ]);

        $loginField = filter_var($request->login, FILTER_VALIDATE_EMAIL) ? 'email' : 'phone';

        $credentials = [
            $loginField => $request->login,
            'password' => $request->password,
            'status' => 1,
        ];

        if (Auth::attempt($credentials, $request->boolean('remember'))) {
    $request->session()->regenerate();

    /** @var User|null $user */
    $user = Auth::user();

    if ($user && $user->hasAnyRole(['admin', 'staff'])) {
        return redirect()->route('admin.dashboard')
            ->with('success', 'Đăng nhập quản trị thành công.');
    }

    Auth::logout();

    return back()->withErrors([
        'login' => 'Tài khoản này không có quyền truy cập khu vực quản trị.',
    ])->onlyInput('login');
}

        return back()->withErrors([
            'login' => 'Thông tin đăng nhập không chính xác.',
        ])->onlyInput('login');
    }
}