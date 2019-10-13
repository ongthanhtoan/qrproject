<?php

namespace App;
use DB;
use Illuminate\Database\Eloquent\Model;

class Donvi extends Model {
    public    $timestamps   = false;

    protected $table        = 'donvi';
    protected $fillable     = ['dv_TenDV'];
    protected $primaryKey   = 'dv_MaDV';
    public    $incrementing = false;
    public function taiSans()
    {
        return $this -> hasMany('App\TaiSan','dv_MaDV','dv_MaDV');
    }
    public function getTenById($ID) {
        $data = DB::table('donvi')->where('dv_MaDV',$ID)->get();
        return $data;
    }
}