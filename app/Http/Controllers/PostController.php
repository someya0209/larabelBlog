<?php

namespace App\Http\Controllers;

use App\Post;
use App\Category;
use App\Tag;
use App\Http\Requests\CreatePost;
use App\Http\Requests\EditPost;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    public function index(){
        //$posts = Post::all();
        $posts = Auth::user()->posts()->get();
        return view('posts/index', [
            'posts' => $posts,
        ]);
    }

    public function showCreateForm()
    {
        $categories = Category::all();
        $tags = Tag::all();
        return view('posts/create',[
            'categories' => $categories,
            'tags' => $tags,
        ]);
    }

    public function create(CreatePost $request)
    {
        $post = new Post();
        $post->title = $request->title;
        $post->body = $request->body;
        $post->category_id = $request->category_id;

        Auth::user()->posts()->save($post);
        $post->tags()->attach(request()->tags);

        return redirect()->route('posts.index');
    }

    public function showEditForm(Post $post)
    {
        $categories = Category::all();
        $tags = Tag::all();
        return view('posts/edit', [
            'post' => $post,
            'categories' => $categories,
            'tags' => $tags,
        ]);
    }

    public function edit(Post $post, EditPost $request)
    {
        $post->title = $request->title;
        $post->body = $request->body;
        $post->category_id = $request->category_id;
        $post->save();
        $post->tags()->attach(request()->tags);

        return redirect()->route('posts.index');
    }

    public function view(Post $post)
    {
        return view('posts/view', [
            'post' => $post,
        ]);
    }
}
