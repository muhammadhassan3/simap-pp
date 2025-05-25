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
        // Ambil id_proyek_disetujui dari parameter URL
        $idProyekDisetujui = $request->input('id_proyek_disetujui');

        // Ambil data monitoring proyek berdasarkan id_proyek_disetujui
        $monitoringProyek = MonitoringProyek::with([
            'penjadwalan',
            'timProyek.pekerja',
            'Proyek_disetujui.pengajuanProposal.tempatProyek.kategoriProyek',
            'Proyek_disetujui.pengajuanProposal.tempatProyek.customer'
        ])
            ->where('id_proyek_disetujui', $idProyekDisetujui)
            ->first();

        // Jika monitoring proyek tidak ditemukan, cek apakah proyek disetujui ada
        if (!$monitoringProyek && $idProyekDisetujui) {
            // Buat entri monitoring proyek baru
            $monitoringProyek = MonitoringProyek::create([
                'id_proyek_disetujui' => $idProyekDisetujui,
                'status' => 'Belum Direview'
            ]);

            // Refresh dengan relasi
            $monitoringProyek = MonitoringProyek::with([
                'penjadwalan',
                'timProyek.pekerja',
                'Proyek_disetujui.pengajuanProposal.tempatProyek.kategoriProyek',
                'Proyek_disetujui.pengajuanProposal.tempatProyek.customer'
            ])
            ->where('id_proyek_disetujui', $idProyekDisetujui)
            ->first();
        }

        return view('monitoring_proyek.index', compact('monitoringProyek'));
    }

    public function edit($id)
    {
        // Find the penjadwalan record
        $penjadwalan = Penjadwalan::findOrFail($id);

        // Get the associated monitoring_proyek record
        $monitoring_proyek = MonitoringProyek::where('id_proyek_disetujui', $penjadwalan->id_proyek_disetujui)->first();

        return view('monitoring_proyek.edit', compact('penjadwalan', 'monitoring_proyek'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'keterangan' => 'required|string',
        ]);

        // Find the penjadwalan record
        $penjadwalan = Penjadwalan::findOrFail($id);
        $penjadwalan->keterangan = $request->keterangan;
        $penjadwalan->save();

        // Update the monitoring_proyek status
        $monitoring_proyek = MonitoringProyek::where('id_proyek_disetujui', $penjadwalan->id_proyek_disetujui)->first();
        if ($monitoring_proyek) {
            $monitoring_proyek->status = 'Sudah Direview';
            $monitoring_proyek->save();
        }

        return redirect()->route('monitoring_proyek.index', ['id_proyek_disetujui' => $monitoring_proyek->id_proyek_disetujui])->with('success', 'Data proyek berhasil diperbarui!');
    }

    public function reset($id)
    {
        // Temukan entri penjadwalan berdasarkan ID
        $penjadwalan = Penjadwalan::findOrFail($id);
        $penjadwalan->keterangan = '';
        $penjadwalan->save();

        // Reset status di monitoring_proyek
        $monitoringProyek = MonitoringProyek::where('id_proyek_disetujui', $penjadwalan->id_proyek_disetujui)->first();
        if ($monitoringProyek) {
            $monitoringProyek->status = 'Belum Direview';
            $monitoringProyek->save();
        }

        return redirect()->route('monitoring_proyek.index', ['id_proyek_disetujui' => $penjadwalan->id_proyek_disetujui])->with('success', 'Data proyek berhasil direset!');
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
