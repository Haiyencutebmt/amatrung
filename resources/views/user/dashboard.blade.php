@extends('layouts.user')

@section('title', 'Trang chủ')

@section('content')
    {{-- Banner chào mừng --}}
    <div class="content-card" style="background: linear-gradient(135deg, #e8f5e9, #f0f7f1); border: none;">
        <div style="display: flex; align-items: center; gap: 20px; flex-wrap: wrap;">
            <div style="font-size: 56px; line-height: 1;">🌿</div>
            <div>
                <h1 style="font-size: 28px; font-weight: 700; color: #1a5632; margin-bottom: 8px;">
                    Chào mừng bạn, {{ auth()->user()->name }}!
                </h1>
                <p style="font-size: 17px; color: #5a6b5e; line-height: 1.7;">
                    Chào mừng đến với hệ thống nhà thuốc Y học cổ truyền <strong>AmaTrung</strong>.
                    Tại đây bạn có thể theo dõi lịch sử khám bệnh, đọc bài viết sức khỏe
                    và tìm hiểu về các loại dược liệu.
                </p>
            </div>
        </div>
    </div>

    {{-- Các mục nhanh --}}
    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 20px; margin-top: 8px;">
        <div class="content-card" style="text-align: center; padding: 36px 24px;">
            <div style="font-size: 48px; margin-bottom: 14px;">📝</div>
            <h2 style="font-size: 20px; border: none; padding: 0; margin-bottom: 8px;">Bài viết sức khỏe</h2>
            <p style="color: #5a6b5e; font-size: 15px;">
                Đọc các bài viết hữu ích về y học cổ truyền, mẹo chăm sóc sức khỏe.
            </p>
        </div>
        <div class="content-card" style="text-align: center; padding: 36px 24px;">
            <div style="font-size: 48px; margin-bottom: 14px;">🌿</div>
            <h2 style="font-size: 20px; border: none; padding: 0; margin-bottom: 8px;">Tra cứu dược liệu</h2>
            <p style="color: #5a6b5e; font-size: 15px;">
                Tìm hiểu công dụng, cách dùng các vị thuốc y học cổ truyền.
            </p>
        </div>
        <div class="content-card" style="text-align: center; padding: 36px 24px;">
            <div style="font-size: 48px; margin-bottom: 14px;">📋</div>
            <h2 style="font-size: 20px; border: none; padding: 0; margin-bottom: 8px;">Lịch sử khám</h2>
            <p style="color: #5a6b5e; font-size: 15px;">
                Xem lại hồ sơ bệnh án và đơn thuốc đã được kê cho bạn.
            </p>
        </div>
    </div>
@endsection