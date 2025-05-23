<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penjualan extends Model
{
    use HasFactory;

    protected $table = 'penjualan';

    protected $fillable = [
        'id_customer',
        'tanggal_penjualan',
        'jenis_pembayaran',
        'total_harga',
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'id_customer');
    }

   public function detailPenjualan()
{
    return $this->hasMany(DetailPenjualan::class, 'id_penjualan');
}

}
