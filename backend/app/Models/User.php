<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class User extends Model
{
    protected $primaryKey = 'id';
    protected $fillable = [
        'name',
        'surname',
        'email',
        'password',
        'address',
        'phone',
        'isAdmin'
    ];

    protected $hidden = [
        'password'
    ];

    public static function create(array $attributes = []): int
    {
        return DB::table('users')->insertGetId($attributes);
    }

    public static function getUserByEmail(string $email)
    {
        $sql = "SELECT * FROM users WHERE email = ?";
        return DB::selectOne($sql, [$email]);
    }

    public static function getById(int $id)
    {
        $sql = "SELECT * FROM users WHERE id = ?";
        return DB::selectOne($sql, [$id]);
    }
}
