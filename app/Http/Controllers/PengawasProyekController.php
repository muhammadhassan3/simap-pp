<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TimProyek;

class PengawasProyekController extends Controller
{
    public function index(Request $request)
    {
        if($request->has('search')){
            $searchTerm = $request['search'];
            $data = TimProyek::with(['proyekDisetujui'])
                ->where('peran', 'Pengawas')
                ->whereHas('proyekDisetujui.pengajuanProposal', function ($query) use ($searchTerm) {
                    $query->where('nama_proyek', 'like', "%$searchTerm%");
                })
                ->get()
                ->map(function ($tim) {
                    return [
                        'id' => $tim->id, // Tambahkan ID agar bisa digunakan di Blade
                        'nama_proyek' => $tim->proyekDisetujui->pengajuanProposal->nama_proyek ?? 'Tidak Ada',
                        'peran' => $tim->peran,
                        'nama_pekerja' => $tim->pekerja->nama ?? 'Tidak Ada',
                    ];
                });
        }else{
            $data = TimProyek::with(['proyekDisetujui'])
                ->where('peran', 'Pengawas') // Hanya mengambil pengawas
                ->get()
                ->map(function ($tim) {
                    return [
                        'id' => $tim->id, // Tambahkan ID agar bisa digunakan di Blade
                        'nama_proyek' => $tim->proyekDisetujui->pengajuanProposal->nama_proyek ?? 'Tidak Ada',
                        'peran' => $tim->peran,
                        'nama_pekerja' => $tim->pekerja->nama ?? 'Tidak Ada',
                    ];
                });
        }
        return view('pengawas_proyek.index', compact('data'));
    }

    public function edit($id)
    {
        // Cari data berdasarkan ID
        $pengawas = TimProyek::with(['proyekDisetujui', 'pekerja'])->findOrFail($id);

        return view('pengawas_proyek.edit', compact('pengawas'));
    }

    public function update(Request $request, $id)
    {
        // Validasi input
        $request->validate([
            'nama_proyek' => 'required|string|max:255',
            'peran' => 'required|string|max:100',
            'nama_pekerja' => 'required|string|max:255',
        ]);

        // Cari data pengawas berdasarkan ID
        $pengawas = TimProyek::with(['proyekDisetujui', 'pekerja'])->findOrFail($id);

        // Update peran
        $pengawas->peran = $request->peran;

        // Update nama proyek jika relasi proyekDisetujui dan pengajuanProposal ada
        if ($pengawas->proyekDisetujui && $pengawas->proyekDisetujui->pengajuanProposal) {
            $pengawas->proyekDisetujui->pengajuanProposal->nama_proyek = $request->nama_proyek;
            $pengawas->proyekDisetujui->pengajuanProposal->save();
        }

        // Cek apakah pekerja ada sebelum mengupdate nama_pekerja
        if ($pengawas->pekerja) {
            $pengawas->pekerja->nama = $request->nama_pekerja;
            $pengawas->pekerja->save(); // Simpan perubahan pekerja
        }

        $pengawas->save(); // Simpan perubahan pengawas

        // Redirect kembali ke halaman index dengan pesan sukses
        return redirect()->route('pengawas-proyek.index')->with('success', 'Data berhasil diperbarui.');
    }

}
