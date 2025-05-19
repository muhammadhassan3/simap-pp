<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
        return $this->belongsTo(PengajuanProposal::class, 'id_pengajuan_proposal');
    }

    public function timProyek()
    {
        return $this->hasMany(TimProyek::class, 'id_proyek_disetujui');
    }
}
