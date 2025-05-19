<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pekerja extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $table = 'pekerja';
    protected $fillable = [
        'nama', 
        'no_hp'
    ];

    public function timProyek()
    {
        return $this->hasMany(TimProyek::class, 'id_pekerja');
    }
}
