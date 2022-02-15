<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Staff extends Model
{
    use HasFactory;
    protected $table = 'staff';
    protected $primaryKey = 'id';

    protected $fillable = [
        'id',
        'staff_name',
        'address',
        'phone',
        'position'
    ];
}
