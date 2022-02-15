<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Promotion extends Model
{
    use HasFactory;
    protected $table = 'promotions';
    protected $primaryKey = 'id';

    protected $fillable = [
        'id',
        'product_id',
        'quantity',
        'product_promotion_id',
        'quantity_promotion',
        'other_product_promotion',
        'quantity_other_promotion',
        'status'
    ];

    public function product()
    {
        return $this->hasOne('App\Models\Product', 'id', 'product_id');
    }
    public function productPromotion()
    {
        return $this->hasOne('App\Models\Product', 'id', 'product_promotion_id');
    }
}
