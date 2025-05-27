<?php
// app/Http/Controllers/SewaAlatController.php (Laravel)
namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\ProyekDisetujui;
use App\Models\SewaAlat;
use App\Models\TempatProyek;
use Illuminate\Http\Request;

class SewaAlatController extends Controller
{

    public function index(Request $request)
    {
        // Mengambil semua data sewa alat beserta relasi customer dan tempat proyek
        $sewaAlat = SewaAlat::with(['Customer', 'TempatProyek'])->get(); // Periksa nama relasi
        $id_proyek_disetujui = $request->query('id_proyek_disetujui');
        return view('sewa_alat.index', compact('sewaAlat', 'id_proyek_disetujui')); // Pastikan nama view sesuai
    }

    public function store(Request $request)
    {
        // Validasi data
        $request->validate(['nama_alat' => 'required|string|max:255', 'harga_sewa' => 'required|numeric', 'customer_id' => 'required|exists:customer,id', 'durasi' => 'required|numeric', 'qty' => 'required|numeric', 'id_proyek' => 'required|exists:tempat_proyek,id', 'detail' => 'nullable|string',]);

        // Menyimpan data ke tabel sewa_alat
        SewaAlat::create(['nama_alat' => $request->nama_alat, 'harga_sewa' => $request->harga_sewa, 'customer_id' => $request->customer_id, 'durasi' => $request->durasi, 'qty' => $request->qty, 'id_proyek' => $request->id_proyek, 'detail' => $request->detail,]);

        return redirect()->route('sewa_alat.index', ['id_proyek_disetujui'=>$request->id_proyek])->with('success', 'Data berhasil disimpan!');
    }

    public function create(Request $request)
    {
        $customers = Customer::get();
        $id_proyek_disetujui = $request->query('id_proyek_disetujui');
        $proyekDisetujui = ProyekDisetujui::where('id', $id_proyek_disetujui)->first();
        $tempatProyek = TempatProyek::all();
        return view('sewa_alat.create', compact('customers', 'tempatProyek', 'proyekDisetujui', 'id_proyek_disetujui'));
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


    public function update(Request $request, $id)
    {
        $request->validate(['nama_alat' => 'required|string|max:255', 'harga_sewa' => 'required|numeric', 'customer_id' => 'required|exists:customer,id', 'durasi' => 'required|numeric', 'qty' => 'required|numeric', 'id_proyek' => 'required|exists:tempat_proyek,id', 'detail' => 'nullable|string',]);

        $sewa_alat = SewaAlat::findOrFail($id);
        $sewa_alat->update($request->all());

        return redirect()->route('sewa_alat.index',['id_proyek_disetujui'=>$request->id_proyek])->with('success', 'Data berhasil diperbarui!');
    }

}
