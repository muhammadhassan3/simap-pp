<?php

namespace App\Http\Controllers;

use App\Models\Pekerja;
use Illuminate\Http\Request;

class PekerjaController extends Controller
{
    public function index()
    {
        $pekerja = Pekerja::paginate(10);

        return view('pekerja.index', [
            'pekerja' => $pekerja,
        ]);
    }

    public function create()
    {
        return view('pekerja.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'no_hp' => 'required',
        ]);

        Pekerja::create([
            'nama' => $request->nama,
            'no_hp' => $request->no_hp,
        ]);

        return redirect()->route('pekerja.index')->with('success', 'Pekerja berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $pekerja = Pekerja::findOrFail($id);

        return view('pekerja.edit', [
            'pekerja' => $pekerja,
        ]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required',
            'no_hp' => 'required',
        ]);

        $pekerja = Pekerja::findOrFail($id);
        $pekerja->update([
            'nama' => $request->nama,
            'no_hp' => $request->no_hp,
        ]);

        return redirect()->route('pekerja.index')->with('success', 'Pekerja berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $pekerja = Pekerja::findOrFail($id);
        $pekerja->delete();

        return redirect()->route('pekerja.index')->with('success', 'Pekerja berhasil dihapus.');
    }
}
