<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    protected $primaryKey = 'id';
    protected $fillable = [
        'fkIdUser',
        'fkIdOrder',
        'fkIdItem'
    ];
}
