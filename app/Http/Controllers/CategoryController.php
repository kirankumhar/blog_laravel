<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $categories = Category::latest()->get();
        return view('category.index', compact('categories'));
        
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('category.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'title' => 'required|string|max:255',
            'slug'  => 'nullable|string|max:255|unique:categories,slug'
        ]);

        $slug = $request->slug ?: \Str::slug($request->title);

        Category::create([
            'title' => $request->title,
            'slug' =>$slug
        ]);

        return redirect()->route('category.index')
            ->with('success', 'category created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        //
        $categories = Category::findOrFail($id);
        return view('category.edit', compact('categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,  $id)
    {
        //
        $request->validate([
            'title' => 'required|string|max:255',
            'slug'  => [
                            'nullable',
                            'string',
                            'max:255',
                            Rule::unique('categories', 'slug')->ignore($id)
                        ],
        ]);

        $slug = $request->slug ?: \Str::slug($request->title);

        $category = Category::findOrFail($id);

       
        $category->title = $request->title;
        $category->slug = $slug;
        
        $category->save();

        return redirect()->route('category.index')
            ->with('success', 'category created successfully');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy( $id)
    {
        //
        $category = Category::findOrFail($id);
        $category->delete();

        return redirect()->route('category.index')->with('success', 'Category deleted successfully!');
    }
}
