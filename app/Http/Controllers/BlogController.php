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
    public function index(Request $request)
    {
        $query = Blog::query();

        // Search
        if ($request->has('search') && $request->search != '') {
            $query->where('title', 'like', '%' . $request->search . '%');
        }

        // Sorting
        $sortBy = $request->get('sort_by', 'created_at'); // default column
        $sortOrder = $request->get('sort_order', 'desc'); // default order

        $allowedSorts = ['title', 'created_at']; // allowed columns to prevent SQL injection
        if (!in_array($sortBy, $allowedSorts)) {
            $sortBy = 'created_at';
        }

        $query->orderBy($sortBy, $sortOrder);

        // Pagination
        $blogs = $query->paginate(5)->withQueryString();

        return view('blogs.index', compact('blogs', 'sortBy', 'sortOrder'));
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
            'title'         => 'required',
            'category_id'   => 'required',
            'content'       => 'required',
            'image'         => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'status'        => 'required|in:draft,published'
        ]);

        $blog = new Blog();
        $blog->title = $request->title;
        $blog->slug  = Str::slug($request->title);
        $blog->categories_id = $request->category_id;
        $blog->content = $request->content;
        $blog->status = $request->status;

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
        $blog = Blog::findOrFail($id);
        $categories = Category::all();
        return view('blogs.edit', compact('blog', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        //
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'category_id' => 'required|exists:categories,id',
            'status' => 'required|in:draft,published'
        ]);

        $blog = Blog::findOrFail($id);

        if($request->hasFile('image')){
            if($blog->image && \Storage::disk('public')->exists($blog->image)){
                \Storage::disk('public')->delete($blog->image);
            }
            $blog->image = $request->file('image')->store('image', 'public');
        }

        $blog->title = $request->title;
        $blog->content = $request->content;
        $blog->categories_id = $request->category_id;
        $blog->status = $request->status;
        $blog->save();

        return redirect()->route('blogs.index')->with('success', 'Blog updated successfully!');
    }   

    /**
     * Remove the specified resource from storage.
     */
    public function destroy ($id)
    {
        //
        $blog = Blog::findORFail($id);
        if ($blog->image && \Storage::disk('public')->exists($blog->image)) {
            \Storage::disk('public')->delete($blog->image);
        }

        $blog->delete();

        return redirect()->route('blogs.index')->with('success', 'Post deleted successfully!');
    }


    public function apiIndex()
    {
        $blogs = Blog::all(); // get all blogs
        return response()->json($blogs); // return as JSON
    }
}
