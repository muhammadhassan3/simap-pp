<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PengajuanProposal extends Model
{
    use HasFactory;

    protected $table = 'pengajuan_proposal';
    public $timestamps = false;
    protected $primaryKey = 'id';
    protected $fillable = [
        'id_tempat_proyek',
        'file_proposal',
        'nama_proyek',
        'harga',
        'tanggal_pengajuan',
        'keterangan',
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

    // Alias for tempatProyek to support snake_case usage in controller
    public function tempat_proyek()
    {
        return $this->tempatProyek();
    }
}
