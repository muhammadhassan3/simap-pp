<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TempatProyekModel extends Model
{
    use HasFactory;
    protected $table = "tempat_proyek";

    protected $fillable =
        [
            'nama',
            'alamat',
        ];

}
