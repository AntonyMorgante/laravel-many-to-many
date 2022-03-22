<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable=['title','content','slug','user_id','cathegory_id','image'];

    public function user(){
        return $this->belongsTo('App\User');
    }

    public function cathegory(){
        return $this->belongsTo('App\Cathegory');
    }

    public function tags(){
        return $this->belongsToMany('App\Tag');
    }

}
