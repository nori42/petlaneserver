<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    use HasFactory;
    protected $table = 'stocks';
    public $timestamps = false;

    public function product() {
        return $this->belongsTo(Product::class, 'Product_ID');
    }
}
