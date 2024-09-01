<?php

namespace App\Http\Controllers;

use App\Models\SubCategory;
use Illuminate\Http\Request;

class SubCategoryController extends Controller
{
    public function create()
    {
        $categories = \App\Models\Category::all();
        return view('addSubCategoryForm', ['categories' => $categories]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
        ]);
        $subCategory = new SubCategory;
        $subCategory->name = $request->name;
        $subCategory->category_id = $request->category_id;
        $subCategory->save();

        return redirect()->route('categoriesWithSubcategories');
    }
}
