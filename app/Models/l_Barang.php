<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class l_Barang extends Model
{
    use HasFactory;
    protected $fillable = ['id','id_pm_barang','keterangan','cover'];
    public $timestamps = true;


    public function pm_barang()
    {
        return $this->belongsTo(pm_barang::class, 'id_pm_barang');
    }
    public function barang()
{
    return $this->hasOneThrough(Barang::class, peminjaman_detail::class, 'id_pm_barang', 'id', 'id_pm_barang', 'id_barang');
}
    
    public function deleteImage(){
        if($this->cover && file_exists(public_path('images/l_barang' . $this->cover))){
            return unlink(public_path('images/l_barang' . $this->cover));
        }
    }
}