<?php

namespace App\Http\Controllers;

use App\Models\Pekerja;
use App\Models\TimProyek;
use Illuminate\Http\Request;
use App\Models\ProyekDisetujui;

class PengawasProyekController extends Controller
{
    public function index(Request $request)
    {
        if($request->has('search')){
            $searchTerm = $request['search'];
            $data = TimProyek::with(['proyekDisetujui', 'pekerja', 'proposal'])
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
                        'keahlian' => $tim->keahlian,
                    ];
                });
        }else{
            $data = TimProyek::with(['proyekDisetujui', 'pekerja'])
                ->where('peran', 'Pengawas') // Hanya mengambil pengawas
                ->get()
                ->map(function ($tim) {
                    return [
                        'id' => $tim->id, // Tambahkan ID agar bisa digunakan di Blade
                        'nama_proyek' => $tim->proyekDisetujui->pengajuanProposal->nama_proyek ?? 'Tidak Ada',
                        'peran' => $tim->peran,
                        'nama_pekerja' => $tim->pekerja->nama ?? 'Tidak Ada',
                        'keahlian' => $tim->keahlian,
                    ];
                });
        }
        return view('pengawas_proyek.index', compact('data'));
    }

    public function create()
    {
        $proyekDisetujui = ProyekDisetujui::with('pengajuanProposal')->get();
        $pekerja = Pekerja::all();

        return view('pengawas_proyek.create', compact('proyekDisetujui', 'pekerja'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_project_disetujui' => 'required|exists:proyek_disetujui,id',
            'id_pekerja' => 'required|exists:pekerja,id',
            'keahlian' => 'required|string|max:255',
        ]);

        $existing = TimProyek::where([
            'id_project_disetujui' => $request->id_project_disetujui,
            'id_pekerja' => $request->id_pekerja,
            'peran' => 'Pengawas', 
            'keahlian' => $request->keahlian,
        ])->exists();

        if ($existing) {
            return back()->with('error', 'Pengawas sudah terdaftar dalam proyek ini.');
        }

        TimProyek::create([
            'id_project_disetujui' => $request->id_project_disetujui,
            'id_pekerja' => $request->id_pekerja,
            'peran' => 'Pengawas',
            'keahlian' => $request->keahlian,
        ]);

        return redirect()->route('pengawas-proyek.index')->with('success', 'Pengawas proyek berhasil ditambahkan.');
    }


    public function edit($id)
    {
        $pengawas = TimProyek::with(['proyekDisetujui.pengajuanProposal', 'pekerja'])->findOrFail($id);
        $proyekDisetujui = ProyekDisetujui::with('pengajuanProposal')->get();
        $pekerja = Pekerja::all();

        return view('pengawas_proyek.edit', compact('pengawas', 'proyekDisetujui', 'pekerja'));
    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'id_project_disetujui' => 'required|exists:proyek_disetujui,id',
            'id_pekerja' => 'required|exists:pekerja,id',
            'peran' => 'required|string|max:100',
            'keahlian' => 'required|string|max:255',
        ]);

        $pengawas = TimProyek::findOrFail($id);

        $pengawas->id_project_disetujui = $request->id_project_disetujui;
        $pengawas->id_pekerja = $request->id_pekerja;
        $pengawas->peran = $request->peran;
        $pengawas->keahlian = $request->keahlian;

        $pengawas->save();

        return redirect()->route('pengawas-proyek.index')->with('success', 'Data berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $data = TimProyek::findOrFail($id);
        $data->delete();

        return redirect()->route('pengawas-proyek.index')->with('success', 'Data berhasil dihapus.');
    }

}
