<?php

namespace App\Http\Controllers;

use App\Models\DetailPembelian;
use App\Models\Pembelian;
use App\Models\Penyewaan;
use App\Models\SewaAlat;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use PhpOffice\PhpWord\TemplateProcessor;

class LaporanDetail extends Controller
{
    public function detail($id)
    {
        // sewa alat
        $penyewaan = SewaAlat::with('tempatProyek.pengajuanProposal')
            ->where('id_proyek', $id)
            ->get();

        // pembelian + detail + total harga per pembelian
        $pembelian = Pembelian::with(['detail_pembelians', 'proyek_disetujui.pengajuanProposal.tempatProyek'])
            ->withSum('detail_pembelians as total_pembelian', 'total_harga')
            ->where('id_proyek_disetujui', $id)
            ->get();


        return view('recap_proyek.detail', [
            'penyewaan'          => $penyewaan,
            'pembelian'          => $pembelian,
            'id_proyek'          => $id,
        ]);
    }


    function convert($id)
    {
        $phpWord = new TemplateProcessor('template_laporan.docx');

        // Ambil semua pembelian terkait proyek
        $pembelianList = Pembelian::where('id_proyek_disetujui', $id)->get();

        $values = [];
        $no = 1; // nomor urut untuk cloneRow

        $totalKeseluruhan = 0;

        foreach ($pembelianList as $pembelian) {
            foreach ($pembelian->detail_pembelians as $detail) {
                $values[] = [
                    'no' => $no++,
                    'tanggal' => $pembelian->tanggal ?? '',
                    'customer' => $pembelian->proyek_disetujui->pengajuanProposal->tempatProyek->customer->nama_customer ?? '',
                    'produk' => $detail->nama_produk,
                    'qty' => $detail->qty,
                    'harga' => number_format($detail->harga, 2, ',', '.'),
                    'total' => number_format($detail->total_harga, 2, ',', '.'),
                    'no_nota' => $pembelian->no_nota ?? '',
                ];

                $totalKeseluruhan += $detail->total_harga;
            }
        }

        if (count($values) > 0) {
            $phpWord->cloneRowAndSetValues('no', $values);
        } else {
            $phpWord->setValue('no', '');
            $phpWord->setValue('tanggal', '');
            $phpWord->setValue('customer', '');
            $phpWord->setValue('produk', '');
            $phpWord->setValue('qty', '');
            $phpWord->setValue('harga', '');
            $phpWord->setValue('total', '');
            $phpWord->setValue('jenis_pembayaran', '');
        }

        $phpWord->setValue('total_keseluruhan', number_format($totalKeseluruhan, 2, ',', '.'));

        $phpWord->saveAs('Laporan.docx');

        $content = file_get_contents('Laporan.docx');

        return response($content, 200, [
            'Content-Type' => 'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
            'Content-Disposition' => 'inline; filename=Laporan.docx',
        ]);
    }
}
