<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wage extends Model
{
    use HasFactory;
    protected $table = 'wages';
    protected $primaryKey = 'id';

    protected $fillable = [
        'id',
        'salary_date',
        'user_name',
        'wage_basic',
        'sales_money',
        'bonus',
        'deduct',
        'wage',
        'note',
    ];
}
