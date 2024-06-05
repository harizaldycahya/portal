<?php

namespace App\Models;


use Illuminate\Foundation\Auth\User as Authenticatable;


class User extends Authenticatable
{

    protected $table = 'tb_user'; // Specify your custom table name

    protected $fillable = [
        'name', 'email', 'password', 'id_user',
    ];

    protected $primaryKey = 'id_user';
    public $incrementing = false;
    protected $keyType = 'string'; // Change to 'int' if id_user is an integer

    public function getAuthIdentifierName()
    {
        return 'id_user';
    }
}
