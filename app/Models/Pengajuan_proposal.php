<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pengajuan_proposal extends Model
{
    use HasFactory;
    protected $table = 'pengajuan_proposal';
    protected $fillable = ['id_tempat_proyek', 'nama_proyek', 'tanggal_pengajuan', 'keterangan'];
}
