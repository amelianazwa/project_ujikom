<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    use HasFactory;
    protected $fillable = ['id','code_barang','nama_barang','merk','id_kategori','detail','jumlah'];
    public $timestamps = true;

    public function Kategori()
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
}
