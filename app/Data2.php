<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Data2 extends Model
{
    protected $table = 'tb_data_covid_2';
    protected $fillable = ['id_data2', 'id_kab', 'id_kec','id_kel', 'level', 'ppln','ppdn', 'tl','lainnya','tanggal', 'rawat', 'sembuh', 'meninggal', 'positif'];
    public $timestamps = false;
}
