<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class KategoriProyek extends Model
{
    use HasFactory;
    
    protected $table = 'kategori_proyek';
    protected $fillable = ['id', 'nama', 'keterangan'];

    public function tempatProyek()
    {
        return $this->hasMany(TempatProyek::class, 'id_kategori_proyek');
    }
}
