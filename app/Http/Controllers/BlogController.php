<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

use Carbon\Carbon;

class BlogController extends Controller
{
    //
    public function index()
    {
        $posts = Post::where('published_at', '<=', Carbon::now())   //找出小於今天的日期
            ->orderBy('published_at', 'desc')
            ->paginate(config('blog.posts_per_page'));  //分頁

        return view('blog.index', compact('posts'));
    }

    public function showPost($slug)
    {
        $post = Post::where('slug', $slug)->firstOrFail();
        return view('blog.post', ['post' => $post]);
    }
}
