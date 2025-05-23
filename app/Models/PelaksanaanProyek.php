<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PelaksanaanProyek extends Model
{
    protected $table = 'pelaksanaan';

    protected $fillable = [
        'id',
        'id_penjadwalan',
        'tanggal_pelaksanaan',
        'nama_pelaksanaan',
        'foto',
        'keterangan',
    ];

    public function PenjadwalanProyek(): BelongsTo
    {
        return $this->belongsTo(Penjadwalan::class, 'id_penjadwalan');
    }
}
