<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;
use App\Http\Requests\CreateCategory;

class CategoryController extends Controller
{
    public function index(){
        $categorys = Category::all();

        return view('categories/index', [
            'categories' => $categorys,
        ]);
    }

    public function showCreateForm()
    {
        return view('categories/create');
    }

    public function create(CreateCategory $request)
    {
        $category = new Category();
        $category->title = $request->title;
        $category->save();

        return redirect()->route('posts.index');
    }
}
