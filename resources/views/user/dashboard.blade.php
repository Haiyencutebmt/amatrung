@extends('layouts.user')

@section('title', 'Trang chủ')

@section('styles')
    /* ===== USER DASHBOARD ===== */
    .hero-banner {
        background: linear-gradient(135deg, var(--primary-soft) 0%, #dcfce7 100%);
        border-radius: var(--radius-lg);
        padding: 48px;
        margin-bottom: 32px;
        position: relative;
        overflow: hidden;
        border: 1px solid var(--border);
        box-shadow: var(--shadow-md);
    }

    .hero-banner::before {
        content: '';
        position: absolute;
        right: -40px;
        top: -40px;
        width: 240px;
        height: 240px;
        background: rgba(37, 99, 235, 0.05);
        border-radius: 50%;
    }

    .hero-banner::after {
        content: '';
        position: absolute;
        right: 80px;
        bottom: -60px;
        width: 180px;
        height: 180px;
        background: rgba(16, 185, 129, 0.05);
        border-radius: 50%;
    }

    .hero-inner {
        display: flex;
        align-items: center;
        gap: 32px;
        position: relative;
        z-index: 1;
    }

    .hero-icon {
        font-size: 80px;
        line-height: 1;
        flex-shrink: 0;
        filter: drop-shadow(0 4px 12px rgba(0,0,0,0.1));
    }

    .hero-text h1 {
        font-size: 32px;
        font-weight: 800;
        color: var(--text-main);
        margin-bottom: 12px;
        letter-spacing: -1px;
    }

    .hero-text p {
        font-size: 18px;
        color: var(--text-muted);
        line-height: 1.8;
        max-width: 600px;
    }

    /* Profile card */
    .profile-section {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 32px;
        margin-bottom: 32px;
    }

    .profile-card {
        background: var(--bg-card);
        border-radius: var(--radius-lg);
        padding: 40px;
        box-shadow: var(--shadow-md);
        border: 1px solid var(--border);
    }

    .profile-card h2 {
        font-size: 22px;
        font-weight: 800;
        color: var(--primary);
        margin-bottom: 24px;
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .profile-avatar-large {
        width: 80px;
        height: 80px;
        border-radius: 20px;
        background: linear-gradient(135deg, var(--primary), var(--primary-hover));
        color: white;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 32px;
        font-weight: 800;
        margin-bottom: 20px;
        box-shadow: 0 8px 16px rgba(37, 99, 235, 0.2);
    }

    .profile-name {
        font-size: 24px;
        font-weight: 800;
        color: var(--text-main);
        margin-bottom: 6px;
    }

    .profile-email {
        font-size: 16px;
        color: var(--text-muted);
        margin-bottom: 24px;
        font-weight: 500;
    }

    .profile-detail {
        display: flex;
        justify-content: space-between;
        padding: 14px 0;
        border-bottom: 1px solid var(--border);
        font-size: 16px;
    }

    .profile-detail:last-child {
        border-bottom: none;
    }

    .profile-detail-label {
        color: var(--text-muted);
        font-weight: 500;
    }

    .profile-detail-value {
        font-weight: 700;
        color: var(--text-main);
    }

    /* About card */
    .about-card {
        background: var(--bg-card);
        border-radius: var(--radius-lg);
        padding: 40px;
        box-shadow: var(--shadow-md);
        border: 1px solid var(--border);
    }

    .about-card h2 {
        font-size: 22px;
        font-weight: 800;
        color: var(--accent);
        margin-bottom: 20px;
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .about-card p {
        font-size: 17px;
        color: var(--text-main);
        line-height: 1.8;
        margin-bottom: 16px;
    }

    .about-highlights {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 16px;
        margin-top: 24px;
    }

    .about-highlight-item {
        display: flex;
        align-items: center;
        gap: 12px;
        padding: 16px;
        background: var(--bg-page);
        border-radius: 16px;
        font-size: 15px;
        color: var(--text-main);
        font-weight: 700;
        border: 1px solid var(--border);
        transition: var(--transition);
    }

    .about-highlight-item:hover {
        background: #fff;
        border-color: var(--accent);
        transform: translateY(-2px);
    }

    .about-highlight-icon {
        font-size: 24px;
        flex-shrink: 0;
    }

    /* Feature cards */
    .features-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 28px;
    }

    .feature-card {
        background: var(--bg-card);
        border-radius: var(--radius-lg);
        padding: 40px 24px;
        box-shadow: var(--shadow-md);
        border: 1px solid var(--border);
        text-align: center;
        transition: var(--transition);
        text-decoration: none;
    }

    .feature-card:hover {
        transform: translateY(-8px);
        box-shadow: var(--shadow-lg);
        border-color: var(--primary);
    }

    .feature-card-icon {
        font-size: 56px;
        margin-bottom: 20px;
        line-height: 1;
        filter: drop-shadow(0 4px 8px rgba(0,0,0,0.05));
    }

    .feature-card h3 {
        font-size: 20px;
        font-weight: 800;
        color: var(--text-main);
        margin-bottom: 12px;
    }

    .feature-card p {
        font-size: 16px;
        color: var(--text-muted);
        line-height: 1.7;
    }

    @media (max-width: 1024px) {
        .profile-section { grid-template-columns: 1fr; }
        .features-grid { grid-template-columns: 1fr; gap: 20px; }
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