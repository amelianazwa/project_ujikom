<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ruangan extends Model
{
    use HasFactory;
      protected $filLable = ['id', 'nama_ruangan','nama_pic','posisi_ruangan',];
    public $timestamps = true;

    public function barang()
    {
        return $this->hasMany(Barang::class, 'id_ruangan');
    }

    public function m_Barang()
    {
        return $this->hasMany(m_barang::class, 'id_ruangan');
    }

    public function pm_ruangan()
    {
        return $this->hasMany(pm_ruangan::class, 'id_ruangan');
    }
}

