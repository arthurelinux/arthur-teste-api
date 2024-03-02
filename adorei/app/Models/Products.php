<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'price', 'description'];

    public function sales()
    {
        return $this->belongsToMany(Sales::class, 'sales_products')->withPivot('amount');
    }
}
