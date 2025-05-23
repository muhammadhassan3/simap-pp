<?php

namespace App\Http\Controllers;

use App\Models\DetailPembelian;
use App\Models\Pembelian;
use App\Models\Penyewaan;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use PhpOffice\PhpWord\TemplateProcessor;

class LaporanDetail extends Controller
{
   public function detail ($id){
    $penyewaan = Penyewaan::where('id_proyek_disetujui', $id)->get();
    $pembelian = Pembelian::where('id_proyek_disetujui', $id)->first();
    $detailPembelian = DetailPembelian::where("id_pembelian", $pembelian->id)->get();

    return view('detail', ["penyewaan" => $penyewaan,"pembelian" => $detailPembelian, "id_proyek" => $id]);
 
   }

   function convert($id){
    $phpWord = new TemplateProcessor('template_laporan.docx');

    $penyewaan = Penyewaan::where('id_proyek_disetujui', $id)->get();
    $pembelian = Pembelian::where('id_proyek_disetujui', $id)->first();
    $detailPembelian = DetailPembelian::where("id_pembelian", $pembelian->id)->get();

    // Set template values
    $phpWord->setValue('total', $pembelian->detail_pembelians->sum('total_harga'));

    $values = [];
    foreach ($detailPembelian as $index => $detail) {
        $values[$index] = [
            'no' => $index + 1,
            'nama_proyek' => $pembelian->proyek_disetujui->pengajuan_proposal->nama_proyek,
            'alamat' => $pembelian->proyek_disetujui->pengajuan_proposal->tempat_proyek->alamat,
            'tanggal' => $pembelian->tanggal,
            'nama_barang' => $detail->nama_barang,
            'total_harga' => $detail->total_harga,
            
        ];
    }
    $values2 = [];
    foreach ($penyewaan as $index => $sewa) {
        $values2[$index] = [
            'nomor' => $index + 1,
            'nama_proyek' => $sewa->proyek_disetujui->pengajuan_proposal->nama_proyek,
            'alamat' => $sewa->proyek_disetujui->pengajuan_proposal->tempat_proyek->alamat,
            'nama_alat' => $sewa->nama_alat,
            'total_harga_sewa' => $sewa->total_harga_sewa,
            
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
