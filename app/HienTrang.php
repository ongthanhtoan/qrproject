<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Hientrang extends Model {
    public    $timestamps   = false;

    protected $table        = 'hientrang';
    protected $fillable     = [];
    protected $guarded      = [];

    protected $primaryKey   = 'ht_MaHT';
    public    $incrementing = false;
}