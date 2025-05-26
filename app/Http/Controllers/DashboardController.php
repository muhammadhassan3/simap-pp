<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PengajuanProposal;
use App\Models\ProyekDisetujui;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function DashboardAdmin()
    {

        $user = Auth::user();
        $countProposal = PengajuanProposal::count();
        $countProjekBerjalan = ProyekDisetujui::where('status', 'Dikerjakan')->count();
        $countProjekSelesai = ProyekDisetujui::where('status', 'Selesai')->count();

        return view('auth.dashboard', [
            'countProposal' => $countProposal,
            'user' => $user,
            'countProjekBerjalan' => $countProjekBerjalan,
            'countProjekSelesai' => $countProjekSelesai,
        ]);
    }
}
