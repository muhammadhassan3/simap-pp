<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ProyekDisetujui extends Model
{
    use HasFactory;

    protected $table = 'proyek_disetujui';
    protected $fillable = [
        'id_pengajuan_proposal',
        'status',
        'tanggal_mulai',
        'tanggal_selesai'
    ];

    public function pengajuanProposal()
    {
        return $this->belongsTo(PengajuanProposal::class, 'id_pengajuan_proposal', 'id');
    }

    public function evaluasiProyek()
    {
        return $this->belongsTo(EvaluasiProyek::class, 'id_pengajuan_proposal', 'id');
    }

    // Alias for pengajuanProposal to support snake_case usage in controller
    public function pengajuan_proposal()
    {
        return $this->pengajuanProposal();
    }

    public function timProyek()
    {
        return $this->hasMany(TimProyek::class, 'id_project_disetujui');
    }

    public function Monitoring_proyek()
    {
        return $this->hasOne(MonitoringProyek::class, 'id_proyek_disetujui');
    }
    
    // Add alias for case sensitivity issues
    public function monitoringProyek()
    {
        return $this->Monitoring_proyek();
    }

    public function Penjadwalan(): HasMany
    {
        return $this->hasMany(Penjadwalan::class, 'id_proyek_disetujui');
    }
    public function dokumenPenyelesaian()
    {
        return $this->hasMany(DokumenPenyelesaianProyek::class, 'id_proyek_disetujui');
    }
}
