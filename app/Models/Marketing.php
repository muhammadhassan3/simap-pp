<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Marketing extends Model
{
    protected $table = 'marketing';
    protected $fillable = [
        'produk_id',
        'customer_id',
        'tujuan_pembelian',
        'jenis_pembayaran',
        'keterangan_pembayaran',
        'tanggal_pembelian',
    ];
    // Relasi ke Produk
    public function produk()
    {
        return $this->belongsTo(Produk::class, 'produk_id');
    }

    // Relasi ke Customer
    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id');
    }
}
