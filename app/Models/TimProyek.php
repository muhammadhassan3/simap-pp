<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TimProyek extends Model
{
    use HasFactory;

    protected $table = 'tim_proyek';
    protected $fillable = [
        'id_proyek_disetujui',
        'peran',
        'id_pekerja',
        'keahlian'
    ];

    public function proyekDisetujui()
    {
        return $this->belongsTo(ProyekDisetujui::class, 'id_proyek_disetujui');
    }

    public function pekerja()
    {
        return $this->belongsTo(Pekerja::class, 'id_pekerja');
    }
}
