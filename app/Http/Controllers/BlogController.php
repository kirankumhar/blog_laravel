<?php

namespace App\Http\Controllers;
use App\Models\Blog;
use App\Models\Category;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $blogs = Blog::with('category')->latest()->get();
        return view('blogs.index', compact('blogs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $categories = Category::all();
        return view('blogs.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'title' => 'required',
            'category_id' => 'required',
            'content'   => 'required',
            'image'     =>  'nullable|image|mimes:jpg,jpeg,png|max:2048'
        ]);

        $blog = new Blog();
        $blog->title = $request->title;
        $blog->slug  = Str::slug($request->title);
        $blog->categories_id = $request->category_id;
        $blog->content = $request->content;

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('blogs', 'public');
            $blog->image = $path;
        }

        $blog->save();

        return redirect()->route('blogs.index')->with('success', 'Blog created successfully.');

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
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
