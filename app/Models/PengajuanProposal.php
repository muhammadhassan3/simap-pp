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
        'file', 
        'id_tempat_proyek', 
        'tanggal_pengajuan', 
        'nama_proyek', 
        'keterangan'
    ];

    public function proyekDisetujui()
    {
        return $this->hasOne(ProyekDisetujui::class, 'id_pengajuan_proposal');
    }
}
