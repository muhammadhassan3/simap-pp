<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProdukController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');

        $produks = Produk::when($search, function ($query, $search) {
            return $query->where('nama', 'LIKE', "%{$search}%");
        })->paginate(5);

        return view('produk.index', compact('produks'));
    }


    public function create()
    {
        return view('produk.form');
    }

    public function store(Request $request)
    {
        $request->validate(['nama' => 'required|string|max:100', 'harga' => 'required|numeric|min:1', 'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', 'deskripsi' => 'nullable|string', 'satuan' => 'required|integer|min:1',]);

        // Simpan file jika ada
        $path = $request->hasFile('foto') ? $request->file('foto')->store('produk', 'public') : null;

        Produk::create(['nama' => $request->nama, 'harga' => $request->harga, 'foto' => $path, 'deskripsi' => $request->deskripsi, 'satuan' => $request->satuan,]);

        return redirect()->route('produk.index')->with('success', 'Produk berhasil ditambahkan.');
    }

    public function edit(Produk $produk)
    {
        return view('produk.form', compact('produk'));
    }

    public function update(Request $request, Produk $produk)
    {
        $request->validate(['nama' => 'required|string|max:100', 'harga' => 'required|numeric|min:1', 'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', 'deskripsi' => 'nullable|string', 'satuan' => 'required|integer|min:1',]);

        // Ambil semua data kecuali foto
        $data = $request->except('foto');

        // Jika ada file baru, hapus foto lama dan simpan yang baru
        if ($request->hasFile('foto')) {
            // Hapus foto lama jika ada
            if (!empty($produk->foto) && Storage::exists('public/' . $produk->foto)) {
                Storage::delete('public/' . $produk->foto);
            }

            // Simpan foto baru
            $data['foto'] = $request->file('foto')->store('produk', 'public');
        }

        // Update produk dengan data yang diperbarui
        $produk->update($data);

        return redirect()->route('produk.index')->with('success', 'Produk berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $produk = Produk::findOrFail($id);
        $produk->delete();

        return redirect()->route('produk.index')->with('success', 'Produk berhasil dihapus.');
    }

}
