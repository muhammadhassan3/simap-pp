<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DokumenPenyelesaianProyek extends Model
{
    use HasFactory;

    protected $table = 'dokumen_penyelesaian_proyek';
    protected $fillable = ['id_proyek_disetujui', 'file', 'keterangan'];

    public function proyekDisetujui()
    {
        return $this->belongsTo(ProyekDisetujui::class, 'id_proyek_disetujui');
    }
}

