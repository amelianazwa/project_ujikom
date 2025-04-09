<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class peminjaman_detail extends Model
{
    use HasFactory;
     protected $table = 'peminjaman_details';
    protected $fillable = ['id_pm_barang', 'id_barang', 'jumlah_pinjam'];

  public function pm_barang()
    {
        return $this->belongsTo(pm_barang::class, 'id_pm_barang');
    }

    // Relasi ke barang
    public function barang()
    {
        return $this->belongsTo(Barang::class, 'id_barang');
    }
}
