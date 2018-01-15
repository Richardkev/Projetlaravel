<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    protected $fillable = [
        'user_id',
        'articles_id',
        'created_at',
        'updated_at',
    ];
}
