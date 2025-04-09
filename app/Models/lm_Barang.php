<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class lm_Barang extends Model
{
    use HasFactory;
    protected $fillable = ['id','id_m_barang','keterangan'];
    public $timestamps = true;

    public function m_barang()
    {
        return $this->belongsTo(m_barang::class, 'id_m_barang');
    }
}
