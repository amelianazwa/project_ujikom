<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PeminjamanDetailRuangan extends Model
{
    use HasFactory;
    protected $fillable = ['id','id_pm_ruangan','id_ruangan'];
    public $timestamps = true;

    public function pm_ruangan()
    {
        return $this->belongsTo(pm_ruangan::class, 'id_pm_ruangan');
    }

    // Relasi ke ruangan
    public function ruangan()
    {
        return $this->belongsTo(ruangan::class, 'id_ruangan');
    }


}