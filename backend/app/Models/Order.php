<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $primaryKey = 'id';
    protected $fillable = [
        'fkIdUser',
        'totalPrice',
        'creationDate'
    ];

    public static function createOrder($order)
    {
        $query = "INSERT INTO orders (fkiduser, totalPrice, creationDate) VALUES (?, ?, ?)";
    }
}
