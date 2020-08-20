<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use phpDocumentor\Reflection\Types\True_;

class TheLoai extends Model
{
    protected $table = 'theloai';
    public function loaitin(){
        return $this->hasMany('App\LoaiTin','idTheLoai','id');
    }
    public function tintuc(){
        return $this->hasManyThrough('App\TinTuc','App\LoaiTin','idTheLoai','idLoaiTin','id');
    }
}
