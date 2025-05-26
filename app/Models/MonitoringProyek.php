<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class MonitoringProyek extends Model
{
    use HasFactory;

    protected $table = 'monitoring_proyek';
    protected $fillable = ['id_proyek_disetujui', 'id_penjadwalan', 'status', 'keterangan'];

    // Relasi ke tabel Penjadwalan
    public function penjadwalan()
    {
        return $this->hasMany(Penjadwalan::class, 'id_proyek_disetujui', 'id_proyek_disetujui');
    }

    // Relasi ke tabel TimProyek
    public function timProyek()
    {
        return $this->hasMany(TimProyek::class, 'id_project_disetujui', 'id_proyek_disetujui');
    }

    public function Proyek_disetujui()
    {
        return $this->belongsTo(ProyekDisetujui::class, 'id_proyek_disetujui');
        return $this->belongsTo(ProyekDisetujui::class, 'id_proyek_disetujui');
    }

    // Add alias for consistent naming
    public function proyekDisetujui()
    {
        return $this->Proyek_disetujui();
    }
}
