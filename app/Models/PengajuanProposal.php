<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PengajuanProposal extends Model
{
    use HasFactory;

    protected $table = 'pengajuan_proposal';
    public $timestamps = false;
    protected $fillable = [
        'id_tempat_proyek',
        'nama_proyek',
        'tanggal_pengajuan',
        'keterangan',
        'id',
        'file_proposal',
        'harga',
        'status_proposal'
    ];

    public function proyekDisetujui()
    {
        return $this->hasOne(ProyekDisetujui::class, 'id_pengajuan_proposal');
    }

    public function tempatProyek()
    {
        return $this->belongsTo(TempatProyek::class, 'id_tempat_proyek');
    }
}
