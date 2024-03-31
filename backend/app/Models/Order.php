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

    public static function createOrder($fkiduser, $totalPrice): int
    {
        $query = 'INSERT INTO orders (fkiduser, "totalPrice", "creationDate") VALUES (?, ?, now())';
        DB::insert($query, [
            $fkiduser,
            $totalPrice
        ]);

        // Get the last inserted ID
        $lastInsertedId = DB::getPdo()->lastInsertId();

        return $lastInsertedId;

    }

    public static function getOrdersByUserId($userId)
    {
        $query = 'SELECT * FROM orders WHERE fkiduser = ? ORDER BY "creationDate" DESC';
        return DB::select($query, [$userId]);
    }

    public static function getOrderDetails($id)
    {
        $query = 'SELECT * FROM orders WHERE id = ?';
        return DB::select($query, [$id]);
    }

    public static function deleteOrder($id)
    {
        $query = 'DELETE FROM orders WHERE id = ?';
        return DB::delete($query, [$id]);
    }
}
