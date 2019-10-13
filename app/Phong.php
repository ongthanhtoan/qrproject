<?php

namespace App;
use DB;
use Illuminate\Database\Eloquent\Model;

class Phong extends Model {
    public    $timestamps   = false;

    protected $table        = 'phong';
    protected $fillable     = [];
    protected $guarded      = [];

    protected $primaryKey   = 'p_MaPhong';
    public    $incrementing = false;
    public function getTenById($ID) {
        $data = DB::table('phong')->where('p_MaPhong',$ID)->get();
        return $data;
    }
}