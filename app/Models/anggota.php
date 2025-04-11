<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Anggota extends Model
{
    use HasFactory;
    protected $fillable = ['id', 'nim', 'nama_peminjam', 'email', 'no_telepon', 'instansi_lembaga'];
    public $timestamps = true;

    public function pm_barang()
    {
        return $this->hasMany(pm_barang::class, 'id_anggota');
    }

    public function pm_ruangan()
    {
        return $this->hasMany(pm_ruangan::class, 'id_anggota');
    }
}
