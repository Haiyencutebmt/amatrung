<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng nhập quản trị - AmaTrung</title>
    <style>
        * { box-sizing: border-box; font-family: Arial, sans-serif; }
        body {
            margin: 0;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(135deg, #f4f8f4, #eaf1ea);
        }
        .card {
            width: 100%;
            max-width: 460px;
            background: white;
            border-radius: 22px;
            box-shadow: 0 20px 50px rgba(0,0,0,0.08);
            padding: 34px;
        }
        .badge {
            display: inline-block;
            background: #edf7ef;
            color: #2f7d4a;
            padding: 8px 14px;
            border-radius: 999px;
            font-size: 14px;
            font-weight: 700;
            margin-bottom: 14px;
        }
        h1 {
            margin: 0 0 8px;
            font-size: 30px;
            color: #21382a;
        }
        p {
            margin: 0 0 22px;
            color: #607163;
        }
        .form-group { margin-bottom: 16px; }
        label {
            display: block;
            margin-bottom: 8px;
            font-weight: 600;
            color: #2b4333;
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
            border: none;
            border-radius: 14px;
            background: #234b2f;
            color: white;
            font-size: 17px;
            font-weight: bold;
            cursor: pointer;
        }
        .btn:hover { background: #1b3924; }
        .error-list {
            background: #fff2f2;
            color: #b42318;
            padding: 12px 14px;
            border-radius: 12px;
            margin-bottom: 18px;
        }
        .back {
            text-align: center;
            margin-top: 18px;
        }
        .back a {
            color: #2f7d4a;
            text-decoration: none;
            font-weight: 700;
        }
    </style>
</head>
<body>
<div class="card">
    <div class="badge">Khu vực quản trị</div>
    <h1>Đăng nhập Admin / Staff</h1>
    <p>Chỉ dành cho quản trị viên và nhân viên được cấp quyền.</p>

    @if ($errors->any())
        <div class="error-list">
            <ul style="margin:0; padding-left:18px;">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('admin.login.submit') }}">
        @csrf

        <div class="form-group">
            <label>Email hoặc số điện thoại</label>
            <input type="text" name="login" value="{{ old('login') }}" placeholder="Nhập email hoặc số điện thoại">
        </div>

        <div class="form-group">
            <label>Mật khẩu</label>
            <input type="password" name="password" placeholder="Nhập mật khẩu">
        </div>

        <button type="submit" class="btn">Đăng nhập quản trị</button>
    </form>

    <div class="back">
        <a href="{{ route('login') }}">Quay lại đăng nhập người dùng</a>
    </div>
</div>
</body>
</html>