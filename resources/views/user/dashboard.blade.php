<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Dashboard User - AmaTrung</title>
</head>
<body style="font-family: Arial, sans-serif; background:#f6faf7; padding:40px;">
    <h1>Trang người dùng AmaTrung</h1>
    <p>Xin chào, {{ auth()->user()->name }}.</p>

    <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button type="submit">Đăng xuất</button>
    </form>
</body>
</html>