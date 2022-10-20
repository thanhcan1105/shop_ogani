<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Categories extends Model
{
    use HasFactory;

    protected $table = 'categories';

    protected $fillable = ['name', 'parent_id', 'slug'];


    public function subCategories()
    {
        return $this->hasMany(Categories::class, 'parent_id');
    }

    public function parentCategory()
    {
        return $this->belongsTo(Categories::class, 'parent_id');
    }

    public function products()
    {
        return $this->hasMany(Products::class, 'category_id', 'id');
    }
}
