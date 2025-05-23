<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    use HasFactory;

    protected $table = 'produk';
    protected $fillable = ['nama', 'harga', 'foto', 'deskripsi', 'satuan'];

    public function marketings()
    {
        return $this->hasMany(Marketing::class);
    }
    public function getFotoUrlAttribute()
    {
        return $this->foto ? asset('storage/' . $this->foto) : asset('storage/default.png');
    }
    protected $casts = [
        'harga' => 'float', // Pastikan harga selalu angka
    ];
}
