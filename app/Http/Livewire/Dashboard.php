<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Http;


class Dashboard extends Component
{   
    public $doors;
    public $selectedDoor;    
    public $chartData = [];

    public function updatedSelectedDoor($doorId)
    {
       $this->chartData = $this->getChartDataForDoor($doorId);
       $this->emit('chartDataUpdated', $this->chartData);
    }

    private function getChartDataForDoor($doorId)
    {
        // traer aqui los datos desde la api de RFIDS para cambiar el array de data   
        
        return [
            'labels' => ["1", "2", "3", "4", "5", "6", "7", "8"],
            'data' => [20, 16, 330, 4, 5, 6, 7, 8],
        ];
    }

    public function toggleDoorStatus($doorId)
    {
        $host = env("MOBILE_API_HOST", "http://localhost:3000");
        $door = array_filter($this->doors, function ($door) use ($doorId) {
            return $door->_id == $doorId;
        });
        
        if (!empty($door)) {
            $door = reset($door);
            $status = $door->status ? false : true;

            $response = Http::put($host . "/api/puertas/{$doorId}", [
                'status' => $status,
                'alarma' => $door->alarma,
                'activacion' => $door->activacion
            ]);
        }

        $this->emit('doorToggled');
    }
    
    public function hydrate()
    {
        $host = env("MOBILE_API_HOST", "http://localhost:3000");

        $responseDoors = Http::get($host . '/api/puertas', [
            "emailAdmin" => session('userAdmin')->email
        ]);
        
        $this->doors = json_decode($responseDoors->body());
    }

    public function render()
    {
        $host = env("MOBILE_API_HOST", "http://localhost:3000");

        $responseDoors = Http::get($host . '/api/puertas', [
            "emailAdmin" => session('userAdmin')->email
        ]);

        $this->doors = json_decode($responseDoors->body());

        return view('livewire.dashboard');
    }
}
