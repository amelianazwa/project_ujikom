<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Detail_ruangan extends Model
{
    use HasFactory;
    protected $fillable = ['id','code_maintenance','id_barang','id_ruangan','kondisi','keterangan','jumlah'];
    public $timestamps = true;

    public function barang()
    {
        return $this->belongsTo(Barang::class, 'id_barang');
    }
    public function ruangan()
    {
        return $this->belongsTo(Ruangan::class, 'id_ruangan');
    }
}
