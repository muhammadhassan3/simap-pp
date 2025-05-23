<?php

namespace App\Http\Controllers;

use App\Models\Pekerja;
use App\Models\ProyekDisetujui;
use Illuminate\Http\Request;
use App\Models\TimProject;

class TimProyekController extends Controller
{
    public function index()
    {
        $timProyek = TimProject::all();
        // $timProyek=[
        //     [
        //         "proyek" => [ "tempat_proyek"=>"PT Pertamina Patra Niaga", "nama_proyek"=>"Pembangunan Kilang"],
        //         "id" => 1,
        //     ],
        // ];

        return view('timproject.index', compact('timProyek'));
    }

    public function show($id)
    {
        $tim = TimProject::where('id_project_disetujui', $id)->get();
        // dd($tim);
        return view('timproject.detail', compact('tim'));
    }

    public function edit($id)
    {
        $tim = TimProject::findOrFail($id); // Ambil data tim yang akan diedit
        $proyek_disetujui = ProyekDisetujui::with('pengajuan_proposal')->get();
        $pekerja = Pekerja::all();

        return view('timproject.edit', compact('tim', 'proyek_disetujui', 'pekerja'));
    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'id_project_disetujui' => 'required',
            'id_pekerja' => 'required',
            'peran' => 'required',
            'keahlian' => 'string',
        ]);

        //TimProject::create($request->all());

        $tim = TimProject::findOrFail($id);
        $tim->update($request->all());

        return redirect()->route('tim-proyek.index')->with('success', 'Data tim berhasil diperbarui');
    }

    public function detail(Request $request, $id)  // Pastikan $id ada di sini
    {
        $search = $request->input('search');

        $tim = TimProject::where('id_project_disetujui', $id)
            ->when($search, function ($query) use ($search) {
                $query->whereHas('pekerja', function ($q) use ($search) {
                    $q->whereRaw('LOWER(nama) LIKE ?', ["%".strtolower($search)."%"]);
                });
            })
            ->get();

        return view('timproject.detail', compact('tim', 'id')); // Pastikan $id dikirim ke view
    }



    public function destroy($id)
    {
        $tim = TimProject::findOrFail($id);
        $tim->delete();

        return redirect()->route('tim-proyek.index')->with('success', 'Tim proyek berhasil dihapus');
    }
    public function create()
    {
        $proyek_disetujui=ProyekDisetujui::with('pengajuan_proposal')->get();
        $pekerja = Pekerja::all();
        return view('timproject.create',['proyek_disetujui'=>$proyek_disetujui, 'pekerja'=>$pekerja]);
    }

    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'id_project_disetujui' => 'required',
            'id_pekerja' => 'required',
            'peran' => 'required',
            'keahlian' => 'required',
        ]);

        $TimProject = TimProject::where('id_pekerja',$request->id_pekerja)->where('id_project_disetujui',$request->id_project_disetujui)->first();
        if (!$TimProject) {
            TimProject::create([
                'id_project_disetujui' => $request->id_project_disetujui,
                'id_pekerja' => $request->id_pekerja,
                'peran' => $request->peran,
                'keahlian' => $request->keahlian,
            ]);

        }
        else {
            return redirect()->route('tim-proyek.create')->with('error', 'Pekerja telah dipilih sebelumnya.');
        }
        // Simpan ke database


        // Redirect dengan pesan sukses
        return redirect()->route('tim-proyek.index')->with('success', 'Tim proyek berhasil ditambahkan.');
    }

}
