<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PengajuanDana extends Model
{
    protected $table = 'pengajuandana';

    public function pengajuandetail()
    {
        return $this->hasMany('App\PengajuanDanaDetail', 'nomor', 'nomor');
    }
}
