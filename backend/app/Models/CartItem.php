<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class CartItem extends Model
{
    protected $primaryKey = 'id';
    protected $fillable = [
        'fkIdUser',
        'fkIdItem',
        'quantity'
    ];

    public static function deleteCartItem($id)
    {
        $query = 'DELETE FROM cartitems WHERE id = ?';
        return DB::delete($query, [$id]);
    }

    public static function deleteCart($idUser)
    {
        $query = 'DELETE FROM cartitems WHERE fkiduser = ?'; //delete all the item for the specified user
        return DB::delete($query, [$idUser]);
    }

    public static function getCartByUserId($idUser) {
        $query = 'SELECT * FROM cartitems WHERE fkiduser = ? ORDER BY id ASC';
        return DB::select($query, [$idUser]);
    }

    public static function addItemToCart($idUser, $idItem, $quantity)
    {
        $query = 'INSERT INTO cartitems (fkiduser, fkiditem, quantity) VALUES (?, ?, ?)';
        return DB::insert($query, [$idUser, $idItem, $quantity]);
    }

    public static function updateCartItemQuantity($id, $quantity)
    {
        $query = 'UPDATE cartitems SET quantity = ? WHERE id = ?';
        return DB::update($query, [$quantity, $id]);
    }
}
