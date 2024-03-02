<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Category extends Model
{
    protected $primaryKey = 'id';
    protected $fillable = [
        'name'
    ];

    public static function createCategory(array $attributes = []): int
    {
        return DB::table('categories')->insertGetId($attributes);
    }

    public static function getAllCategories()
    {
        $sql = "SELECT * FROM categories";
        return DB::select($sql);
    }

    public static function searchCategories($searchValue)
    {
        $sql = "SELECT * FROM categories WHERE name ILIKE '%$searchValue%'";
        return DB::select($sql);
    }

    public static function getById(int $id)
    {
        return DB::table('categories')->where('id', $id)->first();
    }

    public static function getByName(string $name)
    {
        $categories = DB::table('categories')
            ->where('name', 'ilike', '%'.$name.'%')
            ->get();

        return $categories;
    }

    public static function deleteById(int $id)
    {
        $query = "DELETE FROM categories WHERE id = $id";
        return DB::delete($query);
    }
}