<?php

namespace App\Events;

use App\Models\ProyekDisetujui;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ProyekSelesai
{
    use Dispatchable, SerializesModels;

    public $proyek;

    public function __construct(ProyekDisetujui $proyek)
    {
        $this->proyek = $proyek;
    }
}
