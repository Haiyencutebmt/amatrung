<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ArticleController extends Controller
{
    public function index(Request $request)
    {
        $query = Article::with('author')->latest();
        
        if ($request->filled('search')) {
            $query->where('title', 'like', '%' . $request->search . '%');
        }

        $articles = $query->paginate(10)->withQueryString();
        return view('admin.articles.index', compact('articles'));
    }

    public function create()
    {
        return view('admin.articles.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'summary' => 'nullable|string',
            'content' => 'required|string',
            'status' => 'required|in:published,draft',
            'image' => 'nullable|image|max:2048'
        ], [
            'title.required' => 'Vui lòng nhập tiêu đề bài viết.',
            'content.required' => 'Vui lòng nhập nội dung.',
            'image.image' => 'File phải là hình ảnh.'
        ]);

        $validated['author_id'] = auth()->id();
        $validated['slug'] = Str::slug($validated['title']) . '-' . uniqid();

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('articles', 'public');
        }

        Article::create($validated);

        return redirect()->route('admin.articles.index')
            ->with('success', 'Đã thêm bài viết thành công.');
    }

    public function show(Article $article)
    {
        return view('admin.articles.show', compact('article'));
    }

    public function edit(Article $article)
    {
        return view('admin.articles.edit', compact('article'));
    }

    public function update(Request $request, Article $article)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'summary' => 'nullable|string',
            'content' => 'required|string',
            'status' => 'required|in:published,draft',
            'image' => 'nullable|image|max:2048'
        ], [
            'title.required' => 'Vui lòng nhập tiêu đề bài viết.',
            'content.required' => 'Vui lòng nhập nội dung.'
        ]);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('articles', 'public');
        }

        if ($article->title !== $validated['title']) {
            $validated['slug'] = Str::slug($validated['title']) . '-' . uniqid();
        }

        $article->update($validated);

        return redirect()->route('admin.articles.index')
            ->with('success', 'Đã cập nhật bài viết thành công.');
    }

    public function destroy(Article $article)
    {
        $article->delete();
        return redirect()->route('admin.articles.index')
            ->with('success', 'Đã xóa bài viết thành công.');
    }
}
