<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pembelian extends Model
{
    protected $table = "pembelian";
    protected $fillable = ['no_nota', 'foto_nota', 'id_proyek_disetujui', 'kategori', 'tanggal'];

    public function detail_pembelians()
    {
        return $this->hasMany(DetailPembelian::class, 'id_pembelian', 'id');
    }

    public function proyek_disetujui()
    {
        return $this->belongsTo(ProyekDisetujui::class, 'id_proyek_disetujui', 'id');
    }

}
