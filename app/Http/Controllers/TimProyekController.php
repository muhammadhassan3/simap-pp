<?php

namespace App\Http\Controllers;

use App\Models\Pekerja;
use App\Models\ProyekDisetujui;
use App\Models\TimProyek;
use Illuminate\Http\Request;

class TimProyekController extends Controller
{
    public function index()
    {
        $timProyek = TimProyek::all();
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
        $tim = TimProyek::where('id_project_disetujui', $id)->get();
        // dd($tim);
        return view('timproject.detail', compact('tim'));
    }

    public function edit($id)
    {
        $tim = TimProyek::findOrFail($id); // Ambil data tim yang akan diedit
        $proyek_disetujui = ProyekDisetujui::with('pengajuan_proposal')->get();
        $pekerja = Pekerja::all();

        return view('timproject.edit', compact('tim', 'proyek_disetujui', 'pekerja'));
    }


    public function update(Request $request, $id)
    {
        $request->validate(['id_project_disetujui' => 'required', 'id_pekerja' => 'required', 'peran' => 'required', 'keahlian' => 'string',]);

        //TimProject::create($request->all());

        $tim = TimProyek::findOrFail($id);
        $tim->update($request->all());

        return redirect()->route('tim-proyek.detail', $tim->id_project_disetujui)->with('success', 'Data tim berhasil diperbarui');
    }

    public function detail(Request $request, $id)  // Pastikan $id ada di sini
    {
        $search = $request->input('search');

        $tim = TimProyek::where('id_project_disetujui', $id)->when($search, function ($query) use ($search) {
                $query->whereHas('pekerja', function ($q) use ($search) {
                    $q->whereRaw('LOWER(nama) LIKE ?', ["%" . strtolower($search) . "%"]);
                });
            })->get();

        $id = $tim->first()->id_project_disetujui;

        return view('timproject.detail', compact('tim', 'id')); // Pastikan $id dikirim ke view
    }


    public function destroy($id)
    {
        $tim = TimProyek::findOrFail($id);
        $tim->delete();

        return redirect()->route('tim-proyek.index')->with('success', 'Tim proyek berhasil dihapus');
    }

    public function store(Request $request)
    {
        // Validasi input
        $request->validate(['id_project_disetujui' => 'required', 'id_pekerja' => 'required', 'peran' => 'required', 'keahlian' => 'required',]);

        $TimProject = TimProyek::where('id_pekerja', $request->id_pekerja)->where('id_project_disetujui', $request->id_project_disetujui)->first();
        if (!$TimProject) {
            TimProyek::create(['id_project_disetujui' => $request->id_project_disetujui, 'id_pekerja' => $request->id_pekerja, 'peran' => $request->peran, 'keahlian' => $request->keahlian,]);

        } else {
            return redirect()->route('tim-proyek.create')->with('error', 'Pekerja telah dipilih sebelumnya.');
        }
        // Simpan ke database


        // Redirect dengan pesan sukses
        return redirect()->route('tim-proyek.detail', $TimProject->id_project_disetujui)->with('success', 'Tim proyek berhasil ditambahkan.');
    }

    public function create()
    {
        $proyek_disetujui = ProyekDisetujui::with('pengajuan_proposal')->get();
        $pekerja = Pekerja::all();
        return view('timproject.create', ['proyek_disetujui' => $proyek_disetujui, 'pekerja' => $pekerja]);
    }

}
