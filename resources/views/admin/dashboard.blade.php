@extends('layouts.admin')

@section('title', 'Dashboard')
@section('page-title', 'Dashboard')

@section('content')
    {{-- Thẻ thống kê tổng quan --}}
    <div class="stats-grid">
        <div class="stat-card">
            <div class="stat-icon">👤</div>
            <div class="stat-value">0</div>
            <div class="stat-label">Bệnh nhân</div>
        </div>
        <div class="stat-card">
            <div class="stat-icon">📋</div>
            <div class="stat-value">0</div>
            <div class="stat-label">Hồ sơ bệnh án</div>
        </div>
        <div class="stat-card">
            <div class="stat-icon">💊</div>
            <div class="stat-value">0</div>
            <div class="stat-label">Đơn thuốc</div>
        </div>
        <div class="stat-card">
            <div class="stat-icon">🌿</div>
            <div class="stat-value">0</div>
            <div class="stat-label">Dược liệu</div>
        </div>
    </div>

    {{-- Thông tin chào mừng --}}
    <div class="content-card">
        <h2>Chào mừng trở lại! 👋</h2>
        <p style="font-size: 16px; color: #5a6b5e; line-height: 1.8;">
            Xin chào <strong>{{ auth()->user()->name }}</strong>, bạn đang truy cập trang quản trị của hệ thống
            <strong>AmaTrung — Nhà thuốc Y học cổ truyền</strong>.
        </p>
        <p style="font-size: 16px; color: #5a6b5e; margin-top: 12px;">
            Vai trò của bạn:
            @foreach(auth()->user()->roles as $role)
                <span style="display: inline-block; background: #e8f5e9; color: #1a5632; padding: 4px 14px; border-radius: 8px; font-weight: 600; font-size: 14px; margin-left: 4px;">
                    {{ $role->display_name }}
                </span>
            @endforeach
        </p>
    </div>

    {{-- Placeholder hoạt động gần đây --}}
    <div class="content-card">
        <h2>Hoạt động gần đây</h2>
        <p style="color: #8a9b8e; font-size: 15px; text-align: center; padding: 32px 0;">
            📭 Chưa có hoạt động nào. Dữ liệu sẽ hiển thị khi hệ thống bắt đầu hoạt động.
        </p>
    </div>
@endsection