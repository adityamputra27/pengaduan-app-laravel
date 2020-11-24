<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Cache;

class Petugas extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guard = 'petugas';
    public $primaryKey = 'id';
    protected $fillable = [
        'nama_petugas', 'username', 'password', 'role', 'avatar', 'telp'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    public function getAvatar()
    {
        if (!$this->avatar) {
            return asset('assets/admin/uploads/avatar.png');
        }
        return asset('assets/admin/uploads/'.$this->avatar);
    }
    public function isOnline()
    {
        return Cache::has('user-is-online-' . $this->id);
    }
}
