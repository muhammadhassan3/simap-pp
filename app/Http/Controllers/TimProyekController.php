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
        // Validasi input dengan pesan kustom
        $request->validate([
            'id_project_disetujui' => 'required', 
            'id_pekerja' => 'required', 
            'peran' => 'required', 
            'keahlian' => 'string'
        ], [
            'id_project_disetujui.required' => 'Nama Proyek harus dipilih',
            'id_pekerja.required' => 'Nama Pekerja harus dipilih',
            'peran.required' => 'Peran harus dipilih'
        ]);

        // Ambil data tim yang akan diupdate
        $tim = TimProyek::findOrFail($id);
        
        // Cek jika pekerja diubah
        if ($tim->id_pekerja != $request->id_pekerja) {
            // Cari apakah sudah ada pekerja yang sama di proyek yang sama
            $existingTim = TimProyek::where('id_pekerja', $request->id_pekerja)
                ->where('id_project_disetujui', $request->id_project_disetujui)
                ->where('id', '!=', $id) // Kecuali dirinya sendiri
                ->first();
                
            if ($existingTim) {
                return redirect()->route('tim-proyek.edit', $id)
                    ->with('error', 'Pekerja sudah terdaftar dalam tim proyek ini.')
                    ->withInput();
            }
        }
        
        // Jika tidak ada duplikasi, update data
        $tim->update($request->all());
        
        return redirect()->route('tim-proyek.detail', $tim->id_project_disetujui)
            ->with('success', 'Data tim proyek berhasil diperbarui');
    }

    public function detail(Request $request, $id)  // Pastikan $id ada di sini
    {
        $search = $request->input('search');

        // Periksa dulu apakah proyek disetujui ada
        $proyekDisetujui = ProyekDisetujui::find($id);

        if (!$proyekDisetujui) {
            return redirect()->back()->with('error', 'Proyek tidak ditemukan');
        }

        $tim = TimProyek::where('id_project_disetujui', $id)->when($search, function ($query) use ($search) {
            $query->whereHas('pekerja', function ($q) use ($search) {
                $q->whereRaw('LOWER(nama) LIKE ?', ["%" . strtolower($search) . "%"]);
            });
        })->get();

        // Hapus assignment yang bisa menyebabkan error
        // $id = $tim->first()->id_project_disetujui;

        // Ambil data pekerja yang belum masuk tim
        $pekerja = Pekerja::whereDoesntHave('timProyek', function($query) use ($id) {
            $query->where('id_project_disetujui', $id);
        })->get();

        return view('timproject.detail', compact('tim', 'id', 'pekerja', 'proyekDisetujui')); // Pastikan $id dikirim ke view
    }


    public function destroy($id)
    {
        $tim = TimProyek::findOrFail($id);
        $id_project_disetujui = $tim->id_project_disetujui; // Store the project ID before deleting
        $tim->delete();

        return redirect()->route('tim-proyek.detail', $id_project_disetujui)->with('success', 'Tim proyek berhasil dihapus');
    }

    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'id_project_disetujui' => 'required',
            'id_pekerja' => 'required',
            'peran' => 'required',
            'keahlian' => 'required',
        ], [
            'id_project_disetujui.required' => 'Nama Proyek harus dipilih',
            'id_pekerja.required' => 'Nama Pekerja harus dipilih',
            'peran.required' => 'Peran harus dipilih',
            'keahlian.required' => 'Keahlian harus diisi',
        ]);

        // Periksa apakah proyek ada
        $proyekExists = ProyekDisetujui::find($request->id_project_disetujui);
        if (!$proyekExists) {
            return redirect()->route('tim-proyek.create')->with('error', 'Proyek tidak ditemukan');
        }

        // Cari apakah sudah ada data dengan pekerja dan proyek yang sama
        $TimProject = TimProyek::where('id_pekerja', $request->id_pekerja)
            ->where('id_project_disetujui', $request->id_project_disetujui)
            ->first();

        if (!$TimProject) {
            $newTim = TimProyek::create([
                'id_project_disetujui' => $request->id_project_disetujui,
                'id_pekerja' => $request->id_pekerja,
                'peran' => $request->peran,
                'keahlian' => $request->keahlian,
            ]);

            // Redirect dengan pesan sukses
            return redirect()->route('tim-proyek.detail', $request->id_project_disetujui)->with('success', 'Tim proyek berhasil ditambahkan.');
        } else {
            // Jika gagal membuat tim, kembalikan ke halaman create dengan menyimpan data yang sudah diisi
            return redirect()->route('tim-proyek.create', ['id_project_disetujui' => $request->id_project_disetujui])
                ->with('error', 'Pekerja telah dipilih sebelumnya.')
                ->withInput();
        }
    }

    public function create(Request $request)
{
    $proyek_disetujui = ProyekDisetujui::with('pengajuan_proposal')->get();
    $pekerja = Pekerja::all();
    $selected_project_id = $request->query('id_project_disetujui');

    // Validasi ID proyek jika ada
    if ($selected_project_id) {
        $proyekExists = ProyekDisetujui::find($selected_project_id);
        if (!$proyekExists) {
            return redirect()->route('tim-proyek.index')->with('error', 'ID Proyek tidak ditemukan');
        }
    }

    return view('timproject.create', [
        'proyek_disetujui' => $proyek_disetujui,
        'pekerja' => $pekerja,
        'selected_project_id' => $selected_project_id
    ]);
}
}
