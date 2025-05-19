<?php

namespace App\Http\Controllers;

use App\Models\PenjadwalanProyekModel;
use App\Models\ProyekDisetujuiModel;
use App\Models\TimProjectModel;
use Illuminate\Http\Request;

class PenjadwalanProyekController extends Controller
{
    public function index()
    {
        $penjadwalanProyek = PenjadwalanProyekModel::with('proyekDisetujui.pengajuanProposal', 'supervisor')->get();
        return view('penjadwalan_proyek.penjadwalan_proyek', compact('penjadwalanProyek'));
    }

    public function create()
    {
        $proyekDisetujui = ProyekDisetujuiModel::with('pengajuanProposal', 'timProject.pekerja')->get();
        return view('penjadwalan_proyek.tambahjadwal_proyek', compact('proyekDisetujui'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_proyek_disetujui' => 'required',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date|after_or_equal:tanggal_mulai',
            'pekerjaan' => 'required|string',
            'status' => 'required|string'
        ]);

        // Ambil supervisor dari TimProjectModel
        $supervisor = TimProjectModel::where('id_proyek_disetujui', $request->id_proyek_disetujui)
            ->where('peran', 'Supervisor')
            ->with('pekerja') // Pastikan relasi pekerja dipanggil
            ->first();

        // Simpan ke dalam database
        PenjadwalanProyekModel::create([
            'id_proyek_disetujui' => $request->id_proyek_disetujui,
            'id_tim_project' => $supervisor ? $supervisor->id : null, // Cek apakah ada supervisor
            'tanggal_mulai' => $request->tanggal_mulai,
            'tanggal_selesai' => $request->tanggal_selesai,
            'pekerjaan' => $request->pekerjaan,
            'status' => $request->status,
        ]);

        return redirect('/penjadwalan_proyek')->with('success', 'Jadwal proyek berhasil ditambahkan');
    }

    public function edit($id)
    {
        $jadwal = PenjadwalanProyekModel::with('proyekDisetujui.pengajuanProposal', 'supervisor')->findOrFail($id);
        $proyekDisetujui = ProyekDisetujuiModel::with('pengajuanProposal', 'timProject.pekerja')->get();
        return view('penjadwalan_proyek.editjadwal_proyek', compact('jadwal', 'proyekDisetujui'));
    }

    public function update(Request $request, $id)
    {
        // Validasi input
        $request->validate([
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date|after_or_equal:tanggal_mulai',
            'pekerjaan' => 'required|string',
            'status' => 'required|string'
        ]);

        $jadwal = PenjadwalanProyekModel::findOrFail($id);

        // Ambil supervisor terbaru jika proyek diubah
        if ($request->has('id_proyek_disetujui')) {
            $supervisor = TimProjectModel::where('id_proyek_disetujui', $request->id_proyek_disetujui)
                ->where('peran', 'Supervisor')
                ->with('pekerja')
                ->first();

            $request->merge([
                'id_tim_project' => $supervisor ? $supervisor->id : null,

            ]);
        }

        $jadwal->update($request->all());

        return redirect('/penjadwalan_proyek')->with('success', 'Jadwal proyek berhasil diperbarui');
    }

    public function delete($id)
    {
        PenjadwalanProyekModel::findOrFail($id)->delete();
        return redirect('/penjadwalan_proyek')->with('success', 'Jadwal proyek berhasil dihapus');
    }

    public function getSupervisor($id)
    {
        $supervisor = TimProjectModel::where('id_proyek_disetujui', $id)
            ->where('peran', 'Supervisor')
            ->with('pekerja') // Ambil nama pekerja
            ->first();

        return response()->json([
            'nama_supervisor' => $supervisor ? $supervisor->pekerja->nama : null
        ]);
    }
}
