<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Comment;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    public function index()
    {
        $articles = Article::where('status', 'published')
            ->withCount('comments')
            ->latest()
            ->paginate(12);

        return view('user.articles.index', compact('articles'));
    }

    public function show($slug)
    {
        $article = Article::where('slug', $slug)->where('status', 'published')->firstOrFail();
        
        // Increase views
        $article->increment('views');

        $article->load(['approvedComments.user', 'author']);

        return view('user.articles.show', compact('article'));
    }

    public function storeComment(Request $request, $id)
    {
        $request->validate([
            'content' => 'required|string|max:1000'
        ], [
            'content.required' => 'Vui lòng nhập nội dung bình luận.'
        ]);

        $article = Article::findOrFail($id);

        Comment::create([
            'article_id' => $article->id,
            'user_id' => auth()->id(),
            'content' => $request->input('content'),
            'status' => 'approved', // Auto approve for demo
        ]);

        return back()->with('success', 'Đã gửi bình luận thành công.');
    }
}
