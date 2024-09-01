<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::orderby('created_at', 'asc')->get();
        return view('categories', ['categories' => $categories]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $category = new Category;
        return view('addCategoryForm', ['category' => $category]);
    }

    public function showWithSubcategories()
    {
        $categories = Category::with('subcategories')->get();
        return view('categoriesWithSubcategories', ['categories' => $categories]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
        ]);

        if (\Auth::user() == null){
            return view('welcome');
        }

        $category = new Category;
        $category->name = $request->name;

        if ($category->save()) {
            return redirect('categoriesWithSubcategories');
        }

        return view('categoriesWithSubcategories');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id) {
        $category = Category::find($id);
        return view('categoriesEditForm', ['category'=>$category]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $category = Category::find($id);
        $category->name = $request->name;

        if($category->save()) {
            return redirect()->route('categories');
        }

        return "Wystąpił błąd.";
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $category = Category::find($id);

        if($category->delete()){
            return redirect()->route('categories');
        }
        else return back();
    }
}
