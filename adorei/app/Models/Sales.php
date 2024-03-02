<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sales extends Model
{
    use HasFactory;
    protected $fillable = ['product_id', 'amount'. 'canceled_at'];

    public function products()
    {
        return $this->belongsToMany(Products::class, 'sales_products')->withPivot('amount');
    }
    public function salesProducts()
    {
        return $this->hasMany(SalesProducts::class);
    }
}
