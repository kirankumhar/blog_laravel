<?php

namespace App\Http\Controllers\Admin;

use App\Models\Blog;
use App\Models\Category;
use App\Models\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    //
    public function index()
    {
        $totalBlogs = Blog::count();
        $totalCategories = Category::count();
        $totalUsers = User::count();
        $recentBlogs = Blog::latest()->take(5)->get();
        return view('admin.dashboard', compact('totalBlogs', 'totalCategories', 'totalUsers', 'recentBlogs'));
    }
}
