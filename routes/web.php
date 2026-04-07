<?php

use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\PatientController;
use App\Http\Controllers\Auth\AdminAuthController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\User\UserDashboardController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('login');
});

// User auth
Route::middleware('guest')->group(function () {
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register'])->name('register.submit');

    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.submit');

    Route::get('/admin/login', [AdminAuthController::class, 'showLogin'])->name('admin.login');
    Route::post('/admin/login', [AdminAuthController::class, 'login'])->name('admin.login.submit');
});

Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

// User area
Route::middleware(['auth', 'role:user'])->group(function () {
    Route::get('/user/dashboard', [UserDashboardController::class, 'index'])->name('user.dashboard');
});

// Admin area
Route::prefix('admin')->middleware(['auth', 'role:admin,staff'])->group(function () {
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');

    // Quản lý bệnh nhân
    Route::resource('patients', PatientController::class)->names('admin.patients');

    // Quản lý Hồ sơ bệnh án
    Route::resource('medical-records', \App\Http\Controllers\Admin\MedicalRecordController::class)->names('admin.medical-records');

    // Quản lý Đơn thuốc
    Route::get('prescriptions/{prescription}/print', [\App\Http\Controllers\Admin\PrescriptionController::class, 'print'])->name('admin.prescriptions.print');
    Route::resource('prescriptions', \App\Http\Controllers\Admin\PrescriptionController::class)->names('admin.prescriptions');

    // Quản lý Dược liệu
    Route::resource('medicinal-herbs', \App\Http\Controllers\Admin\MedicinalHerbController::class)->names('admin.medicinal-herbs');

    // Quản lý Bài viết
    Route::resource('articles', \App\Http\Controllers\Admin\ArticleController::class)->names('admin.articles');

    // Quản lý Bình luận
    Route::get('comments', [\App\Http\Controllers\Admin\CommentController::class, 'index'])->name('admin.comments.index');
    Route::post('comments/{comment}/toggle-status', [\App\Http\Controllers\Admin\CommentController::class, 'toggleStatus'])->name('admin.comments.toggle-status');
    Route::delete('comments/{comment}', [\App\Http\Controllers\Admin\CommentController::class, 'destroy'])->name('admin.comments.destroy');
    // Báo cáo & Thống kê
    Route::get('reports', [\App\Http\Controllers\Admin\ReportController::class, 'index'])->name('admin.reports.index');
});

// User routes (Xem bài viết)
Route::group(['middleware' => ['auth']], function () {
    Route::get('articles', [\App\Http\Controllers\User\ArticleController::class, 'index'])->name('user.articles.index');
    Route::get('articles/{slug}', [\App\Http\Controllers\User\ArticleController::class, 'show'])->name('user.articles.show');
    Route::post('articles/{id}/comment', [\App\Http\Controllers\User\ArticleController::class, 'storeComment'])->name('user.articles.comment');

    // Dược liệu cho người dùng tra cứu
    Route::get('medicinal-herbs', [\App\Http\Controllers\User\MedicinalHerbController::class, 'index'])->name('user.medicinal-herbs.index');
    Route::get('medicinal-herbs/{id}', [\App\Http\Controllers\User\MedicinalHerbController::class, 'show'])->name('user.medicinal-herbs.show');
});