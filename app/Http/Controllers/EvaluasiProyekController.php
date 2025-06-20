<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EvaluasiProyek;
use App\Models\ProyekDisetujui;
use App\Models\PengajuanProposal;

class EvaluasiProyekController extends Controller
{
    // Menampilkan daftar proyek yang harus dievaluasi
    public function index(Request $request)
    {
        $search = $request->input('search');
        $this->tambahEvaluasiDariProyek(); // Otomatis tambahkan evaluasi jika ada proyek selesai

        $proyekSelesai = EvaluasiProyek::join('proyek_disetujui', 'evaluasi_proyek.id_proyek_disetujui', '=', 'proyek_disetujui.id')
            ->join('pengajuan_proposal', 'proyek_disetujui.id_pengajuan_proposal', '=', 'pengajuan_proposal.id')
            ->select(
                'evaluasi_proyek.id',
                'pengajuan_proposal.harga',
                'proyek_disetujui.id as id_proyek',
                'pengajuan_proposal.nama_proyek',
                'proyek_disetujui.status',
                'proyek_disetujui.tanggal_mulai',
                'proyek_disetujui.tanggal_selesai',
                'evaluasi_proyek.keterangan'
            )
            ->where('proyek_disetujui.status', 'Selesai')
            ->when($search, function ($query, $search) {
                return $query->where('pengajuan_proposal.nama_proyek', 'LIKE', "%{$search}%");
            })
            ->orderBy('evaluasi_proyek.id', 'desc') // Urutan dari yang terbaru
            ->get();

        // Hitung durasi proyek (selisih tanggal selesai - tanggal mulai)
        $proyekSelesai->transform(function ($item) {
            $tanggalMulai = \Carbon\Carbon::parse($item->tanggal_mulai);
            $tanggalSelesai = \Carbon\Carbon::parse($item->tanggal_selesai);
            $item->durasi = $tanggalMulai->diffInDays($tanggalSelesai); // Menghitung selisih hari
            return $item;
        });

        return view('evaluasi_proyek.evaluasi_proyek', compact('proyekSelesai'));
    }

    public function edit($id)
    {
        $proyek = EvaluasiProyek::with('proyekDisetujui.pengajuanProposal')->findOrFail($id);
        // Hitung durasi proyek
        $tanggalMulai = $proyek->proyekDisetujui->tanggal_mulai;
        $tanggalSelesai = $proyek->proyekDisetujui->tanggal_selesai;

        if ($tanggalMulai && $tanggalSelesai) {
            $durasi = \Carbon\Carbon::parse($tanggalMulai)->diffInDays(\Carbon\Carbon::parse($tanggalSelesai));
        } else {
            $durasi = 'Tidak tersedia';
        }

        return view('evaluasi_proyek.tulis_evaluasi', compact('proyek', 'durasi'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'keterangan' => 'required|string'
        ]);

        $evaluasi = EvaluasiProyek::findOrFail($id);
        $evaluasi->keterangan = $request->keterangan;
        $evaluasi->save();

        return redirect()->route('evaluasi.index')->with('success', 'Evaluasi proyek berhasil disimpan.');
    }

    public function tambahEvaluasiDariProyek()
    {
        $proyekSelesai = ProyekDisetujui::where('status', 'Selesai')->get();
        foreach ($proyekSelesai as $proyek) {
            $cekEvaluasi = EvaluasiProyek::where('id_proyek_disetujui', $proyek->id)->first();
            if (!$cekEvaluasi) {
                EvaluasiProyek::create([
                    'id_proyek_disetujui' => $proyek->id,
                    'keterangan' => ''
                ]);
            }
        }
    }
}
