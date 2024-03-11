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

    public static function updateUser($user)
    {
        $sql = "UPDATE users SET
                     name = ?,
                     surname = ?,
                     address = ?,
                     phone = ?,
                     email = ?
                 WHERE id = ?";
        return DB::update($sql, [
            $user->name,
            $user->surname,
            $user->address,
            $user->phone,
            $user->email,
            $user->id
        ]);
    }

    public static function updateUserPassword($id, $hashedNewPassword): int
    {
        $sql = "UPDATE users SET password = ? WHERE id = ?";
        return DB::update($sql, [$hashedNewPassword, $id]);
    }
}
