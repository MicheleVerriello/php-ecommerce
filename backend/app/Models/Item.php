<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    protected $primaryKey = 'id';
    protected $fillable = [
        'name',
        'description',
        'price',
        'photo',
        'fkIdCategory'
    ];
}
