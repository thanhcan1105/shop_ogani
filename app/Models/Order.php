<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $table = 'orders';

    protected $fillable = ['full_name','phone','email','province_id','district_id','ward_id','address','note'];

    public function province(){
        return $this->belongsTo(Province::class, 'province_id', 'id');
    }

    public function district(){
        return $this->belongsTo(District::class, 'district_id', 'id');
    }

    public function ward(){
        return $this->belongsTo(Ward::class, 'ward_id', 'id');
    }

    public function order_detail(){
        return $this->hasMany(ProductOrder::class, 'order_id', 'id');
    }

}
