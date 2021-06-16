<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class product extends Model
{
    use HasFactory;

    public function carts()
    {
        return $this->hasMany(Cart::class);
    }

    public function invoices()
    {
        return $this->hasMany(Invoice::class, "product_id");
    }


    public function variation()
    {
        return $this->hasMany(Variation::class, "product_id");
    }

    public function variation_location_detail()
    {
        return $this->hasMany(Variation_location_detail::class, "product_id");
    }

    public function unit()
    {
        return $this->belongsTo(Unit::class);
    }
}
