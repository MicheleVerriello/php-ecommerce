<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CartItem extends Model
{
    protected $primaryKey = 'id';
    protected $fillable = [
        'fkIdUser',
        'fkIdItem',
        'quantity'
    ];
}
