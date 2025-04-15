<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class p_ruangan extends Model
{
    use HasFactory;

    protected $table = 'p_ruangans';
    protected $fillable = [
        'id_pm_ruangan', // Menghubungkan ke peminjaman ruangan
        'nama_pengembali', // Menghubungkan ke pengguna yang mengembalikan
        'tanggal_selesai', // Tanggal selesai pengembalian
        'keterangan', // Keterangan pengembalian
    ];

    public function PeminjamanDetailRuangan()
    {
        return $this->hasMany( PeminjamanDetailRuangan::class, 'id_pm_ruangan');
    }

    public function pm_ruangan()
    {
        return $this->belongsTo(pm_ruangan::class, 'id_pm_ruangan', 'id');
    }
}
