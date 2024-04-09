<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Http;

class Tables extends Component
{
    public $movimientos;

    public function render()
    {
        $host = env("MOBILE_API_HOST", "http://localhost:3000");
        
        $response = Http::get($host . '/api/getMovimientos', [
            "emailAdmin" => session('userAdmin')->email
        ]);

        $this->movimientos = json_decode($response->body());

        return view('livewire.tables');
    }
}
