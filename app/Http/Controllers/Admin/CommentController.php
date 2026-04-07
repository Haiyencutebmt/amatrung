<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function index(Request $request)
    {
        $query = Comment::with(['user', 'article'])->latest();
        
        $comments = $query->paginate(20);
        return view('admin.comments.index', compact('comments'));
    }

    public function toggleStatus(Comment $comment)
    {
        $comment->status = $comment->status === 'approved' ? 'hidden' : 'approved';
        $comment->save();

        return back()->with('success', 'Đã cập nhật trạng thái bình luận.');
    }

    public function destroy(Comment $comment)
    {
        $comment->delete();
        return back()->with('success', 'Đã xóa bình luận.');
    }
}
