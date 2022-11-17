<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Users extends Model
{
    //テーブル名
    protected $table = 'companies';

    //可変項目
    protected $fillable  =
    [
        'id',
        'user_name',
        'email',
        'email_verified_at',
    ];
}
