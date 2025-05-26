<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DetailPembelian extends Model
{
    protected $table = "detail_pembelian";
    protected $fillable = ['nama_barang', 'satuan', 'qty', 'id_pembelian', 'harga_satuan','total_harga'];

    public function pembelian()
    {
        return $this->belongsTo(Pembelian::class, 'id_pembelian', 'id');
    }
}
