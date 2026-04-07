@extends('layouts.user')

@section('title', 'Trang chủ')

@section('styles')
    /* ===== USER DASHBOARD ===== */
    .hero-banner {
        background: linear-gradient(135deg, #e8f5e9 0%, #c8e6c9 50%, #e8f5e9 100%);
        border-radius: 20px;
        padding: 40px 36px;
        margin-bottom: 28px;
        position: relative;
        overflow: hidden;
        border: none;
    }

    .hero-banner::before {
        content: '';
        position: absolute;
        right: -40px;
        top: -40px;
        width: 200px;
        height: 200px;
        background: rgba(26, 86, 50, 0.06);
        border-radius: 50%;
    }

    .hero-banner::after {
        content: '';
        position: absolute;
        right: 40px;
        bottom: -60px;
        width: 160px;
        height: 160px;
        background: rgba(26, 86, 50, 0.04);
        border-radius: 50%;
    }

    .hero-inner {
        display: flex;
        align-items: center;
        gap: 24px;
        position: relative;
        z-index: 1;
    }

    .hero-icon {
        font-size: 72px;
        line-height: 1;
        flex-shrink: 0;
    }

    .hero-text h1 {
        font-size: 28px;
        font-weight: 700;
        color: #1a5632;
        margin-bottom: 8px;
    }

    .hero-text p {
        font-size: 17px;
        color: #3d6b4c;
        line-height: 1.7;
    }

    /* Profile card */
    .profile-section {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 24px;
        margin-bottom: 28px;
    }

    .profile-card {
        background: #ffffff;
        border-radius: 16px;
        padding: 32px;
        box-shadow: 0 2px 12px rgba(0, 0, 0, 0.04);
        border: 1px solid #e8e2d8;
    }

    .profile-card h2 {
        font-size: 20px;
        font-weight: 700;
        color: #1a5632;
        margin-bottom: 20px;
        padding-bottom: 12px;
        border-bottom: 2px solid #e8f5e9;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .profile-avatar-large {
        width: 72px;
        height: 72px;
        border-radius: 50%;
        background: linear-gradient(135deg, #2f7d4a, #3a8a52);
        color: white;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 30px;
        font-weight: 700;
        margin-bottom: 16px;
        box-shadow: 0 4px 12px rgba(47, 125, 74, 0.3);
    }

    .profile-name {
        font-size: 22px;
        font-weight: 700;
        color: #1a5632;
        margin-bottom: 4px;
    }

    .profile-email {
        font-size: 15px;
        color: #5a6b5e;
        margin-bottom: 16px;
    }

    .profile-detail {
        display: flex;
        justify-content: space-between;
        padding: 10px 0;
        border-bottom: 1px solid #f2ede5;
        font-size: 15px;
    }

    .profile-detail:last-child {
        border-bottom: none;
    }

    .profile-detail-label {
        color: #5a6b5e;
    }

    .profile-detail-value {
        font-weight: 600;
        color: #2d3a2e;
    }

    /* About card */
    .about-card {
        background: #ffffff;
        border-radius: 16px;
        padding: 32px;
        box-shadow: 0 2px 12px rgba(0, 0, 0, 0.04);
        border: 1px solid #e8e2d8;
    }

    .about-card h2 {
        font-size: 20px;
        font-weight: 700;
        color: #1a5632;
        margin-bottom: 16px;
        padding-bottom: 12px;
        border-bottom: 2px solid #e8f5e9;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .about-card p {
        font-size: 16px;
        color: #3d6b4c;
        line-height: 1.8;
        margin-bottom: 12px;
    }

    .about-highlights {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 12px;
        margin-top: 16px;
    }

    .about-highlight-item {
        display: flex;
        align-items: center;
        gap: 10px;
        padding: 12px 14px;
        background: #faf7f2;
        border-radius: 12px;
        font-size: 15px;
        color: #2d3a2e;
        font-weight: 500;
    }

    .about-highlight-icon {
        font-size: 22px;
        flex-shrink: 0;
    }

    /* Feature cards */
    .features-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 20px;
    }

    .feature-card {
        background: #ffffff;
        border-radius: 16px;
        padding: 32px 24px;
        box-shadow: 0 2px 12px rgba(0, 0, 0, 0.04);
        border: 1px solid #e8e2d8;
        text-align: center;
        transition: transform 0.2s, box-shadow 0.2s;
    }

    .feature-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 8px 28px rgba(0, 0, 0, 0.1);
    }

    .feature-card-icon {
        font-size: 48px;
        margin-bottom: 14px;
        line-height: 1;
    }

    .feature-card h3 {
        font-size: 18px;
        font-weight: 700;
        color: #1a5632;
        margin-bottom: 8px;
    }

    .feature-card p {
        font-size: 15px;
        color: #5a6b5e;
        line-height: 1.6;
    }

    @media (max-width: 768px) {
        .profile-section {
            grid-template-columns: 1fr;
        }
        .features-grid {
            grid-template-columns: 1fr;
        }
        .about-highlights {
            grid-template-columns: 1fr;
        }
        .hero-inner {
            flex-direction: column;
            text-align: center;
        }
    }
@endsection

@section('content')
    {{-- Banner chào mừng --}}
    <div class="hero-banner">
        <div class="hero-inner">
            <div class="hero-icon">🌿</div>
            <div class="hero-text">
                <h1>Chào mừng bạn, {{ $user->name }}!</h1>
                <p>
                    Chào mừng đến với hệ thống nhà thuốc Y học cổ truyền <strong>AmaTrung</strong>.
                    Tại đây bạn có thể theo dõi lịch sử khám bệnh, đọc bài viết sức khỏe
                    và tìm hiểu về các loại dược liệu thiên nhiên.
                </p>
            </div>
        </div>
    </div>

    {{-- Thông tin cá nhân + Giới thiệu --}}
    <div class="profile-section">
        {{-- Card thông tin tài khoản --}}
        <div class="profile-card">
            <h2>👤 Thông tin tài khoản</h2>
            <div style="display: flex; align-items: center; gap: 16px; margin-bottom: 20px;">
                <div class="profile-avatar-large">
                    {{ strtoupper(substr($user->name, 0, 1)) }}
                </div>
                <div>
                    <div class="profile-name">{{ $user->name }}</div>
                    <div class="profile-email">{{ $user->email }}</div>
                </div>
            </div>
            <div class="profile-detail">
                <span class="profile-detail-label">📞 Số điện thoại</span>
                <span class="profile-detail-value">{{ $user->phone ?? '—' }}</span>
            </div>
            <div class="profile-detail">
                <span class="profile-detail-label">🎂 Ngày sinh</span>
                <span class="profile-detail-value">
                    {{ $user->date_of_birth ? $user->date_of_birth->format('d/m/Y') : '—' }}
                </span>
            </div>
            <div class="profile-detail">
                <span class="profile-detail-label">🧑 Giới tính</span>
                <span class="profile-detail-value">{{ $gender }}</span>
            </div>
            @if($age)
            <div class="profile-detail">
                <span class="profile-detail-label">📅 Tuổi</span>
                <span class="profile-detail-value">{{ $age }} tuổi</span>
            </div>
            @endif
            <div class="profile-detail">
                <span class="profile-detail-label">📆 Tham gia từ</span>
                <span class="profile-detail-value">{{ $user->created_at->format('d/m/Y') }}</span>
            </div>
        </div>

        {{-- Card giới thiệu AmaTrung --}}
        <div class="about-card">
            <h2>🏥 Về AmaTrung</h2>
            <p>
                <strong>AmaTrung</strong> là nhà thuốc Y học cổ truyền uy tín, chuyên tư vấn, khám
                và điều trị bằng các phương pháp y học cổ truyền kết hợp hiện đại.
            </p>
            <p>
                Chúng tôi cam kết mang đến dịch vụ chăm sóc sức khỏe toàn diện, an toàn và hiệu quả
                cho mọi gia đình, đặc biệt phù hợp với người lớn tuổi.
            </p>
            <div class="about-highlights">
                <div class="about-highlight-item">
                    <span class="about-highlight-icon">🌿</span>
                    Dược liệu tự nhiên
                </div>
                <div class="about-highlight-item">
                    <span class="about-highlight-icon">👨‍⚕️</span>
                    Bác sĩ giàu kinh nghiệm
                </div>
                <div class="about-highlight-item">
                    <span class="about-highlight-icon">💊</span>
                    Thuốc Đông y chất lượng
                </div>
                <div class="about-highlight-item">
                    <span class="about-highlight-icon">❤️</span>
                    Tận tâm với bệnh nhân
                </div>
            </div>
        </div>
    </div>

    {{-- Các mục chức năng --}}
    <div class="features-grid">
        <div class="feature-card">
            <div class="feature-card-icon">📝</div>
            <h3>Bài viết sức khỏe</h3>
            <p>Đọc các bài viết hữu ích về y học cổ truyền, mẹo chăm sóc sức khỏe hàng ngày.</p>
        </div>
        <div class="feature-card">
            <div class="feature-card-icon">🌿</div>
            <h3>Tra cứu dược liệu</h3>
            <p>Tìm hiểu công dụng, cách dùng các vị thuốc trong y học cổ truyền Việt Nam.</p>
        </div>
        <div class="feature-card">
            <div class="feature-card-icon">📋</div>
            <h3>Lịch sử khám bệnh</h3>
            <p>Xem lại hồ sơ bệnh án, đơn thuốc và lịch sử điều trị đã được kê cho bạn.</p>
        </div>
    </div>
@endsection