<?php

namespace App\Http\Livewire\ExampleLaravel;
use Illuminate\Support\Facades\Http;
use Livewire\Component;

class DoorManagement extends Component
{
    

    public $idPuerta;
    public $emailAdmin;
    public $numero;
    public $showModal = false;
    public $resultados;
    public $doors;





    /////////////////////////////////////////////////////////////
    public function saveChanges()
    {
        $host = env("MOBILE_API_HOST", "http://localhost:3000");
        
        $response = Http::post($host . '/api/puertas', [
            'idPuerta' => $this->idPuerta,
            "emailAdmin" => session('userAdmin')->email,
            'numero' => $this->numero,
        ]);

        if ($response->successful()) {
            session()->flash('message', 'Success!');
        } else {            
            session()->flash('error', 'Failed!');
        }

        $this->showModal = false;
    }




    /////////////////////////////////////////////////////
    public function hydrate()
    {   
        $host = env("MOBILE_API_HOST", "http://localhost:3000");

        $responseresultados = Http::get($host . '/api/getUsuarios', [
            "emailAdmin" => session('userAdmin')->email
        ]);
        $this->resultados = json_decode($responseresultados->body());

        $responseDoors = Http::get($host . '/api/puertas', [
            "emailAdmin" => session('userAdmin')->email
        ]);
        $this->doors = json_decode($responseDoors->body());
    }





    /////////////////////////////////////////////////////////////////////
    public function render()
    {
        $host = env("MOBILE_API_HOST", "http://localhost:3000");
        
        $responseresultados = Http::get($host . '/api/puertas', [
            "emailAdmin" => session('userAdmin')->email
        ]);
        $this->resultados = json_decode($responseresultados->body());

        $responseUsers = Http::get($host . '/api/getUsuarios', [
            "emailAdmin" => session('userAdmin')->email
        ]);
        $this->doors = json_decode($responseUsers->body());

        return view('livewire.example-laravel.door-management');
    }
}
