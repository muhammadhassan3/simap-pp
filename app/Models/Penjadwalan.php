<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Penjadwalan extends Model
{
    use HasFactory;

    protected $table = 'penjadwalan';
    protected $fillable = ['id_proyek_disetujui', 'tanggal_mulai', 'tanggal_selesai', 'pekerjaan', 'status', 'keterangan', 'id_tim_project',];

    public function monitoringProyek()
    {
        return $this->belongsTo(MonitoringProyek::class, 'id_proyek_disetujui');
    }
    public function timProject()
    {
        return $this->belongsTo(TimProjectModel::class, 'id_tim_project');
    }
    public function proyekDisetujui()
    {
        return $this->belongsTo(ProyekDisetujuiModel::class, 'id_proyek_disetujui');
    }

    public function supervisor()
    {
        return $this->belongsTo(TimProjectModel::class, 'id_tim_project');
    }
}
