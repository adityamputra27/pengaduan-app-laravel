<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Masyarakat extends Authenticatable
{
    use Notifiable;

    protected $guard = 'masyarakats';
    public $primaryKey = 'id';
    protected $fillable = [
        'nik', 'avatar', 'nama_lengkap', 'username', 'password', 'telp'
    ];

    protected $hidden = [
        'password',
    ];
}
