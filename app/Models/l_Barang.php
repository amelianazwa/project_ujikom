<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class l_Barang extends Model
{
    use HasFactory;
    protected $fillable = ['id','id_pm_barang','id_kondisi','keterangan','cover'];
    public $timestamps = true;


    public function pm_barang()
    {
        return $this->belongsTo(pm_barang::class, 'id_pm_barang');
    }
    public function kondisi()
    {
        return $this->belongsTo(Kondisi::class, 'id_kondisi');
    }

    public function deleteImage(){
        if($this->cover && file_exists(public_path('images/l_barang' . $this->cover))){
            return unlink(public_path('images/l_barang' . $this->cover));
        }
    }
}
