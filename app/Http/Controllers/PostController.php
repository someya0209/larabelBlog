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
        $posts = Post::paginate(10);
        //ユーザーの記事のみ表示
        //$posts = Auth::user()->posts()->paginate(10);
        $categories = Category::all();
        $tags = Tag::all();

        return view('posts/index', [
            'posts' => $posts,
            'categories' => $categories,
            'tags' => $tags,
        ]);
    }

    public function search(Request $request){
        //$posts = Post::all();
        #キーワード受け取り
        $keyword = $request->input('keyword');
        #カテゴリid受け取り
        $category = $request->input('category');
        #タグid受け取り
        $tags = $request->input('tags');

        $query = Post::query();

        if($request->has('keyword')) {
           $query->where('title', 'like', '%'.$keyword.'%');
        }
        if($request->has('category')) {
           $query->where('category_id', 'like', '%'.$category.'%');
        }
        if($request->has('tags')) {
           $query->whereHas('tags', function($query_t) use ($tags) {
                foreach ($tags as $key => $id) {
                    $query_t->where('id', 'like', '%'.$id.'%');
                }
            });
        }
        $posts = $query->paginate(10);

        $categories = Category::all();
        $tags = Tag::all();
        return view('posts/index', [
            'posts' => $posts,
            'categories' => $categories,
            'tags' => $tags,
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

    public function delete(Post $post)
    {
        \DB::transaction(function () use ($post) {
            $post->delete();
        });

        return redirect()->route('posts.index');
    }

    public function view(Post $post)
    {
        return view('posts/view', [
            'post' => $post,
        ]);
    }
}
