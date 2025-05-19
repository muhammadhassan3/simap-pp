<?php

namespace App\Listeners;

use App\Events\ProyekSelesai;
use App\Models\EvaluasiProyek;

class TambahEvaluasiProyek
{
    public function handle(ProyekSelesai $event)
    {
        // Cek apakah evaluasi sudah ada, jika belum, buat baru
        EvaluasiProyek::firstOrCreate([
            'id_proyek_disetujui' => $event->proyek->id
        ]);
    }
}
