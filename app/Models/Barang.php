<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    use HasFactory;

    protected $fillable = ['id', 'code_barang', 'nama_barang', 'merk', 'id_kategori', 'detail', 'jumlah'];
    public $timestamps = true;

    // Relasi ke tabel kategori
    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'id_kategori');
    }

    // Relasi ke model lain (jika memang ada)
    public function m_Barang()
    {
        return $this->hasMany(m_Barang::class, 'id_barang');
    }

    public function detail_ruangan()
    {
        return $this->hasMany(Deteail_ruangan::class, 'id_barang');
    }

    // Relasi ke peminjaman detail
    public function peminjaman_details()
    {
        return $this->hasMany(Peminjaman_detail::class, 'id_barang');
    }

    // Relasi ke tabel pengembalian barang
    public function pengembalian()
    {
        return $this->hasManyThrough(
            p_barang::class, // Model tujuan (pengembalian)
            peminjaman_detail::class, // Model perantara (detail peminjaman)
            'id_barang', // Kunci di peminjaman_detail yang menghubungkan ke barang
            'code_peminjaman', // Kunci di p_barang yang menghubungkan ke peminjaman
            'id', // Kunci di barang
            'id_pm_barang' // Kunci di peminjaman_detail
        );
    }

    // Accessor untuk mendapatkan status barang (Dipinjam / Tersedia)
    public function getStatusAttribute()
    {
        $isDipinjam = $this->peminjaman_details()->whereHas('pm_barang', function ($query) {
            $query->whereNotIn('code_peminjaman', function ($subQuery) {
                $subQuery->select('code_peminjaman')->from('p_barangs'); // Cek apakah barang sudah dikembalikan
            });
        })->exists();

        return $isDipinjam ? 'Dipinjam' : 'Tersedia';
    }
}
