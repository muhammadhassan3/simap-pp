<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TimProyek extends Model
{
    use HasFactory;

    protected $table = 'tim_project';
    protected $fillable = [
        'id_project_disetujui',
        'peran',
        'id_pekerja',
        'keahlian'
    ];

    public function proyekDisetujui()
    {
        return $this->belongsTo(ProyekDisetujui::class, 'id_project_disetujui');
    }

    public function pekerja()
    {
        return $this->belongsTo(Pekerja::class, 'id_pekerja');
    }
}
