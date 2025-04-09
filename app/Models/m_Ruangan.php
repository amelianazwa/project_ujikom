<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class m_Ruangan extends Model
{
    use HasFactory;
    protected $fillable = ['id','id_ruangan','jenis_perbaikan','waktu_pengerjaan','id_kondisi'];
    public $timestamps = true;

    public function ruangan()
    {
        return $this->belongsTo(Ruangan::class, 'id_ruangan');
    }
    public function kondisi()
    {
        return $this->belongsTo(Kondisi::class, 'id_kondisi');
    }
}
