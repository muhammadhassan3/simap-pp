<?php

namespace App\Http\Controllers;

use App\Models\PelaksanaanProyek;
use App\Models\Penjadwalan;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Models\PenjadwalanProyek;
use App\Models\Pelaksanaan_Proyek;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class PelaksanaanProyekController extends Controller
{

    public function index(Request $request, $id)
    {
        // Ambil query pencarian dari input
        $search = $request->input('search');

        // Query untuk mencari data berdasarkan nama pelaksanaan atau keterangan
        $pelaksanaan = PelaksanaanProyek::with('PenjadwalanProyek')
            ->where('id_penjadwalan', $id)
            ->when($search, function ($query) use ($search) {
                return $query->where(function ($q) use ($search) {
                    $q->where('nama_pelaksanaan', 'like', "%{$search}%")
                        ->orWhere('keterangan', 'like', "%{$search}%")
                        ->orWhere('tanggal_pelaksanaan', 'like', "%{$search}%");
                });
            })
            ->get();

        $penjadwalan = Penjadwalan::with('ProyekDisetujui')->where('id', $id)->first();

        return view('pelaksanaan.index', compact('pelaksanaan', 'penjadwalan'));
    }


    public function create($id)
    {
        $penjadwalan = Penjadwalan::where('id', $id)->first();
        return view('pelaksanaan.create', compact('penjadwalan'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'tanggal' => 'date',
            'nama_pelaksanaan' => 'string|max:255',
            'foto' => 'image|mimes:jpeg,png,jpg',
            'keterangan' => 'nullable',
            'id_penjadwalan' => 'required',
        ]);

        // Upload Foto jika ada
        $fotoPath = null;
        if ($request->hasFile('foto')) {
            $fotoPath = $request->file('foto')->store('Pelaksanaan', 'public');
        }

        $tanggalSekarang = Carbon::now()->toDateString();

        // Validasi tanggal_pelaksanaan tidak boleh lebih dari hari ini
        if ($request->tanggal_pelaksanaan > $tanggalSekarang) {
            return redirect()->back()->with('error', 'Tanggal pelaksanaan tidak boleh lebih dari hari ini.');
        }

        PelaksanaanProyek::create([
            'tanggal_pelaksanaan' => $request->tanggal_pelaksanaan,
            'nama_pelaksanaan' => $request->nama_pelaksanaan,
            'foto' => $fotoPath,
            'keterangan' => $request->keterangan,
            'id_penjadwalan' => $request->id_penjadwalan,
            'status' => 'Belum dikonfirmasi',
        ]);

        return redirect()->route('pelaksanaan.index', $request->id_penjadwalan)->with('success', 'Data berhasil ditambahkan!');
    }

    public function edit($id, $kode)
    {
        $pelaksanaan = PelaksanaanProyek::where('id', $kode)->where('id_penjadwalan', $id)->firstOrFail();
        return view('pelaksanaan.edit', compact('pelaksanaan'));
    }

    public function update(Request $request, $id, $kode)
    {
        $request->validate([
            'tanggal_pelaksanaan' => 'required|date',
            'nama_pelaksanaan' => 'required|string|max:255',
            'keterangan' => 'nullable|string',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $pelaksanaan = PelaksanaanProyek::where('id', $kode)->where('id_penjadwalan', $id)->firstOrFail();

        $tanggalSekarang = Carbon::now()->toDateString();

        // Validasi tanggal_pelaksanaan tidak boleh lebih dari hari ini
        if ($request->tanggal_pelaksanaan > $tanggalSekarang) {
            return redirect()->back()->with('error', 'Tanggal pelaksanaan tidak boleh lebih dari hari ini.');
        }

        // Cek apakah ada file foto baru yang diunggah
        if ($request->hasFile('foto')) {

            //dd($pelaksanaan->foto);

            // Cek apakah foto lama ada sebelum menghapus
            $filePath = storage_path('app/public/' . $pelaksanaan->foto);

            if (File::exists($filePath)) {
                File::delete($filePath);
            }

            // Simpan foto baru
            $fotoPath = $request->file('foto')->store('Pelaksanaan', 'public');
            $pelaksanaan->foto = $fotoPath;
        }

        // Update data lainnya
        $pelaksanaan->tanggal_pelaksanaan = $request->tanggal_pelaksanaan;
        $pelaksanaan->nama_pelaksanaan = $request->nama_pelaksanaan;
        $pelaksanaan->keterangan = $request->keterangan;
        $pelaksanaan->save();

        // return $pelaksanaan->foto;
        return redirect()->route('pelaksanaan.index', $pelaksanaan->id_penjadwalan)->with('success', 'Data berhasil diperbarui!');
    }

    public function confirm($id, $kode)
    {
        // Temukan data pelaksanaan berdasarkan ID dan ID Penjadwalan
        $pelaksanaan = PelaksanaanProyek::where('id', $kode)
            ->where('id_penjadwalan', $id)
            ->firstOrFail();

        // Ubah status menjadi 'Dikonfirmasi'
        $pelaksanaan->status = 'Dikonfirmasi';
        $pelaksanaan->save();

        // Redirect kembali dengan pesan sukses
        return redirect()->route('pelaksanaan.index', $id)->with('success', 'Pelaksanaan telah dikonfirmasi.');
    }


    public function destroy($id)
    {
        $pelaksanaan = PelaksanaanProyek::findOrFail($id);

        // Cek apakah foto lama ada sebelum menghapus
        $filePath = storage_path('app/public/' . $pelaksanaan->foto);

        if (File::exists($filePath)) {
            File::delete($filePath);
        }

        $pelaksanaan->delete();

        return redirect()->route('pelaksanaan.index', $pelaksanaan->id_penjadwalan)->with('success', 'Data berhasil dihapus!');
    }
}
