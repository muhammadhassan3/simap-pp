<?php

namespace App\Http\Controllers;

use App\Models\SewaAlat;
use App\Models\Pembelian;
use App\Models\Penyewaan;
use App\Models\DetailPembelian;
use App\Models\ProyekDisetujui;
use Illuminate\Support\Facades\Log;
use PhpOffice\PhpWord\TemplateProcessor;
use App\Http\Controllers\Controller; // Pastikan controller Anda meng-extend Controller
use Illuminate\Http\Request; // Import Request jika diperlukan, tetapi tidak digunakan dalam contoh ini

class LaporanProyekController
{
    public function show(Request $request,)
    {
        // Membuat array pembelian
        $pembelian = Pembelian::with('proyek_disetujui')
            ->where('id_proyek_disetujui', $request['id_proyek'])
            ->get();

        // $data = ProyekDisetujui::

        return view('recap_proyek.laporan', ["pembelian" => $pembelian]);
    }

    function convert($id)
    {
        $phpWord = new TemplateProcessor('template_laporan_rizal.docx');

        $penyewaan = SewaAlat::where('id_proyek', $id)->get();
        $pembelian = Pembelian::where('id_proyek_disetujui', $id)->first();
        $detailPembelian = DetailPembelian::with([
            'pembelian.proyek_disetujui.pengajuanProposal.tempatProyek'
        ])
            ->whereHas('pembelian', fn($q) => $q->where('id_proyek_disetujui', $id))
            ->get();

        // Set template values
        $phpWord->setValue('total', $pembelian->detail_pembelians->sum('total_harga'));

        $values = [];
        foreach ($detailPembelian as $index => $detail) {
            $namaProduk = is_array(json_decode($detail->nama_produk, true))
                ? implode(', ', json_decode($detail->nama_produk, true))
                : $detail->nama_produk;

            $values[$index] = [
                'no' => $index + 1,
                'nama_proyek' => $detail->pembelian->proyek_disetujui->pengajuanProposal->nama_proyek,
                'alamat' => $detail->pembelian->proyek_disetujui->pengajuanProposal->tempatProyek->alamat,
                'tanggal' => $pembelian->tanggal,
                'nama_barang' => $namaProduk,
                'total_harga' => $detail->total_harga,
            ];
        }
        $values2 = [];
        foreach ($penyewaan as $index => $sewa) {
            $values2[$index] = [
                'nomor' => $index + 1,
                'nama_proyek' => $sewa->tempatProyek->nama_tempat,
                'alamat' => $sewa->tempatProyek->alamat,
                'nama_alat' => $sewa->nama_alat,
                'total_harga_sewa' => $sewa->qty * $sewa->harga_sewa,
            ];
        }

        $phpWord->cloneRowAndSetValues('no', $values);
        $phpWord->cloneRowAndSetValues('nomor', $values2);

        // Output ke browser
        $phpWord->saveAs('Laporan.docx');

        $content = file_get_contents('Laporan.docx');

        return response($content, 200, [
            'Content-Type' => 'application/docx',
            'Content-Disposition' => 'inline; filename=Laporan.docx',

        ]);
    }
}
