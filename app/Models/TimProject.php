<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TimProject extends Model
{
    use HasFactory;

    protected $table = 'tim_project';
    protected $fillable = ['id_project_disetujui', 'id_pekerja', 'peran', 'keahlian'];

    public function proyek_disetujui(){
        return $this->belongsTo(ProyekDisetujui::class,'id_project_disetujui');
    }

    public function pekerja(){
       return $this->belongsTo(Pekerja::class,'id_pekerja');
    }

}

