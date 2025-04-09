<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class p_barang extends Model
{
    use HasFactory;

    protected $table = 'p_barangs';
    protected $fillable = [
        'code_peminjaman',
        'nama_pengembali',
        'tanggal_pengembalian',
        'keterangan'
    ];

    public function peminjaman_details()
    {
        return $this->hasMany(peminjaman_detail::class, 'id_pm_barang');
    }
}
