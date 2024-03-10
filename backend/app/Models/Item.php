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
        'fkidcategory',
        'isoffer'
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
        $query = "UPDATE items SET
                 name = ?,
                 description = ?,
                 price = ?,
                 quantity = ?,
                 fkidcategory = ?,
                 photo = ?,
                 isoffer = ?
             WHERE id = ?";
        return DB::update($query, [
            $item->name,
            $item->description,
            $item->price,
            $item->quantity,
            $item->fkidcategory,
            $item->photo,
            $item->isoffer,
            $id
        ]);
    }

    public static function deleteItemPhoto($id) {
        $sql = "UPDATE items SET photo = null WHERE id = $id";
        return DB::delete($sql);
    }

    public static function updateItemPhoto($id, $imageName): int
    {
        $sql = "UPDATE items SET photo = ? WHERE id = ?";
        return DB::update($sql, [$imageName, $id]);
    }

    public static function searchItems($searchValue)
    {
        $sql = "SELECT * FROM items WHERE name ILIKE '%$searchValue%'";
        return DB::select($sql);
    }
}
