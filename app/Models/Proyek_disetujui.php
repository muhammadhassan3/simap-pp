<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Proyek_disetujui extends Model
{
    //
    protected $table = 'proyek_disetujui';
    protected $fillable = ['id_pengajuan_proposal', 'tanggal_mulai', 'tanggal_selesai', 'status'];

    public function Monitoring_proyek()
    {
        return $this->hasMany(MonitoringProyek::class, 'id_proyek_disetujui');
    }

    public function pengajuanProposal()
    {
        return $this->belongsTo(Pengajuan_proposal::class, 'id_pengajuan_proposal');
    }
}
