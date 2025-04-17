<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class p_barang extends Model
{
    use HasFactory;

    protected $table = 'p_barangs';
    protected $fillable = [
        'id_pm_barang', 
        'nama_pengembali', 
        'tanggal_selesai', 
        'keterangan', 
    ];

    public function peminjaman_details()
    {
        return $this->hasMany( peminjaman_detail::class, 'id_pm_barang');
    }

    public function pm_barang()
    {
        return $this->belongsTo(pm_barang::class, 'id_pm_barang', 'id');
    }
}