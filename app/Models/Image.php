<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    use HasFactory;

    protected $table = 'images';

    protected $fillable = ['name','product_id'];

    public function productImage(){
        return $this->belongsTo(Products::class,'product_id', 'id');
    }
}
