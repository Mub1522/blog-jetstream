<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\Category;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = Post::latest()->paginate(10);

        return view('admin.posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();

        return view('admin.posts.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([ 
            'title' => 'required|min:2',
            'slug' => 'required|unique:posts,slug',
            'category_id' => 'required|exists:categories,id',
        ],[
            'category_id.exists' => __('The category field does not exist.'),
        ]);

        $post = Post::create($request->all());

        return redirect()->route('admin.posts.edit', $post)->with('status', __('The post has been created successfully.'));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        $categories = Category::all();
        return view('admin.posts.edit', compact('post', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        $request->validate([ 
            'title' => 'required|min:2',
            'slug' => 'required|unique:posts,slug,' . $post->id,
            'excerpt' => 'nullable',
            'body' => 'nullable',
            'category_id' => 'required|exists:categories,id',
        ],[
            'category_id.exists' => __('The category field does not exist.'),
        ]);

        $post->update($request->all());

        return redirect()->route('admin.posts.edit', $post)->with('status', __('The post has been updated successfully.'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
