<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProyekDisetujui;

class ProyekDisetujuiController extends Controller
{
    public function index(Request $request)
    {
        $query = ProyekDisetujui::with(['pengajuanProposal.tempatproyek'])
            ->whereHas('pengajuanProposal', function ($q) {
                $q->where('status_proposal', 'Disetujui'); // Hanya ambil yang disetujui
            });

        if ($request->has('search')) {
            $search = $request->search;
            $query->whereHas('pengajuanProposal', function ($q) use ($search) {
                $q->where('nama_proyek', 'like', "%$search%")
                    ->orWhereHas('tempatProyek', function ($q2) use ($search) {
                        $q2->where('nama', 'like', "%$search%");
                    });
            })
                ->orWhere('status', 'like', "%$search%")
                ->orWhere('tanggal_mulai', 'like', "%$search%")
                ->orWhere('tanggal_selesai', 'like', "%$search%");
        }

        $proyek = $query->paginate(10);

        return view('proyek_disetujui.index', [
            'proyek' => $proyek,
        ]);
    }


    public function edit($id)
    {
        $proyek = ProyekDisetujui::findOrFail($id);
        return view('proyek_disetujui.edit', compact('proyek'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'status' => 'required',
        ]);

        $proyek = ProyekDisetujui::findOrFail($id);
        $proyek->status = $request->status;
        $proyek->tanggal_mulai = $request->tanggal_mulai;
        $proyek->tanggal_selesai = $request->tanggal_selesai;
        $proyek->save();

        return redirect()->route('proyekdisetujui.index')->with('success', 'Status proyek berhasil diperbarui!');
    }

    public function show(Request $request, $id)
    {
        $fileName = null;
        if ($request->hasFile('file_proposal')) {
            $file = $request->file('file_proposal');

            $fileName = time() . '_' . $file->getClientOriginalName();

            $file->move(public_path('proposal/'), $fileName);
        }

        $proyek = ProyekDisetujui::findOrFail($id);
        return view('proyek_disetujui.show', compact('proyek'));
    }
}
