<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pharmacy extends Model
{
    use HasFactory;

    protected $table = 'pharmacies';

    protected $fillable = ['name', 'address'];

    public function products()
    {
        return $this->belongsToMany(Product::class, 'pharmacy_product')->withPivot('price', 'quantity');
    }

    public function getPriceAttribute()
    {
        return $this->pivot->price / 100;
    }
}
