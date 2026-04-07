@extends('layouts.admin')

@section('title', 'Dashboard')
@section('page-title', 'Dashboard')

@section('styles')
    /* ===== DASHBOARD SPECIFIC ===== */
    .dashboard-date {
        font-size: 15px;
        color: #5a6b5e;
        margin-bottom: 24px;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .stats-grid-6 {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 18px;
        margin-bottom: 28px;
    }

    .stat-card-v2 {
        background: #ffffff;
        border-radius: 16px;
        padding: 22px 24px;
        box-shadow: 0 2px 12px rgba(0, 0, 0, 0.04);
        border: 1px solid #e8e2d8;
        transition: transform 0.2s, box-shadow 0.2s;
        display: flex;
        align-items: center;
        gap: 18px;
    }

    .stat-card-v2:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 24px rgba(0, 0, 0, 0.1);
    }

    .stat-card-icon {
        width: 60px;
        height: 60px;
        border-radius: 14px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 28px;
        flex-shrink: 0;
    }

    .stat-card-icon.blue   { background: #e8f0fe; }
    .stat-card-icon.green  { background: #e8f5e9; }
    .stat-card-icon.orange { background: #fff3e0; }
    .stat-card-icon.purple { background: #f3e8ff; }
    .stat-card-icon.teal   { background: #e0f7fa; }
    .stat-card-icon.pink   { background: #fce4ec; }

    .stat-card-info {
        flex: 1;
        min-width: 0;
    }

    .stat-card-value {
        font-size: 28px;
        font-weight: 700;
        color: #1a5632;
        line-height: 1.2;
    }

    .stat-card-label {
        font-size: 14px;
        color: #5a6b5e;
        margin-top: 2px;
    }

    /* Two column grid */
    .two-col-grid {
        display: grid;
        grid-template-columns: 1.4fr 1fr;
        gap: 24px;
        margin-bottom: 24px;
    }

    /* Welcome hero */
    .welcome-hero {
        background: linear-gradient(135deg, #1a5632 0%, #2f7d4a 100%);
        color: #ffffff;
        border-radius: 16px;
        padding: 32px;
        position: relative;
        overflow: hidden;
    }

    .welcome-hero::before {
        content: '🌿';
        position: absolute;
        right: -10px;
        bottom: -16px;
        font-size: 120px;
        opacity: 0.12;
        transform: rotate(-15deg);
    }

    .welcome-hero h2 {
        font-size: 24px;
        font-weight: 700;
        margin-bottom: 8px;
        border: none;
        padding: 0;
        color: #ffffff;
    }

    .welcome-hero p {
        font-size: 16px;
        color: rgba(255, 255, 255, 0.85);
        line-height: 1.7;
    }

    .welcome-role-badge {
        display: inline-block;
        background: rgba(255, 255, 255, 0.2);
        color: #ffffff;
        padding: 5px 16px;
        border-radius: 8px;
        font-weight: 600;
        font-size: 14px;
        margin-top: 12px;
        backdrop-filter: blur(4px);
    }

    /* Quick info card */
    .quick-info {
        background: #ffffff;
        border-radius: 16px;
        padding: 28px;
        box-shadow: 0 2px 12px rgba(0, 0, 0, 0.04);
        border: 1px solid #e8e2d8;
    }

    .quick-info h3 {
        font-size: 18px;
        font-weight: 700;
        color: #1a5632;
        margin-bottom: 16px;
        padding-bottom: 12px;
        border-bottom: 2px solid #e8f5e9;
    }

    .info-row {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 10px 0;
        border-bottom: 1px solid #f2ede5;
        font-size: 15px;
    }

    .info-row:last-child {
        border-bottom: none;
    }

    .info-row-label {
        color: #5a6b5e;
    }

    .info-row-value {
        font-weight: 600;
        color: #2d3a2e;
    }

    /* Recent users table */
    .recent-table {
        width: 100%;
        border-collapse: collapse;
    }

    .recent-table thead th {
        text-align: left;
        font-size: 13px;
        font-weight: 600;
        color: #5a6b5e;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        padding: 12px 16px;
        background: #faf7f2;
        border-bottom: 2px solid #e8e2d8;
    }

    .recent-table tbody td {
        padding: 14px 16px;
        font-size: 15px;
        border-bottom: 1px solid #f2ede5;
        color: #2d3a2e;
    }

    .recent-table tbody tr:hover {
        background: #faf7f2;
    }

    .recent-table tbody tr:last-child td {
        border-bottom: none;
    }

    .user-badge {
        display: inline-flex;
        align-items: center;
        gap: 8px;
    }

    .user-badge-avatar {
        width: 32px;
        height: 32px;
        border-radius: 50%;
        background: linear-gradient(135deg, #2f7d4a, #3a8a52);
        color: white;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 13px;
        font-weight: 700;
        flex-shrink: 0;
    }

    .empty-state {
        text-align: center;
        padding: 32px;
        color: #8a9b8e;
        font-size: 15px;
    }

    @media (max-width: 1024px) {
        .stats-grid-6 {
            grid-template-columns: repeat(2, 1fr);
        }
        .two-col-grid {
            grid-template-columns: 1fr;
        }
    }

    @media (max-width: 600px) {
        .stats-grid-6 {
            grid-template-columns: 1fr;
        }
    }
@endsection

@section('content')
    {{-- Ngày hiện tại --}}
    <div class="dashboard-date">
        📅 {{ \Carbon\Carbon::now()->locale('vi')->isoFormat('dddd, D MMMM YYYY') }}
    </div>

    {{-- 6 thẻ thống kê --}}
    <div class="stats-grid-6">
        <div class="stat-card-v2">
            <div class="stat-card-icon blue">👤</div>
            <div class="stat-card-info">
                <div class="stat-card-value">{{ $stats['patients'] }}</div>
                <div class="stat-card-label">Bệnh nhân</div>
            </div>
        </div>
        <div class="stat-card-v2">
            <div class="stat-card-icon green">📋</div>
            <div class="stat-card-info">
                <div class="stat-card-value">{{ $stats['records'] }}</div>
                <div class="stat-card-label">Hồ sơ bệnh án</div>
            </div>
        </div>
        <div class="stat-card-v2">
            <div class="stat-card-icon orange">💊</div>
            <div class="stat-card-info">
                <div class="stat-card-value">{{ $stats['prescriptions'] }}</div>
                <div class="stat-card-label">Đơn thuốc</div>
            </div>
        </div>
        <div class="stat-card-v2">
            <div class="stat-card-icon teal">🌿</div>
            <div class="stat-card-info">
                <div class="stat-card-value">{{ $stats['herbs'] }}</div>
                <div class="stat-card-label">Dược liệu</div>
            </div>
        </div>
        <div class="stat-card-v2">
            <div class="stat-card-icon purple">📝</div>
            <div class="stat-card-info">
                <div class="stat-card-value">{{ $stats['posts'] }}</div>
                <div class="stat-card-label">Bài viết</div>
            </div>
        </div>
        <div class="stat-card-v2">
            <div class="stat-card-icon pink">💬</div>
            <div class="stat-card-info">
                <div class="stat-card-value">{{ $stats['comments'] }}</div>
                <div class="stat-card-label">Bình luận</div>
            </div>
        </div>
    </div>

    {{-- Hero chào mừng + Hệ thống tóm tắt --}}
    <div class="two-col-grid">
        <div class="welcome-hero">
            <h2>Chào mừng trở lại! 👋</h2>
            <p>
                Xin chào <strong>{{ auth()->user()->name }}</strong>, bạn đang quản trị hệ thống
                <strong>AmaTrung — Nhà thuốc Y học cổ truyền</strong>.
                Sử dụng menu bên trái để quản lý bệnh nhân, hồ sơ, đơn thuốc và dược liệu.
            </p>
            @foreach(auth()->user()->roles as $role)
                <span class="welcome-role-badge">{{ $role->display_name }}</span>
            @endforeach
        </div>

        <div class="quick-info">
            <h3>📊 Tổng quan hệ thống</h3>
            <div class="info-row">
                <span class="info-row-label">Tổng tài khoản</span>
                <span class="info-row-value">{{ $stats['users'] }}</span>
            </div>
            <div class="info-row">
                <span class="info-row-label">Nhân viên</span>
                <span class="info-row-value">{{ $stats['staff'] }}</span>
            </div>
            <div class="info-row">
                <span class="info-row-label">Dược liệu</span>
                <span class="info-row-value">{{ $stats['herbs'] }}</span>
            </div>
            <div class="info-row">
                <span class="info-row-label">Bài viết</span>
                <span class="info-row-value">{{ $stats['posts'] }}</span>
            </div>
            <div class="info-row">
                <span class="info-row-label">Bình luận</span>
                <span class="info-row-value">{{ $stats['comments'] }}</span>
            </div>
        </div>
    </div>

    {{-- Tài khoản mới đăng ký --}}
    <div class="content-card">
        <h2>Tài khoản mới đăng ký</h2>
        @if(count($recentUsers) > 0)
            <div style="overflow-x: auto;">
                <table class="recent-table">
                    <thead>
                        <tr>
                            <th>Họ tên</th>
                            <th>Email</th>
                            <th>SĐT</th>
                            <th>Ngày tham gia</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($recentUsers as $u)
                            <tr>
                                <td>
                                    <span class="user-badge">
                                        <span class="user-badge-avatar">
                                            {{ strtoupper(substr($u->name, 0, 1)) }}
                                        </span>
                                        {{ $u->name }}
                                    </span>
                                </td>
                                <td>{{ $u->email }}</td>
                                <td>{{ $u->phone ?? '—' }}</td>
                                <td>{{ \Carbon\Carbon::parse($u->created_at)->format('d/m/Y H:i') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <div class="empty-state">
                📭 Chưa có tài khoản nào được đăng ký.
            </div>
        @endif
    </div>
@endsection