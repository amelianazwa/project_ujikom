<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kondisi extends Model
{
    use HasFactory;
    protected $fillable = ['id', 'kondisi'];
    public $timestamps = true;

    public function barang()
    {
        return $this->hasMany(Barang::class, 'id_kondisi');
    }

    public function m_Barang()
    {
        return $this->hasMany(m_barang::class, 'id_kondisi');
    }
}
