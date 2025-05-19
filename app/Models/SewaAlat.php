<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SewaAlat extends Model
{
    use HasFactory;

    protected $table = 'sewa_alat'; // Pastikan nama tabel sesuai
    protected $fillable = [
        'nama_alat',
        'harga_sewa',
        'customer_id',
        'durasi',
        'qty',
        'id_proyek',
        'detail',
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id');
    }

    public function tempatProyek()
    {
        return $this->belongsTo(TempatProyek::class, 'id_proyek', 'id');
    }


}