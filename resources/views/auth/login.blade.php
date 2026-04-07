<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng nhập - AmaTrung</title>
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
        .container {
            width: 100%;
            max-width: 950px;
            display: grid;
            grid-template-columns: 1fr 1fr;
            background: white;
            border-radius: 24px;
            overflow: hidden;
            box-shadow: 0 20px 50px rgba(0,0,0,0.08);
        }
        .left {
            background: linear-gradient(160deg, #3a8a52, #89c49a);
            padding: 48px;
            color: white;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }
        .left h1 {
            font-size: 40px;
            margin-bottom: 14px;
        }
        .left p {
            font-size: 18px;
            line-height: 1.7;
        }
        .right {
            padding: 42px 36px;
        }
        .title {
            font-size: 30px;
            font-weight: bold;
            margin-bottom: 8px;
        }
        .subtitle {
            color: #5a6b5e;
            margin-bottom: 24px;
        }
        .form-group { margin-bottom: 16px; }
        label {
            display: block;
            margin-bottom: 8px;
            font-weight: 600;
        }
        input {
            width: 100%;
            padding: 14px 16px;
            border: 1px solid #d9e4d8;
            border-radius: 14px;
            font-size: 16px;
            outline: none;
        }
        input:focus {
            border-color: #4a9b61;
            box-shadow: 0 0 0 3px rgba(74,155,97,0.12);
        }
        .btn {
            width: 100%;
            padding: 15px;
            background: #2f7d4a;
            color: white;
            border: none;
            border-radius: 14px;
            font-size: 17px;
            font-weight: bold;
            cursor: pointer;
        }
        .btn:hover { background: #27673d; }
        .error-list, .success {
            padding: 12px 14px;
            border-radius: 12px;
            margin-bottom: 16px;
        }
        .error-list { background: #fff2f2; color: #b42318; }
        .success { background: #effcf3; color: #1f7a3d; }
        .links {
            margin-top: 18px;
            text-align: center;
            line-height: 1.9;
        }
        .links a {
            color: #2f7d4a;
            font-weight: bold;
            text-decoration: none;
        }
        @media (max-width: 900px) {
            .container { grid-template-columns: 1fr; }
            .left { display: none; }
        }
    </style>
</head>
<body>
<div class="container">
    <div class="left">
        <h1>AmaTrung</h1>
        <p>Đăng nhập để truy cập không gian người dùng, xem bài viết sức khỏe và quản lý thông tin cá nhân một cách thuận tiện.</p>
    </div>

    <div class="right">
        <div class="title">Đăng nhập</div>
        <div class="subtitle">Dành cho người dùng của hệ thống AmaTrung</div>

        @if (session('success'))
            <div class="success">{{ session('success') }}</div>
        @endif

        @if ($errors->any())
            <div class="error-list">
                <ul style="margin:0; padding-left:18px;">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('login.submit') }}">
            @csrf

            <div class="form-group">
                <label>Email hoặc số điện thoại</label>
                <input type="text" name="login" value="{{ old('login') }}" placeholder="Nhập email hoặc số điện thoại">
            </div>

            <div class="form-group">
                <label>Mật khẩu</label>
                <input type="password" name="password" placeholder="Nhập mật khẩu">
            </div>

            <button type="submit" class="btn">Đăng nhập</button>
        </form>

        <div class="links">
            Chưa có tài khoản? <a href="{{ route('register') }}">Đăng ký</a><br>
            Quản trị / Nhân viên? <a href="{{ route('admin.login') }}">Đăng nhập quản trị</a>
        </div>
    </div>
</div>
</body>
</html>