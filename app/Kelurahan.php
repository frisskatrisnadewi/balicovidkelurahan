<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kelurahan extends Model
{
    protected $table = 'tb_kelurahan';
    protected $fillable = ['id_kel', 'id_kecamatan','kelurahan'];
    public $timestamps = false;
}
