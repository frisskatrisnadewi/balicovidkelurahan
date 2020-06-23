<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kabupaten extends Model
{
    protected $table = 'tb_kabupaten';
    protected $fillable = ['id_kab', 'nama_kab'];
    public $timestamps = false;
}
