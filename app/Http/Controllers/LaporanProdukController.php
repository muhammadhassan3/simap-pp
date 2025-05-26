<?php

namespace App\Http\Controllers;

use App\Models\DetailPenjualan;
use Illuminate\Http\Request;


class LaporanProdukController
{
    public function show()
    {
        $detailpenjualan = DetailPenjualan::with(['penjualan.customer', 'produk'])->get()->map(function ($item) {
                return ['tanggal' => $item->penjualan->tanggal_penjualan, 'customer' => $item->penjualan->customer->nama_customer, 'produk' => $item->produk->nama, 'qty' => $item->qty, 'harga' => $item->harga_satuan, 'total' => $item->total_harga, 'jenis_pembayaran' => $item->penjualan->jenis_pembayaran];
            });

        $totalKeseluruhan = $detailpenjualan->sum('total');

        return view('laporan.lappenproduk', compact('detailpenjualan', 'totalKeseluruhan'));
    }

    public function convert(Request $request)
    {
        $startDate = $request->query('tgl_mulai');
        $endDate = $request->query('tgl_selesai');

        $filteredData = DetailPenjualan::with(['penjualan.customer', 'produk'])->whereHas('penjualan', function ($query) use ($startDate, $endDate) {
                $query->whereBetween('tanggal_penjualan', [$startDate, $endDate]);
            })->get()->map(function ($item) {
                return ['tanggal' => $item->penjualan->tanggal_penjualan, 'customer' => $item->penjualan->customer->nama_customer, 'produk' => $item->produk->nama_produk, 'qty' => $item->qty, 'harga' => $item->harga_satuan, 'total' => $item->total_harga, 'jenis_pembayaran' => $item->penjualan->jenis_pembayaran];
            });

        if ($filteredData->isEmpty()) {
            return response()->json(["message" => "Tidak ada data dalam tanggal tersebut"], 404);
        }

        $templateProcessor = new \PhpOffice\PhpWord\TemplateProcessor('template_laporan.docx');
        $values = [];
        $totalKeseluruhan = 0;

        foreach ($filteredData as $index => $data) {
            $totalKeseluruhan += $data['total'];
            $values[] = ['no' => $index + 1, 'tanggal' => $data['tanggal'], 'customer' => $data['customer'], 'produk' => $data['produk'], 'qty' => $data['qty'], 'harga' => number_format($data['harga'], 0, ',', '.'), 'total' => number_format($data['total'], 0, ',', '.'), 'jenis_pembayaran' => $data['jenis_pembayaran']];
        }

        $templateProcessor->cloneRowAndSetValues('no', $values);
        $templateProcessor->setValue('total_keseluruhan', number_format($totalKeseluruhan, 0, ',', '.'));

        $fileName = 'Laporan_Filtered.docx';
        $templateProcessor->saveAs($fileName);

        return response()->download($fileName)->deleteFileAfterSend(true);
    }
}
