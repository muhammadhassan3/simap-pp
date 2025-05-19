<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request; // Import Request jika diperlukan, tetapi tidak digunakan dalam contoh ini
use App\Http\Controllers\Controller; // Pastikan controller Anda meng-extend Controller
use App\Models\Pembelian;
use App\Models\ProyekDisetujui;

class LaporanProyekController
{
    public function show()
    {
        // Membuat array pembelian
        $pembelian = Pembelian::with('proyek_disetujui')->get();

        // $data = ProyekDisetujui::
        
        // Mengirimkan data pembelian ke view 'laporan'
        return view('laporan', ["pembelian" => $pembelian]);

        
    }

    function convert(){
            
    }
}

