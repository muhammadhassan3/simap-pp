<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    protected $table = 'customer';
    protected $fillable = [
        'no_identitas',
        'nama_customer',
        'alamat',
        'no_hp',
        'email',
    ];
    public function marketings()
    {
        return $this->hasMany(Marketing::class);
    }

    public function penjualan()
    {
        return $this->hasMany(Penjualan::class, 'id_customer');
    }
}
