<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckPermission
{
    public function handle(Request $request, Closure $next, string $permission): Response
    {
        if (!Auth::check()) {
            abort(403, 'Bạn chưa đăng nhập.');
        }

        $user = $request->user();

        if (!$user || !$user->hasPermission($permission)) {
            abort(403, 'Bạn không có quyền thực hiện chức năng này.');
        }

        return $next($request);
    }
}