<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductModel extends Model
{
    use SoftDeletes; 

    public $table = "tbl_product";
    protected $fillable = [
        'product_name',
        'category',
        'price',
        'id'
    ];
}
