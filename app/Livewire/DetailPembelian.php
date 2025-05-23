<?php

namespace App\Livewire;

use App\Models\ProyekDisetujuiModel;
use Livewire\Component;

class DetailPembelian extends Component
{
    public $totalBarang = 1;


    public function tambah()
    {
        $this->totalBarang++;
    }
    public function kurang()
    {
        $this->totalBarang--;
    }
    public function render()
    {
        return view('livewire.detail-pembelian');
    }
}
