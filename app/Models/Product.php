<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $table = 'products';
    protected $primaryKey = 'id';

    protected $fillable = [
        'id',
        'product_name',
        'category_id',
        'delete_status'
    ];
    public function productDetail()
    {
        return $this->hasOne('App\Models\ProductDetail', 'product_id', 'id');
    }
    public function promotion()
    {
        return $this->belongsTo('App\Models\Promotion', 'id', 'product_id');
    }
    public function productPromotion()
    {
        return $this->belongsTo('App\Models\Promotion', 'product_promotion_id', 'id');
    }
}
