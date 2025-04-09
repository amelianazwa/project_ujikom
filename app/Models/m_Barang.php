<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class m_Barang extends Model
{
    use HasFactory;
    protected $fillable = ['id','id_barang','id_ruangan','posisi','jenis_perbaikan','waktu_pengerjaan','id_kondisi'];
    public $timestamps = true;

    public function barang()
    {
        return $this->belongsTo(Barang::class, 'id_barang');
    }
    public function ruangan()
    {
        return $this->belongsTo(Ruangan::class, 'id_ruangan');
    }
    public function kondisi()
    {
        return $this->belongsTo(Kondisi::class, 'id_kondisi');
    }

    public function lm_Barang()
    {
        return $this->hasMany(lm_barang::class, 'id_m_barang');
    }
}
