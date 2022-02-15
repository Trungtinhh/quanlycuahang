<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;
    protected $table = 'invoices';
    protected $primaryKey = 'id';

    protected $fillable = [
        'id',
        'saler_id',
        'buyer_id',
        'product_id',
        'user_id',
        'product_amount',
        'product_unit', 
        'price_id',
        'date_create',
        'status'
    ];
    public function saler()
    {
        return $this->hasOne('App\Models\Saler', 'id', 'saler_id');
    }
    public function buyer()
    {
        return $this->hasOne('App\Models\Buyer', 'id', 'buyer_id');
    }
    public function product()
    {
        return $this->hasOne('App\Models\Product', 'id', 'product_id');
    }
    public function user()
    {
        return $this->hasOne('App\Models\Staff', 'id', 'user_id');
    }
    public function invoiceDetail()
    {
        return $this->belongsTo('App\Models\InvoiceDetail', 'id', 'invoice_id');
    }

}
