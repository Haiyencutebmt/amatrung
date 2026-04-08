<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng ký - AmaTrung</title>
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
            padding: 40px 20px;
        }

        .wrapper {
            width: 100%;
            max-width: 1000px;
            display: grid;
            grid-template-columns: 1fr 1.5fr;
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
            bottom: -30px;
            left: -30px;
            font-size: 150px;
            opacity: 0.1;
            transform: rotate(-15deg);
        }

        .left h1 {
            font-size: 42px;
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
        }

        .subtitle {
            color: var(--text-muted);
            margin-bottom: 32px;
            font-size: 16px;
        }

        .grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
        }

        .form-group {
            margin-bottom: 4px;
        }

        label {
            display: block;
            margin-bottom: 8px;
            font-weight: 600;
            font-size: 14px;
            color: #475569;
        }

        input, select {
            width: 100%;
            padding: 14px 18px;
            border: 1px solid var(--border);
            border-radius: var(--radius);
            font-size: 16px;
            outline: none;
            transition: all 0.2s;
            background: #fcfdfe;
        }

        input:focus, select:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 4px rgba(37, 99, 235, 0.1);
            background: #fff;
        }

        .full {
            grid-column: 1 / -1;
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

        .error-list {
            background: #fff1f2;
            color: #be123c;
            padding: 14px 18px;
            border-radius: var(--radius);
            margin-bottom: 24px;
            font-size: 15px;
            border: 1px solid #fecdd3;
        }

        .link {
            text-align: center;
            margin-top: 30px;
            font-size: 15px;
            color: var(--text-muted);
        }

        .link a {
            color: var(--primary);
            font-weight: 700;
            text-decoration: none;
        }

        .link a:hover {
            text-decoration: underline;
        }

        @media (max-width: 950px) {
            .wrapper { grid-template-columns: 1fr; max-width: 550px; }
            .left { display: none; }
            .right { padding: 40px 30px; }
            .grid { grid-template-columns: 1fr; }
        }
    </style>
</head>
<body>
<div class="wrapper">
    <div class="left">
        <h1>AmaTrung</h1>
        <p>Tham gia cộng đồng AmaTrung để cùng chúng tôi kiến tạo một lối sống khỏe mạnh từ thảo dược thiên nhiên.</p>
    </div>

    <div class="right">
        <div class="title">Tạo tài khoản</div>
        <div class="subtitle">Bắt đầu hành trình chăm sóc sức khỏe của bạn</div>

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
                    <input type="text" name="name" value="{{ old('name') }}" placeholder="Nhập họ và tên" required>
                </div>

                <div class="form-group">
                    <label>Số điện thoại</label>
                    <input type="text" name="phone" value="{{ old('phone') }}" placeholder="Nhập số điện thoại" required>
                </div>

                <div class="form-group full">
                    <label>Email</label>
                    <input type="email" name="email" value="{{ old('email') }}" placeholder="Nhập địa chỉ email" required>
                </div>

                <div class="form-group">
                    <label>Giới tính</label>
                    <select name="gender" required>
                        <option value="">-- Chọn giới tính --</option>
                        <option value="male" {{ old('gender') == 'male' ? 'selected' : '' }}>Nam</option>
                        <option value="female" {{ old('gender') == 'female' ? 'selected' : '' }}>Nữ</option>
                        <option value="other" {{ old('gender') == 'other' ? 'selected' : '' }}>Khác</option>
                    </select>
                </div>

                <div class="form-group">
                    <label>Ngày sinh</label>
                    <input type="date" name="date_of_birth" value="{{ old('date_of_birth') }}" required>
                </div>

                <div class="form-group">
                    <label>Mật khẩu</label>
                    <input type="password" name="password" placeholder="Nhập mật khẩu" required autocomplete="new-password">
                </div>

                <div class="form-group">
                    <label>Xác nhận mật khẩu</label>
                    <input type="password" name="password_confirmation" placeholder="Nhập lại mật khẩu" required autocomplete="new-password">
                </div>

                <div class="form-group full">
                    <button type="submit" class="btn">Đăng ký ngay</button>
                </div>
            </div>
        </form>

        <div class="link">
            Đã có tài khoản AmaTrung? <a href="{{ route('login') }}">Đăng nhập ngay</a>
        </div>
    </div>
</div>
</body>
</html>ink">
            Đã có tài khoản? <a href="{{ route('login') }}">Đăng nhập ngay</a>
        </div>
    </div>
</div>
</body>
</html>