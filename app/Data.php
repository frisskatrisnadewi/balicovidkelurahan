<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Data extends Model
{
    protected $table = 'tb_data_covid';
    protected $fillable = ['id_data2', 'id_kab', 'id_kec','id_kel', 'level', 'ppln','ppdn', 'tl','lainnya','tanggal', 'rawat', 'sembuh', 'meninggal', 'positif'];
    public $timestamps = false;

}

