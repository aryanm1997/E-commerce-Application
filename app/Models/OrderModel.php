<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OrderModel extends Model
{
    use SoftDeletes; 

    public $table = "tbl_order";
    protected $fillable = [
        'order_id',
        'customer_name',
        'phone',
        'net_amount',
        'order_date',
        'product_name'
    ];
}
