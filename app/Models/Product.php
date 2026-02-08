<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = [
        'code',
        'name',
        'stock',
        'unit'
    ];

    public function stockIn(){
        return $this->hasMany(StockIn::class);
    }

    public function stockOur(){
        return $this->hasMany(StockOut::class);
    }
}
