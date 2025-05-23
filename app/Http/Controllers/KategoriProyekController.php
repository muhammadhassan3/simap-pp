<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\KategoriProyek;


class KategoriProyekController extends Controller
{
    public function index(Request $request)
    {
        $kategoris = KategoriProyek::orderBy('id', 'asc')->get();
        return view('kategori_proyek.index', compact('kategoris'));
    }

    public function create()
    {
        return view('kategori_proyek.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'id' => 'required|string|unique:kategori_proyeks,id',
            'nama' => 'required|string|max:255',
            'keterangan' => 'required|string|max:255',
        ]);

        KategoriProyek::create($request->all());
        return redirect()->route('kategori_proyek.index')->with('success', 'Kategori berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $kategoriProyek = KategoriProyek::findOrFail($id); // Pastikan data ditemukan
        return view('kategori_proyek.edit', compact('kategoriProyek'));
    }

    public function update(Request $request, $id)
    {
        $kategoriProyek = KategoriProyek::findOrFail($id); // Cegah error not found

        $request->validate([
            'nama' => 'required|string|max:255',
            'keterangan' => 'required|string|max:255',
        ]);

        $kategoriProyek->update($request->only('nama', 'keterangan'));
        return redirect()->route('kategori_proyek.index')->with('success', 'Kategori berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $kategori = KategoriProyek::find($id);

        if (!$kategori) {
            return redirect()->route('kategori_proyek.index')->with('error', 'Kategori tidak ditemukan.');
        }

        $kategori->delete();

        return redirect()->route('kategori_proyek.index')->with('success', 'Kategori berhasil dihapus.');
    }
}
