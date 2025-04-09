<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class pm_Barang extends Model
{
    use HasFactory;
    protected $fillable = ['id','code_peminjaman','id_anggota','jenis_kegiatan','id_barang','jumlah_pinjam','id_ruangan','tanggal_peminjaman','waktu_peminjaman','cover'];
    public $timestamps = true;

    public function barang()
    {
        return $this->belongsTo(Barang::class, 'id_barang');

    }
    public function ruangan()
    {
        return $this->belongsTo(Ruangan::class, 'id_ruangan');
    }

    public function anggota()
    {
        return $this->belongsTo(anggota::class, 'id_anggota');
    }

    public function l_barang()
    {
        return $this->hasMany(l_barang::class, 'id_pm_barang');
    }
    public function peminjaman_details()
    {
        return $this->hasMany( peminjaman_detail::class, 'id_pm_barang');
    }
    

    public static function generateUniqueCode()
    {
        do {
            $randomNumber = mt_rand(1000, 9999);
            $code = 'PM-' . date('Ymd') . '-' . $randomNumber;
        } while (self::where('code_peminjaman', $code)->exists());

        return $code;
    }


}
