<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InvoiceDetail extends Model
{
    use HasFactory;
    protected $table = 'invoice_details';
    protected $primaryKey = 'id';

    protected $fillable = [
        'id',
        'invoice_id',
        'user_name',
        'product_name',
        'price_cost',
        'total',
        'submoney',
        'tax',
        'promotion_id',
        'quantity_promotion',
        'date_create'
        
    ];
    public function invoice()
    {
        return $this->hasOne('App\Models\Invoice', 'id', 'invoice_id');
    }
    public function promotion()
    {
        return $this->hasOne('App\Models\Promotion', 'id', 'promotion_id');
    }
}
