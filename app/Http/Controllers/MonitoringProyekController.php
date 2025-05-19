<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\MonitoringProyek;
use App\Models\Penjadwalan;

class MonitoringProyekController extends Controller
{
    public function index(Request $request)
    {
        // Deklarasikan id_proyek_disetujui yang ingin diambil
        $idProyekDisetujui = 15; // Ganti dengan ID yang diinginkan

        // Ambil data monitoring proyek berdasarkan id_proyek_disetujui
        $monitoringProyek = MonitoringProyek::with([
            'penjadwalan',
            'timProyek.pekerja',
            'Proyek_disetujui.pengajuanProposal.tempatProyek.kategoriProyek',
            'Proyek_disetujui.pengajuanProposal.tempatProyek.customer'
        ])
            ->where('id_proyek_disetujui', $idProyekDisetujui)
            ->first();

        return view('monitoring_proyek.index', compact('monitoringProyek'));
    }

    public function edit($id)
    {
        // Temukan entri penjadwalan berdasarkan ID
        $penjadwalan = Penjadwalan::findOrFail($id);

        // Ambil data monitoring proyek yang terkait dengan proyek yang sedang diedit
        $monitoringProyek = MonitoringProyek::where('id_proyek_disetujui', $penjadwalan->id_proyek_disetujui)->first();

        return view('monitoring_proyek.edit', compact('penjadwalan', 'monitoringProyek'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'keterangan' => 'required|string',
        ]);

        // Temukan entri penjadwalan berdasarkan ID
        $penjadwalan = Penjadwalan::findOrFail($id);
        $penjadwalan->keterangan = $request->keterangan;
        $penjadwalan->save();

        // Perbarui status_review di monitoring_proyek
        $monitoringProyek = MonitoringProyek::where('id_proyek_disetujui', $penjadwalan->id_proyek_disetujui)->first();
        if ($monitoringProyek) {
            $monitoringProyek->status_review = 'Sudah Direview';
            $monitoringProyek->save();
        }

        return redirect()->route('monitoring_proyek.index')->with('success', 'Data proyek berhasil diperbarui!');
    }

    public function reset($id)
    {
        // Temukan entri penjadwalan berdasarkan ID
        $penjadwalan = Penjadwalan::findOrFail($id);
        $penjadwalan->keterangan = '';
        $penjadwalan->save();

        // Reset status_review di monitoring_proyek
        $monitoringProyek = MonitoringProyek::where('id_proyek_disetujui', $penjadwalan->id_proyek_disetujui)->first();
        if ($monitoringProyek) {
            $monitoringProyek->status_review = 'Belum Direview';
            $monitoringProyek->save();
        }

        return redirect()->route('monitoring_proyek.index')->with('success', 'Data proyek berhasil direset!');
    }

    public function uploadFoto(Request $request, $id)
    {
        $request->validate([
            'foto' => 'required|image|mimes:jpeg,png,jpg|max:2048', // Validasi gambar
        ]);

        $monitoringProyek = MonitoringProyek::findOrFail($id);

        // Hapus foto lama jika ada
        if ($monitoringProyek->foto) {
            Storage::delete('public/' . $monitoringProyek->foto);
        }

        // Simpan foto baru
        $path = $request->file('foto')->store('foto_proyek', 'public');
        $monitoringProyek->foto = $path;
        $monitoringProyek->save();

        return redirect()->back()->with('success', 'Foto proyek berhasil diunggah!');
    }
}
