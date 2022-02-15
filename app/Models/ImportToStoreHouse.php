<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ImportToStoreHouse extends Model
{
    use HasFactory;
    protected $table = 'import_to_store_houses';
    protected $primaryKey = 'id';

    protected $fillable = [
        'id',
        'product_id',
        'amount_add',
        'date_add'
    ];

    public function product()
    {
        return $this->hasOne('App\Models\Product', 'id', 'product_id');
    }
}
