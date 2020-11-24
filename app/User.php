<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Cache;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public $primaryKey = 'id_petugas';
    protected $fillable = [
        'nama_petugas', 'username', 'password', 'role', 'avatar', 'remember_token', 'telp'
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
