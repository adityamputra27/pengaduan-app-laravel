<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetailLaporanView extends Model
{
    protected $table = 'detail_aduans_view';
    public function kategori_aduan()
    {
        return $this->hasOne('App\Kategori', 'id_kategori', 'id_kategori');
    }
    public function masyarakat()
    {
        return $this->belongsTo('App\Masyarakat', 'nik', 'nik');
    }
    public function petugas()
    {
        return $this->belongsTo(Petugas::class, 'id_petugas', 'id');
    }
}
