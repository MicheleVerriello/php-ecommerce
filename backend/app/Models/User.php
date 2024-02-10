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

    public static function create(array $attributes = [])
    {
        return DB::table('users')->insertGetId($attributes);
    }

    public static function getByAttributes(array $attributes = [])
    {
        return DB::table('users')->get($attributes);
    }
}
