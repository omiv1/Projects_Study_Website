<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $categories = Category::whereHas('deals')->get()->map(function ($category) {
            $category->deals = $category->deals()->orderByDesc('points')->take(3)->get();
            return $category;
        });

        return view('welcome', compact('categories'));
    }
}
