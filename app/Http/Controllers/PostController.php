<?php

namespace App\Http\Controllers;

use App\Post;
use App\Category;
use App\Tag;
use App\Image;
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
        //filledで空でないか確認
        if($request->filled('category')) {
           $query->where('category_id', $category);
        }
        if($request->filled('tags')) {
            //wherehas内でforeachを回すとうまくいかない
            foreach ($tags as $key => $id) {
                $query->whereHas('tags', function($query_t) use ($id) {
                    $query_t->where('id', $id);
                });
            }
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

        // 選択したpostIDの取得
        $select_id = $post->id;
        // アップロードするディレクトリ名を指定
        $up_dir = 'images/' . $select_id;
        //ファイルがアップロードされているか確認
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $key => $image) {
                // アップロードしたファイル名を取得
                // ファイル名がかぶる可能性、あとで修正
                $upload_name = $key."_".$_FILES['images']['name'][$key];
                $filename = $image->storeAs($up_dir, $upload_name, 'public');

                $post->images()->create(['filename' => $upload_name,]);
            }
        }

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
