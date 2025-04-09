<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class l_Ruangan extends Model
{
    use HasFactory;
    protected $fillable = ['id','id_pm_ruangan','keterangan','cover'];
    public $timestamps = true;


    public function pm_ruangan()
    {
        return $this->belongsTo(pm_ruangan::class, 'id_pm_ruangan');
    }

    public function deleteImage(){
        if($this->cover && file_exists(public_path('images/l_ruangan' . $this->cover))){
            return unlink(public_path('images/l_ruangan' . $this->cover));
        }
    }
}
