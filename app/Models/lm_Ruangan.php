<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class lm_Ruangan extends Model
{
    use HasFactory;
    protected $fillable = ['id','id_m_ruangan','keterangan'];
    public $timestamps = true;

    public function m_ruangan()
    {
        return $this->belongsTo(m_ruangan::class, 'id_m_ruangan');
    }
}
