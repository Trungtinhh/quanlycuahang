<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductDetail extends Model
{
    use HasFactory;
    protected $table ='product_details';
    protected $primaryKey = 'id';

    protected $fillable = [
        'id',
        'product_id',
        'product_name',
        'price_id',
        'provider_id',
        'amount',
        'unit',
        'specifying',
        'shipment_number',
        'description',
        'date_add',
        'date_exp',
        'image'
    ];

    public function product()
    {
        return $this->belongsTo('App\Models\Product', 'product_id', 'id');
    }
    public function price()
    {
        return $this->belongsTo('App\Models\Price', 'price_id', 'price_id');
    }
    public function provider()
    {
        return $this->belongsTo('App\Models\Provider', 'provider_id', 'id');
    }
}
