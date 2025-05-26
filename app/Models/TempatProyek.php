<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;

class TempatProyek extends Model
{
    use HasFactory;

    protected $table = 'tempat_proyek';
    protected $fillable = ['nama_tempat', 'alamat', 'foto', 'id_kategori_proyek', 'id_customer'];

    public function kategoriProyek()
    {
        return $this->belongsTo(KategoriProyek::class, 'id_kategori_proyek');
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'id_customer');
    }

    public function pengajuanProposal()
    {
        return $this->hasMany(PengajuanProposal::class, 'id_tempat_proyek');
    }

    public function sewaAlat()
    {
        return $this->hasMany(sewaAlat::class, 'id', 'id_proyek');
    }
}
