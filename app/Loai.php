<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Loai extends Model {
	public    $timestamps   = false;

	protected $table        = 'loai';
	protected $fillable     = ['l_TenLoai','l_GhiChu'];
	protected $primaryKey   = 'l_MaLoai';
	public    $incrementing = false;
	public function taiSans()
	{
		return $this -> hasMany('App\TaiSan','l_MaLoai','l_MaLoai');
	}
}