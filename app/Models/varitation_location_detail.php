<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class varitation_location_detail extends Model
{
    use HasFactory;
    public function products()
    {
        return $this->hasMany(product::class, "product_id");
    }
}
