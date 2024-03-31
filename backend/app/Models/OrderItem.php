<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class OrderItem extends Model
{
    protected $primaryKey = 'id';
    protected $fillable = [
        'fkidorder',
        'fkiditem',
        'quantity'
    ];

    public static function insertOrderItem($fkidorder, $fkiditem, $quantity)
    {
        $query = 'INSERT INTO orderitems (fkidorder, fkiditem, quantity) VALUES (?, ?, ?)';
        return DB::insert($query, [
            $fkidorder,
            $fkiditem,
            $quantity
        ]);
    }

    public static function getOrderItemsByOrderId($fkidorder)
    {
        $query = 'SELECT * FROM orderitems WHERE fkidorder = ?';
        return DB::select($query, [
            $fkidorder
        ]);
    }
}
