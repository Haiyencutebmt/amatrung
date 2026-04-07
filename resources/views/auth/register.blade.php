<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng ký - AmaTrung</title>
    <style>
        * { box-sizing: border-box; font-family: Arial, sans-serif; }
        body {
            margin: 0;
            background: linear-gradient(135deg, #f7fff8, #eef8ee);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #234b2f;
        }
        .wrapper {
            width: 100%;
            max-width: 1100px;
            display: grid;
            grid-template-columns: 1fr 1fr;
            background: #fff;
            border-radius: 24px;
            overflow: hidden;
            box-shadow: 0 20px 50px rgba(0,0,0,0.08);
        }
        .left {
            background: linear-gradient(160deg, #2f7d4a, #5ca36f);
            color: white;
            padding: 48px;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }
        .left h1 {
            font-size: 38px;
            margin-bottom: 16px;
        }
        .left p {
            font-size: 18px;
            line-height: 1.7;
        }
        .right {
            padding: 36px;
        }
        .title {
            font-size: 30px;
            font-weight: bold;
            margin-bottom: 8px;
        }
        .subtitle {
            margin-bottom: 24px;
            color: #5a6b5e;
        }
        .grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 16px;
        }
        .form-group {
            margin-bottom: 16px;
        }
        label {
            display: block;
            font-size: 15px;
            margin-bottom: 8px;
            font-weight: 600;
        }
        input, select {
            width: 100%;
            padding: 14px 16px;
            border: 1px solid #d9e4d8;
            border-radius: 14px;
            font-size: 16px;
            outline: none;
        }
        input:focus, select:focus {
            border-color: #4a9b61;
            box-shadow: 0 0 0 3px rgba(74,155,97,0.12);
        }
        .full {
            grid-column: 1 / -1;
        }
        .btn {
            width: 100%;
            padding: 15px;
            border: none;
            border-radius: 14px;
            background: #2f7d4a;
            color: white;
            font-size: 17px;
            font-weight: bold;
            cursor: pointer;
        }
        .btn:hover { background: #27673d; }
        .link {
            text-align: center;
            margin-top: 18px;
        }
        .link a {
            color: #2f7d4a;
            font-weight: bold;
            text-decoration: none;
        }
        .error-list {
            background: #fff2f2;
            color: #b42318;
            padding: 12px 14px;
            border-radius: 12px;
            margin-bottom: 18px;
        }
        @media (max-width: 900px) {
            .wrapper { grid-template-columns: 1fr; }
            .left { display: none; }
            .grid { grid-template-columns: 1fr; }
        }
    </style>
</head>
<body>
<div class="wrapper">
    <div class="left">
        <h1>AmaTrung</h1>
        <p>Đăng ký tài khoản để theo dõi thông tin cá nhân, đọc bài viết sức khỏe và tương tác cùng nhà thuốc y học cổ truyền AmaTrung.</p>
    </div>

    <div class="right">
        <div class="title">Tạo tài khoản</div>
        <div class="subtitle">Điền thông tin cơ bản để bắt đầu sử dụng hệ thống</div>

        @if ($errors->any())
            <div class="error-list">
                <ul style="margin:0; padding-left:18px;">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('register.submit') }}">
            @csrf

            <div class="grid">
                <div class="form-group">
                    <label>Họ và tên</label>
                    <input type="text" name="name" value="{{ old('name') }}" placeholder="Nhập họ và tên">
                </div>

                <div class="form-group">
                    <label>Số điện thoại</label>
                    <input type="text" name="phone" value="{{ old('phone') }}" placeholder="Nhập số điện thoại">
                </div>

                <div class="form-group full">
                    <label>Email</label>
                    <input type="email" name="email" value="{{ old('email') }}" placeholder="Nhập email">
                </div>

                <div class="form-group">
                    <label>Giới tính</label>
                    <select name="gender">
                        <option value="">-- Chọn giới tính --</option>
                        <option value="male" {{ old('gender') == 'male' ? 'selected' : '' }}>Nam</option>
                        <option value="female" {{ old('gender') == 'female' ? 'selected' : '' }}>Nữ</option>
                        <option value="other" {{ old('gender') == 'other' ? 'selected' : '' }}>Khác</option>
                    </select>
                </div>

                <div class="form-group">
                    <label>Ngày sinh</label>
                    <input type="date" name="date_of_birth" value="{{ old('date_of_birth') }}">
                </div>

                <div class="form-group">
                    <label>Mật khẩu</label>
                    <input type="password" name="password" placeholder="Nhập mật khẩu">
                </div>

                <div class="form-group">
                    <label>Xác nhận mật khẩu</label>
                    <input type="password" name="password_confirmation" placeholder="Nhập lại mật khẩu">
                </div>

                <div class="form-group full">
                    <button type="submit" class="btn">Đăng ký tài khoản</button>
                </div>
            </div>
        </form>

        <div class="link">
            Đã có tài khoản? <a href="{{ route('login') }}">Đăng nhập ngay</a>
        </div>
    </div>
</div>
</body>
</html>