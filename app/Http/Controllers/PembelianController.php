<?php

namespace App\Http\Controllers;

use App\Models\DetailPembelianModel;
use App\Models\PembeliansModel;
use App\Models\ProyekDisetujuiModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PembelianController extends Controller
{
    public function tampil()
    {
        $pembelian = PembeliansModel::with('proyekDisetujui.pengajuanProposal')
            ->orderBy('id', 'DESC')
            ->get();
        return view('pembelian.tampil', compact('pembelian'));
    }

    public function tambah()
    {
        $proyekDisetujui = ProyekDisetujuiModel::with('pengajuanProposal')->get();
        //        dd($proyekDisetujui);
        return view('pembelian.tambah', compact('proyekDisetujui'));
    }

    public function simpan(Request $request)
    {
        $filePath = "";
        if ($request->hasFile('foto_nota')) {
            echo "ada";
            $foto_nota = $request->file('foto_nota');
            $filePath = Storage::disk("public")->put("nota_pembelian", $foto_nota);
        }


        $pembelian = new PembeliansModel();
        $pembelian->tanggal = $request->tanggal;
        $pembelian->no_nota = $request->no_nota;
        $pembelian->foto_nota = $filePath; // Perbaikan di sini
        $pembelian->id_proyek_disetujui = $request->id_proyek_disetujui;
        $pembelian->save();

        //Simpan Detail Pembelian
        for ($i = 0; $i < sizeof($request->nama_produk); $i++) {
            $detailPembelian = new DetailPembelianModel();
            $detailPembelian->id_pembelian = $pembelian->id;
            $detailPembelian->nama_produk = $request->nama_produk[$i];
            $detailPembelian->qty = $request->qty[$i];
            $detailPembelian->satuan = $request->satuan[$i];
            $detailPembelian->harga_satuan = $request->harga_satuan[$i];
            $detailPembelian->total_harga = $request->total_harga[$i];
            $detailPembelian->save();
        }

        return redirect()->route('pembelian.tampil')->with('success', 'Data pembelian berhasil ditambahkan.');

        // Simpan foto nota
        // $path = $request->file('foto_nota')->store('foto_nota', 'public');

    }

    public function edit($id)
    {
        $detail = DetailPembelianModel::findOrFail($id);
        return view('pembelian.editdetail', compact('detail'));

        // $pembelian = PembeliansModel::find($id);
        // $proyekDisetujui = ProyekDisetujuiModel::with('pengajuanProposal')->get();
        // return view('pembelian.edit', compact('pembelian', 'proyekDisetujui'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_produk' => 'required|string|max:255',
            'satuan' => 'required|string|max:50',
            'qty' => 'required|integer|min:0',
            'harga_satuan' => 'required|numeric',
        ]);
        $detailPembelian = DetailPembelianModel::findOrFail($id);
        $detailPembelian->nama_produk = $request->nama_produk;
        $detailPembelian->satuan = $request->satuan;
        $detailPembelian->qty = $request->qty;
        $detailPembelian->harga_satuan = str_replace('.', '', $request->harga_satuan); // Menghapus titik untuk format angka
        $detailPembelian->total_harga = $detailPembelian->qty * $detailPembelian->harga_satuan; // Menghitung total harga
        $detailPembelian->save();
        return redirect()->route('pembelian.detail', $detailPembelian->id_pembelian)
            ->with('success', 'Detail pembelian berhasil diperbarui.');

        // $pembelian = PembeliansModel::find($id);
        // $pembelian->tanggal = $request->tanggal;
        // $pembelian->no_nota = $request->no_nota;
        // $pembelian->foto_nota = $request->foto_nota;
        // $pembelian->nama_proyek = $request->nama_proyek;
        // $pembelian->update();

        // return redirect()->route('pembelian.tampil')->with('success', 'Data pembelian berhasil ditambahkan.');
    }

    public function delete($id)
    {
        $pembelian = PembeliansModel::find($id);
        $pembelian->delete();

        return redirect()->route('pembelian.tampil')->with('success', 'Data berhasil dihapus.');
    }

    public function detail($id)
    {
        $pembelian = PembeliansModel::where("id", $id)->first();
        $detailPembelian = DetailPembelianModel::where("id_pembelian", $id)->get();

        return view('pembelian.detail', ['pembelian' => $pembelian, 'detailPembelian' => $detailPembelian]);
    }
}
