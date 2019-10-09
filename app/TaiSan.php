<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Taisan extends Model {
    public    $timestamps   = false;

    protected $table        = 'taisan';
    protected $fillable     = [];
    protected $guarded      = [];

    protected $primaryKey   = 'ts_MaTS';
    public    $incrementing = false;
}