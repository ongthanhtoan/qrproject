<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Phong extends Model {
    public    $timestamps   = false;

    protected $table        = 'phong';
    protected $fillable     = [];
    protected $guarded      = [];

    protected $primaryKey   = 'p_MaPhong';
    public    $incrementing = false;
}