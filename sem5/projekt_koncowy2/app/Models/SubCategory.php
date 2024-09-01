<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubCategory extends Model
{
    use HasFactory;
    public $timestamps = false;

    protected $table = 'subcategories'; // Dodaj tę linię

    protected $fillable = ['name', 'category_id'];

    public function showWithSubcategories()
    {
        $categories = Category::with('subcategories')->get();
        return view('categoriesWithSubcategories', ['categories' => $categories]);
    }
}
