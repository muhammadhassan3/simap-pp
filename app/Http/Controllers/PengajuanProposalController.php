<?php

namespace App\Http\Controllers;

use App\Models\TempatProyek;
use Illuminate\Http\Request;
use App\Models\ProyekDisetujui;
use App\Models\PengajuanProposal;

class PengajuanProposalController extends Controller
{
    public function index()
    {
        $proposal = PengajuanProposal::all();
        // $proposal = PengajuanProposal::join('tempat_proyek', 'pengajuan_proposal.id_pengajuan_proposal', '=', 'tempat_proyek.id_tempat_proyek')
        //     ->select(
        //         'pengajuan_proposal.*',
        //         'tempat_proyek.nama_tempat_proyek'
        //     )
        //     ->get();
        // $proposal = PengajuanProposal::with('tempatProyek')->get();
        return view('pengajuan_proposal.index', compact('proposal'));
    }

    public function create()
    {
        $tempatProyek = TempatProyek::all();
        return view('pengajuan_proposal.create', compact('tempatProyek'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_tempat_proyek' => 'required|exists:tempat_proyek,id',
            'nama_proyek' => 'required|string|max:100',
            'tanggal_pengajuan' => 'required|date',
            'harga_proyek' => 'required|string',
            'file_proposal' => 'required|file|mimes:pdf,docx|max:1048576',
            'keterangan_proposal' => 'required|string',
        ]);

        $harga_proyek = floatval(str_replace('.', '', $request->harga_proyek));

        $fileName = null;
        if ($request->hasFile('file_proposal')) {
            $file = $request->file('file_proposal');

            $fileName = time() . '_' . $file->getClientOriginalName();

            $file->move(public_path('proposal/'), $fileName);
        }

        PengajuanProposal::create([
            'id_tempat_proyek' => $request->id_tempat_proyek,
            'nama_proyek' => $request->nama_proyek,
            'tanggal_pengajuan' => $request->tanggal_pengajuan,
            'harga' => $harga_proyek,
            'file_proposal' => $fileName,
            'keterangan' => $request->keterangan_proposal,
            'status_proposal' => 'pending', // default jika perlu
        ]);

        return redirect()->route('pengajuan_proposal.index')->with('message', 'Data Pengajuan Proposal berhasil disimpan!');
    }

    public function edit($id)
    {
        $proposal = PengajuanProposal::findOrFail($id);
        $tempatProyek = TempatProyek::all();

        return view('pengajuan_proposal.edit', compact('proposal', 'tempatProyek'));
    }

    public function update(Request $request, $id)
{
    $request->validate([
        'id_tempat_proyek' => 'required|exists:tempat_proyek,id',
        'nama_proyek' => 'required|string|max:100',
        'tanggal_pengajuan' => 'required|date',
        'harga_proyek' => 'required|string',
        'keterangan_proposal' => 'required|string',
        'file_proposal' => 'nullable|file|mimes:pdf,docx|max:1048576',
    ]);

    $proposal = PengajuanProposal::findOrFail($id);

    $harga_proyek = floatval(str_replace('.', '', $request->harga_proyek));
    $fileName = $proposal->file_proposal;

    // Jika ada file baru diupload
    if ($request->hasFile('file_proposal')) {
        // Hapus file lama jika ada
        if ($fileName) {
            $oldFilePath = public_path('proposal/' . $fileName);
            if (file_exists($oldFilePath)) {
                unlink($oldFilePath);
            }
        }
        $file = $request->file('file_proposal');
        $fileName = time() . '_' . $file->getClientOriginalName();
        $file->move(public_path('proposal/'), $fileName);
    }

    $proposal->update([
        'id_tempat_proyek' => $request->id_tempat_proyek,
        'nama_proyek' => $request->nama_proyek,
        'tanggal_pengajuan' => $request->tanggal_pengajuan,
        'harga' => floatval(str_replace('.', '', $request->harga_proyek)),
        'file_proposal' => $fileName,
        'keterangan' => $request->keterangan_proposal,
    ]);

    return redirect()->route('pengajuan_proposal.index')->with('message', 'Berhasil diupdate!');
}

    // public function updateStatus($id_pengajuan_proposal, $status)
    // {
    //     $proposal = PengajuanProposal::findOrFail($id_pengajuan_proposal);
    //     $proposal->update(['status_proposal' => $status]);

    //     return redirect()->back()->with('message', 'Status berhasil diperbarui!');
    // }

    public function updateStatus($id_pengajuan_proposal, $status)
    {
        $proposal = PengajuanProposal::findOrFail($id_pengajuan_proposal);
        $proposal->update(['status_proposal' => $status]);

        if ($status === 'disetujui') {
            ProyekDisetujui::create([
                'id_pengajuan_proposal' => $proposal->id_pengajuan_proposal,
                'status' => 'tersedia',
                'tanggal_mulai' => null,
                'tanggal_selesai' => null,
            ]);
        }

        return redirect()->back()->with('message', 'Status berhasil diperbarui!');
    }

    public function destroy($id)
{
    $proposal = PengajuanProposal::findOrFail($id);

    // Hapus file proposal jika ada
    if ($proposal->file_proposal) {
        $filePath = public_path('proposal/' . $proposal->file_proposal);
        if (file_exists($filePath)) {
            unlink($filePath);
        }
    }

    $proposal->delete();

    return redirect()->route('pengajuan_proposal.index')->with('message', 'Proposal berhasil dihapus!');
}
}
