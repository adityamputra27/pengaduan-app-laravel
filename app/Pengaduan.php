<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pengaduan extends Model
{
    use SoftDeletes;
    protected $table = 'pengaduans';
    public $primaryKey = 'id';
    protected $fillable = [
        'id_pengaduan', 'id_kategori', 'tgl_pengaduan', 'nik', 'isi_laporan', 'foto', 'status'
    ];
    public function kategori_aduan()
    {
        return $this->hasOne('App\Kategori', 'id_kategori', 'id_kategori');
    }
    public function masyarakat()
    {
        return $this->belongsTo('App\Masyarakat', 'nik', 'nik');
    }
    public function tanggapan()
    {
        return $this->hasOne('App\Tanggapan', 'id_pengaduan', 'id_pengaduan');
    }
    public function petugas()
    {
        return $this->belongsTo(Petugas::class, 'id_petugas', 'id');
    }
}
