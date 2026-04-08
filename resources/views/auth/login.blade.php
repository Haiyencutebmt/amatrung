<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng nhập - AmaTrung</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Be+Vietnam+Pro:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary: #2563eb;
            --primary-hover: #1d4ed8;
            --accent: #10b981;
            --bg-page: #f8fafc;
            --text-main: #1e293b;
            --text-muted: #64748b;
            --border: #e2e8f0;
            --radius: 16px;
            --shadow: 0 20px 50px rgba(0, 0, 0, 0.08);
        }

        * { box-sizing: border-box; font-family: 'Be Vietnam Pro', sans-serif; }
        
        body {
            margin: 0;
            background: var(--bg-page);
            background-image: radial-gradient(circle at 10% 20%, rgba(37, 99, 235, 0.05) 0%, transparent 20%),
                              radial-gradient(circle at 90% 80%, rgba(16, 185, 129, 0.05) 0%, transparent 20%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--text-main);
            padding: 20px;
        }

        .container {
            width: 100%;
            max-width: 900px;
            display: grid;
            grid-template-columns: 1fr 1.2fr;
            background: white;
            border-radius: 24px;
            overflow: hidden;
            box-shadow: var(--shadow);
            border: 1px solid var(--border);
        }

        .left {
            background: linear-gradient(135deg, #1e3a8a 0%, #2563eb 100%);
            padding: 50px;
            color: white;
            display: flex;
            flex-direction: column;
            justify-content: center;
            position: relative;
            overflow: hidden;
        }

        .left::before {
            content: "🌿";
            position: absolute;
            top: -20px;
            right: -20px;
            font-size: 120px;
            opacity: 0.1;
            transform: rotate(15deg);
        }

        .left h1 {
            font-size: 44px;
            margin-bottom: 20px;
            font-weight: 700;
            letter-spacing: -1px;
        }

        .left p {
            font-size: 18px;
            line-height: 1.8;
            opacity: 0.9;
        }

        .right {
            padding: 50px;
            background: #fff;
        }

        .title {
            font-size: 32px;
            font-weight: 700;
            margin-bottom: 10px;
            color: #1e293b;
        }

        .subtitle {
            color: var(--text-muted);
            margin-bottom: 32px;
            font-size: 16px;
        }

        .form-group { margin-bottom: 20px; }

        label {
            display: block;
            margin-bottom: 8px;
            font-weight: 600;
            font-size: 14px;
            color: #475569;
        }

        input {
            width: 100%;
            padding: 14px 18px;
            border: 1px solid var(--border);
            border-radius: var(--radius);
            font-size: 16px;
            outline: none;
            transition: all 0.2s;
            background: #fcfdfe;
        }

        input:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 4px rgba(37, 99, 235, 0.1);
            background: #fff;
        }

        .btn {
            width: 100%;
            padding: 16px;
            background: var(--primary);
            color: white;
            border: none;
            border-radius: var(--radius);
            font-size: 17px;
            font-weight: 700;
            cursor: pointer;
            transition: all 0.2s;
            margin-top: 10px;
        }

        .btn:hover {
            background: var(--primary-hover);
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(37, 99, 235, 0.2);
        }

        .error-list, .success {
            padding: 14px 18px;
            border-radius: var(--radius);
            margin-bottom: 24px;
            font-size: 15px;
            line-height: 1.5;
        }

        .error-list { background: #fff1f2; color: #be123c; border: 1px solid #fecdd3; }
        .success { background: #f0fdf4; color: #15803d; border: 1px solid #bbf7d0; }

        .links {
            margin-top: 30px;
            text-align: center;
            font-size: 15px;
            color: var(--text-muted);
            line-height: 2;
        }

        .links a {
            color: var(--primary);
            font-weight: 700;
            text-decoration: none;
            transition: color 0.2s;
        }

        .links a:hover {
            color: var(--primary-hover);
            text-decoration: underline;
        }

        .admin-link {
            display: inline-block;
            margin-top: 15px;
            padding: 8px 16px;
            background: #f1f5f9;
            border-radius: 10px;
            font-size: 13px;
            color: #64748b !important;
            font-weight: 600 !important;
        }

        .admin-link:hover {
            background: #e2e8f0;
            color: #1e293b !important;
        }

        @media (max-width: 850px) {
            .container { grid-template-columns: 1fr; max-width: 450px; }
            .left { display: none; }
            .right { padding: 40px 30px; }
        }
    </style>
</head>
<body>
<div class="container">
    <div class="left">
        <h1>AmaTrung</h1>
        <p>Chào mừng bạn quay trở lại với không gian chăm sóc sức khỏe Y học cổ truyền hiện đại.</p>
    </div>

    <div class="right">
        <div class="title">Đăng nhập</div>
        <div class="subtitle">Truy cập tài khoản cá nhân của bạn</div>

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
                <input type="text" name="login" value="{{ old('login') }}" placeholder="Nhập thông tin tài khoản" required autocomplete="username">
            </div>

            <div class="form-group">
                <label>Mật khẩu</label>
                <input type="password" name="password" placeholder="Nhập mật khẩu" required autocomplete="current-password">
            </div>

            <button type="submit" class="btn">Đăng nhập ngay</button>
        </form>

        <div class="links">
            Bạn mới biết đến AmaTrung? <a href="{{ route('register') }}">Đăng ký ngay</a><br>
            <a href="{{ route('admin.login') }}" class="admin-link">Cổng quản trị dành cho Nhân viên/Admin</a>
        </div>
    </div>
</div>
</body>
</html>