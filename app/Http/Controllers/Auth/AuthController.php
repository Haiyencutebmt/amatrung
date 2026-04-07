<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showRegister()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:20|unique:users,phone',
            'email' => 'nullable|email|unique:users,email',
            'gender' => 'nullable|in:male,female,other',
            'date_of_birth' => 'nullable|date',
            'password' => 'required|string|min:8|confirmed',
        ], [
            'name.required' => 'Vui lòng nhập họ tên.',
            'phone.required' => 'Vui lòng nhập số điện thoại.',
            'phone.unique' => 'Số điện thoại đã tồn tại.',
            'email.email' => 'Email không đúng định dạng.',
            'email.unique' => 'Email đã tồn tại.',
            'password.required' => 'Vui lòng nhập mật khẩu.',
            'password.min' => 'Mật khẩu tối thiểu 8 ký tự.',
            'password.confirmed' => 'Xác nhận mật khẩu không khớp.',
        ]);

        $user = User::create([
            'name' => $request->name,
            'phone' => $request->phone,
            'email' => $request->email,
            'gender' => $request->gender,
            'date_of_birth' => $request->date_of_birth,
            'password' => Hash::make($request->password),
            'status' => 1,
        ]);

        $userRole = Role::where('name', 'user')->first();

        if ($userRole) {
            $user->roles()->attach($userRole->id);
        }

        Auth::login($user);

        return redirect()->route('user.dashboard')
            ->with('success', 'Đăng ký tài khoản thành công.');
    }

    public function showLogin()
    {
        return view('auth.login');
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

    if ($user && $user->hasRole('user')) {
        return redirect()->route('user.dashboard')
            ->with('success', 'Đăng nhập thành công.');
    }

    Auth::logout();

    return back()->withErrors([
        'login' => 'Tài khoản này không được đăng nhập ở khu vực người dùng.',
    ])->onlyInput('login');
}

        return back()->withErrors([
            'login' => 'Thông tin đăng nhập không chính xác.',
        ])->onlyInput('login');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}