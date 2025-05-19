<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EvaluasiProyek extends Model
{
    use HasFactory;

    protected $table = 'evaluasi_proyek';
    protected $fillable = ['id_proyek_disetujui', 'keterangan'];

    public function proyekDisetujui()
    {
        return $this->belongsTo(ProyekDisetujui::class, 'id_proyek_disetujui');
    }
}
