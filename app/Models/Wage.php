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
        'wage',
        'hour',
        'user_id',
        'date',
    ];
    public function user()
    {
        return $this->hasOne('App\models\User', 'id', 'user_id');
    }
}
