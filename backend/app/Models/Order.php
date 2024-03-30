<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Order extends Model
{
    protected $primaryKey = 'id';
    protected $fillable = [
        'fkIdUser',
        'totalPrice',
        'creationDate'
    ];

    public static function createOrder($fkiduser, $totalPrice)
    {
        $query = 'INSERT INTO orders (fkiduser, "totalPrice") VALUES (?, ?, ?)';
        DB::insert($query, [
            $fkiduser,
            $totalPrice
        ]);
    }
}
