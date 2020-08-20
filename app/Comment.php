<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
//ALTER TABLE comment ADD CONSTRAINT comment_idusers_foreign FOREIGN KEY (idUser) REFERENCES users(id) ON DELETE CASCADE ON UPDATE CASCADE
    protected $table = 'comment';

    public function tintuc(){
        return $this->belongsTo('App\TinTuc','idTinTuc','id');
    }

    public function user(){
        return $this->belongsTo('App\User','idUser','id');
    }
}
