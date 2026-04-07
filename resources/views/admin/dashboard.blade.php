<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Dashboard Admin - AmaTrung</title>
</head>
<body style="font-family: Arial, sans-serif; background:#f6faf7; padding:40px;">
    <h1>Dashboard quản trị AmaTrung</h1>
    <p>Xin chào, {{ auth()->user()->name }}.</p>
    <p>Vai trò:
        @foreach(auth()->user()->roles as $role)
            <strong>{{ $role->display_name }}</strong>
        @endforeach
    </p>

    <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button type="submit">Đăng xuất</button>
    </form>
</body>
</html>