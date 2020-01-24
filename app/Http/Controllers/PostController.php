<?php

namespace App\Http\Controllers;

use App\Post;
use App\Category;
use App\Http\Requests\CreatePost;
use App\Http\Requests\EditPost;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index(){
        $posts = Post::all();
        return view('posts/index', [
            'posts' => $posts,
        ]);
    }

    public function showCreateForm()
    {
        $categories = Category::all();
        return view('posts/create',[
            'categories' => $categories,
        ]);
    }

    public function create(CreatePost $request)
    {
        $post = new Post();
        $post->title = $request->title;
        $post->body = $request->body;
        $post->category_id = $request->category_id;

        $post->save();

        return redirect()->route('posts.index');
    }

    public function showEditForm(int $id)
    {
        $post = Post::find($id);
        $categories = Category::all();
        return view('posts/edit', [
            'post' => $post,
            'categories' => $categories,
        ]);
    }

    public function edit(int $id, EditPost $request)
    {
        $post = Post::find($id);

        $post->title = $request->title;
        $post->body = $request->body;
        $post->category_id = $request->category_id;
        $post->save();

        return redirect()->route('posts.index');
    }
}
