<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Saler extends Model
{
    use HasFactory;
    protected $table = 'salers';
    protected $primaryKey = 'id';

    protected $fillable = [
        'id',
        'saler_name',
        'tax_code',
        'address',
        'phone'
    ];
}
