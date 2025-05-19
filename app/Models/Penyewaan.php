<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Penyewaan extends Model
{
    protected $table = "sewa_alat";
    protected $fillable = ['nama_alat', 'total_harga_sewa', 'no.hp', 'durasi', 'qty', 'id_proyek_disetujui'];

    public function proyek_disetujui(){
        return $this->hasOne (ProyekDisetujui::class,'id','id_proyek_disetujui');
    }

}
