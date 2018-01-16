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

    public function isLiked($article_id){
        $like = $this->articles_id;
        $chars = preg_split('/[,]+/', $like , -1);
        if (in_array($article_id, $chars)){
            return true;
        }
        else{
            return false;
        }
    }

    public function unlike($article_id){
        $like = $this->articles_id;
        $chars = preg_split('/[,]+/', $like , -1);
        $offset1 = array_search($article_id, $chars);
        array_forget($chars, $offset1);
        $echo =null;
        foreach ($chars as $char){
            $echo .= ','.$char;
        }
        return $echo;
    }
}
