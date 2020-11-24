<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tanggapan extends Model
{
    protected $table = 'tanggapans';
    protected $primaryKey = 'id_tanggapan';
    protected $fillable = [
    	'id_pengaduan', 'tgl_tanggapan','tanggapan','id_petugas'
    ];

    public function pengaduan()
    {
        return $this->belongsTo('App\Pengaduan', 'id_pengaduan', 'id_pengaduan');
    }

}
