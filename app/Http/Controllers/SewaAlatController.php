<?php
// app/Http/Controllers/SewaAlatController.php (Laravel)
namespace App\Http\Controllers;

use App\Models\SewaAlat;
use App\Models\Customer;
use App\Models\TempatProyek;
use Illuminate\Http\Request;

class SewaAlatController extends Controller
{

    public function index()
    {
        // Mengambil semua data sewa alat beserta relasi customer dan tempat proyek
        $sewaAlat = SewaAlat::with(['Customer', 'TempatProyek'])->get(); // Periksa nama relasi
        // dd($sewaAlat->toArray());
        return view('sewa_alat.index', compact('sewaAlat')); // Pastikan nama view sesuai
    }

    public function create()
    {
        $customers = Customer::get();
        $tempatProyek = TempatProyek::all();
        return view('sewa_alat.create', compact('customers', 'tempatProyek'));
    }

    public function store(Request $request)
    {
        // Validasi data
        $request->validate([
            'nama_alat' => 'required|string|max:255',
            'harga_sewa' => 'required|numeric',
            'customer_id' => 'required|exists:customer,id',
            'durasi' => 'required|numeric',
            'qty' => 'required|numeric',
            'id_proyek' => 'required|exists:tempat_proyek,id',
            'detail' => 'nullable|string',
        ]);

        // Menyimpan data ke tabel sewa_alat
        SewaAlat::create([
            'nama_alat' => $request->nama_alat,
            'harga_sewa' => $request->harga_sewa,
            'customer_id' => $request->customer_id,
            'durasi' => $request->durasi,
            'qty' => $request->qty,
            'id_proyek' => $request->id_proyek,
            'detail' => $request->detail,
        ]);

        return redirect()->route('sewa_alat.index')->with('success', 'Data berhasil disimpan!');
    }
    public function destroy($id)
    {
        $alat = SewaAlat::findOrFail($id);
        $alat->delete();

        return redirect()->back()->with('success', 'Data berhasil dihapus!');
    }
    public function edit($id)
    {
        $sewa_alat = SewaAlat::findOrFail($id);
        $customers = Customer::all();
        $tempatProyek = TempatProyek::all();

        return view('sewa_alat.edit', compact('sewa_alat', 'customers', 'tempatProyek'));
    }


    public function update(Request $request, $id) {
        $request->validate([
            'nama_alat' => 'required|string|max:255',
            'harga_sewa' => 'required|numeric',
            'customer_id' => 'required|exists:customer,id',
            'durasi' => 'required|numeric',
            'qty' => 'required|numeric',
            'id_proyek' => 'required|exists:tempat_proyek,id',
            'detail' => 'nullable|string',
        ]);

        $sewa_alat = SewaAlat::findOrFail($id);
        $sewa_alat->update($request->all());

        return redirect()->route('sewa_alat.index')->with('success', 'Data berhasil diperbarui!');
    }

}
