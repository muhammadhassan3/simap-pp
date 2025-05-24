<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DokumenPenyelesaianProyek;
use App\Models\ProyekDisetujui;
use Illuminate\Support\Facades\Storage;


class DokumenPenyelesaianProyekController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');

        // Query pencarian berdasarkan nama proyek atau keterangan dokumen
        $dokumen = DokumenPenyelesaianProyek::with('proyekDisetujui.pengajuanProposal')
            ->when($search, function ($query, $search) {
                return $query->whereHas('proyekDisetujui.pengajuanProposal', function ($subQuery) use ($search) {
                    $subQuery->where('nama_proyek', 'like', "%{$search}%");
                })->orWhere('keterangan', 'like', "%{$search}%");
            })
            ->get();

        // Mengirim data ke view
        return view('dokumen_penyelesaian_proyek.dokumen_penyelesaian_proyek', compact('dokumen'));
    }

    public function create()
    {
        $proyekSelesai = ProyekDisetujui::with('PengajuanProposal')->where('status', 'selesai')->get(); // Ambil proyek yang sudah selesai
        return view('dokumen_penyelesaian_proyek.create', compact('proyekSelesai'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_proyek_disetujui' => 'required|exists:proyek_disetujui,id',
            'file' => 'required|mimes:pdf|max:2048',
            'keterangan' => 'nullable|string',
        ]);

        $filePath = $request->file('file')->store('dokumen_penyelesaian', 'public');

        DokumenPenyelesaianProyek::create([
            'id_proyek_disetujui' => $request->id_proyek_disetujui,
            'file' => $filePath,
            'keterangan' => $request->keterangan,
        ]);

        return redirect()->route('dokumen.index')->with('success', 'Dokumen berhasil ditambahkan.');
    }

    public function destroy($id)
    {
        $doku = DokumenPenyelesaianProyek::findOrFail($id);
        $doku->delete();
        return redirect()->route('dokumen.index')->with('success', 'Dokumen berhasil dihapus.');
    }

    public function edit($id)
    {
        $dokumen = DokumenPenyelesaianProyek::findOrFail($id);
        $proyekSelesai = ProyekDisetujui::where('status', 'selesai')->get(); // Ambil proyek yang sudah selesai
        return view('dokumen_penyelesaian_proyek.edit', compact('dokumen', 'proyekSelesai'));
    }

    public function update(Request $request, $id)
    {
        $dokumen = DokumenPenyelesaianProyek::findOrFail($id);

        $request->validate([
            'id_proyek_disetujui' => 'required|exists:proyek_disetujui,id',
            'file' => 'nullable|mimes:pdf|max:2048',
            'keterangan' => 'nullable|string',
        ]);

        // Cek apakah ada file baru yang diupload
        if ($request->hasFile('file')) {
            // Hapus file lama jika ada
            if ($dokumen->file) {
                Storage::disk('public')->delete($dokumen->file);
            }

            // Simpan file baru
            $filePath = $request->file('file')->store('dokumen_penyelesaian', 'public');
            $dokumen->file = $filePath;
        }

        $dokumen->id_proyek_disetujui = $request->id_proyek_disetujui;
        $dokumen->keterangan = $request->keterangan;
        $dokumen->save();

        return redirect()->route('dokumen.index')->with('success', 'Dokumen berhasil diperbarui.');
    }
}
