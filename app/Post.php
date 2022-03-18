<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Cathegory;

class Post extends Model
{
    protected $fillable=['title','content','slug','user_id','cathegory_id'];

    public function user(){
        return $this->belongsTo('App\User');
    }

    public function cathegory(){
        return $this->belongsTo('App\Cathegory');
    }

}
