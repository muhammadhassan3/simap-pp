<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class MonitoringProyek extends Model
{
    use HasFactory;

    protected $table = 'monitoring_proyek';
    protected $fillable = ['id_proyek_disetujui', 'status_review'];

    // Relasi ke tabel Penjadwalan
    public function penjadwalan()
    {
        return $this->hasMany(Penjadwalan::class, 'id_proyek_disetujui', 'id_proyek_disetujui');
    }

    // Relasi ke tabel TimProyek
    public function timProyek()
    {
        return $this->hasMany(TimProyek::class, 'id_proyek_disetujui', 'id_proyek_disetujui');
    }

    public function Proyek_disetujui()
    {
        return $this->belongsTo(Proyek_disetujui::class, 'id_proyek_disetujui');
    }
}
