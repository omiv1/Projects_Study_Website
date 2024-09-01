<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Deal;

class Category extends Model
{
    use HasFactory;
    public $timestamps = false;

    protected $fillable = ['name'];

    public function subcategories()
    {
        return $this->hasMany(SubCategory::class);
    }

    public function deals()
    {
        return $this->hasMany(Deal::class);
    }
}
