<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PembeliansModel extends Model
{
    use HasFactory;

    protected $table = 'pembelian';

    protected $fillable = [
        'tanggal',
        'no_nota',
        'foto_nota',
        'id_proyek_disetujui',
    ];

    public function proyekDisetujui()
    {
        return $this->belongsTo(ProyekDisetujui::class, 'id_proyek_disetujui', "id");
    }

    public function detail()
    {
        return $this->belongsTo(ProyekDisetujui::class, 'id_pengajuan_proposal');
    }
}
