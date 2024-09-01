<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Deal extends Model
{
    use HasFactory;
    public $timestamps = false;

    protected $fillable = [
        'manufacturer',
        'deal_link',
        'image_link',
        'model',
        'name',
        'product_code',
        'category_id',
        'subcategory_id',
        'price',
        'added_at',
        'shadow',
        'user_id',
        'points'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function subcategory()
    {
        return $this->belongsTo(SubCategory::class);
    }
}
