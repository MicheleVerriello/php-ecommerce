<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Item extends Model
{
    protected $primaryKey = 'id';
    protected $fillable = [
        'name',
        'description',
        'price',
        'photo',
        'quantity',
        'fkidcategory'
    ];

    public static function create(array $attributes = []): int
    {
        $columns = implode(', ', array_keys($attributes));
        $values = "'" . implode("', '", $attributes) . "'";
        $query = "INSERT INTO items ($columns) VALUES ($values)";

        DB::statement($query);

        return DB::getPdo()->lastInsertId();
    }

    public static function getAllItems()
    {
        $query = "SELECT * FROM items";
        return DB::select($query);
    }

    public static function getById($id)
    {
        $query = "SELECT * FROM items WHERE id = $id";
        return DB::selectOne($query);
    }

    public static function deleteById($id)
    {
        $query = "DELETE FROM items WHERE id = $id";
        return DB::delete($query);
    }

    public static function updateById($id, $item)
    {
        $query = "UPDATE items SET name = $item.name, description = $item.description, price = $item.price, quantity = $item.quantity, fkidcategory = item.fkidcategory WHERE id = $id";
        return DB::update($query);
    }
}
