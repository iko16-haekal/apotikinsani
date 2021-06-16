<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class transaction extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function invoice()
    {
        return $this->hasMany(Invoice::class, "transaction_id");
    }
}
