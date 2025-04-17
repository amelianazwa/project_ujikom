<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    use HasFactory;

    protected $fillable = ['id', 'code_barang', 'nama_barang', 'merk', 'id_kategori', 'detail', 'jumlah'];
    public $timestamps = true;

    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'id_kategori');
    }

    public function m_Barang()
    {
        return $this->hasMany(m_Barang::class, 'id_barang');
    }

    public function detail_ruangan()
    {
        return $this->hasMany(Deteail_ruangan::class, 'id_barang');
    }
    public function peminjaman_details()
    {
        return $this->hasMany(Peminjaman_detail::class, 'id_barang');
    }

    public function pengembalian()
    {
        return $this->hasManyThrough(
            p_barang::class, 
            peminjaman_detail::class, 
            'id_barang', 
            'code_peminjaman',
            'id',
            'id_pm_barang' 
        );
    }

    public function getStatusAttribute()
    {
        $isDipinjam = $this->peminjaman_details()->whereHas('pm_barang', function ($query) {
            $query->whereNotIn('code_peminjaman', function ($subQuery) {
                $subQuery->select('code_peminjaman')->from('p_barangs'); 
            });
        })->exists();

        return $isDipinjam ? 'Dipinjam' : 'Tersedia';
    }
    public function p_barang()
    {
        return $this->hasMany(p_barang::class, 'id_barang');
    }
}
