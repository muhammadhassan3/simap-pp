<?php

namespace App\Http\Controllers;

use App\Models\Penjualan;

class DetailPenjualanController extends Controller
{
    public function show($id, $detail_id)
    {
        // untuk ambil data berdasarkan id penjualan dan detail
        $penjualan = Penjualan::findOrFail($id);
        $detail = $penjualan->detailPenjualan()->findOrFail($detail_id);

        // untuk menampilkan detail
        return view('detail_penjualan.show', compact('penjualan', 'detail'));
    }


}
