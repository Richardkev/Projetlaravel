<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    protected $fillable = [
        'user_id',
        'title',
        'content',
        'created_at',
        'updated_at'
    ];

    public function who($id){
        $user = User::find($id);

        return $user->name;
    }
}
