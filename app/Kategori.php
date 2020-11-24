<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    public $primaryKey = 'id_kategori';
    protected $table = 'kategoris';
    protected $fillable = [
        'nama_kategori'
    ]; 
}
