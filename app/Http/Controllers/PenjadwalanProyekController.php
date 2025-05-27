<?php

namespace App\Http\Controllers;

use App\Models\Penjadwalan;
use App\Models\ProyekDisetujui;
use App\Models\TimProyek;
use Illuminate\Http\Request;

class PenjadwalanProyekController extends Controller
{
    public function index(Request $request)
    {
        $penjadwalanProyek = Penjadwalan::with(['proyekDisetujui.pengajuanProposal', 'supervisor.pekerja'])->where('id_proyek_disetujui', $request['id_proyek_disetujui'])->get();
        return view('penjadwalan_proyek.penjadwalan_proyek', ['penjadwalanProyek' => $penjadwalanProyek, 'id_proyek_disetujui' => $request['id_proyek_disetujui']]);
    }

//    public function create(Request $request)
//    {
//        $proyekDisetujui = ProyekDisetujui::with([
//            'pengajuanProposal',
//            'timProyek.pekerja'
//        ])->get();
//        $id_proyek_disetujui = $request->query('id_proyek_disetujui');
//        return view('penjadwalan_proyek.tambahjadwal_proyek', compact('proyekDisetujui', 'id_proyek_disetujui'));
//    }

    public function store(Request $request)
    {
        $request->validate([
            'id_proyek_disetujui' => 'required',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date|after_or_equal:tanggal_mulai',
            'pekerjaan' => 'required|string',
            'status' => 'required|in:tersedia,sedang dikerjakan,batal,selesai']);

        // Get the supervisor from TimProyek
        $supervisor = TimProyek::where('id_project_disetujui', $request->id_proyek_disetujui)->where('peran', 'Supervisor')->first();

        // Save to database
        Penjadwalan::create(['id_proyek_disetujui' => $request->id_proyek_disetujui, 'id_tim_project' => $supervisor ? $supervisor->id : null, 'tanggal_mulai' => $request->tanggal_mulai, 'tanggal_selesai' => $request->tanggal_selesai, 'pekerjaan' => $request->pekerjaan, 'status' => $request->status,]);

        return redirect()->route('penjadwalan_proyek.index', ['id_proyek_disetujui' => $request->id_proyek_disetujui])->with('success', 'Jadwal proyek berhasil ditambahkan');
    }

    public function create(Request $request)
    {
        $idProyekDisetujui = $request['id_proyek_disetujui'];
        $proyekDisetujui = ProyekDisetujui::with(['pengajuanProposal', 'timProyek.pekerja'])->where('id', $idProyekDisetujui)->first();
        $timProyek = TimProyek::with('pekerja')->where('id_project_disetujui', $idProyekDisetujui)->where('peran', 'supervisor')->first();
        if($timProyek){
            $supervisor = $timProyek->pekerja->nama;
        }else{
            $supervisor = '';
        }

        return view('penjadwalan_proyek.tambahjadwal_proyek', ['proyekDisetujui' => $proyekDisetujui, 'idProyekDisetujui' => $idProyekDisetujui, 'supervisor' => $supervisor]);
    }

    public function edit($id)
    {
        $jadwal = Penjadwalan::with(['proyekDisetujui.pengajuanProposal', 'supervisor.pekerja'])->findOrFail($id);
        return view('penjadwalan_proyek.editjadwal_proyek', compact('jadwal'));
    }

    public function update(Request $request, $id)
    {
        // Validasi input dengan enum untuk status
        $request->validate(['tanggal_mulai' => 'required|date', 'tanggal_selesai' => 'required|date|after_or_equal:tanggal_mulai', 'pekerjaan' => 'required|string', 'status' => 'required|in:tersedia,sedang dikerjakan,batal,selesai']);

        $jadwal = Penjadwalan::findOrFail($id);

        // Update jadwal
        $jadwal->tanggal_mulai = $request->tanggal_mulai;
        $jadwal->tanggal_selesai = $request->tanggal_selesai;
        $jadwal->pekerjaan = $request->pekerjaan;
        $jadwal->status = $request->status;
        $jadwal->save();

        return redirect()->route('penjadwalan_proyek.index', ['id_proyek_disetujui' => $jadwal->id_proyek_disetujui])->with('success', 'Jadwal proyek berhasil diperbarui');
    }

    public function delete($id)
    {
        $jadwal = Penjadwalan::findOrFail($id);
        $id_proyek_disetujui = $jadwal->id_proyek_disetujui;
        $jadwal->delete();

        return redirect()->route('penjadwalan_proyek.index', ['id_proyek_disetujui' => $id_proyek_disetujui])->with('success', 'Jadwal proyek berhasil dihapus');
    }

    public function getSupervisor($id)
    {
        $supervisor = TimProyek::with('pekerja')->where('id_project_disetujui', $id)->where('peran', 'supervisor')->first();

        return response()->json(['supervisor' => $supervisor]);
    }
}
