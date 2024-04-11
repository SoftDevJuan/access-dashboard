<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Http;
use Carbon\Carbon;


class Dashboard extends Component
{   
    public $doors;
    public $selectedDoor;
    public $moves;
    public $chartData = [];



    ////////////////////////////////////////////////////////////
    public function updatedSelectedDoor($doorNumber)
    {
       $this->chartData = $this->getChartDataForDoor($doorNumber);
       $this->emit('chartDataUpdated', $this->chartData);
    }
////////////////////////////////////////////////////////////////////

    public function updatedDoors()
    {
    $this->chartData = $this->getChartDataForAll();
    $this->emit('chartDataUpdate', $this->chartData);
    }

    //////////////////////////////////////////////////////////
    private function getChartDataForDoor($doorNumber)
    {
        $host = env("MOBILE_API_HOST", "http://localhost:3000");
        $responseMoves = Http::get($host . '/api/getMovimientos', [
            "emailAdmin" => session('userAdmin')->email
        ]);
        $this->moves = json_decode($responseMoves->body());
        
        $filteredMoves = collect($this->moves)->where('puerta', $doorNumber);
        $accessCounts = array_fill(1, 24, 0); // Inicializa un array del 1 al 8 con el valor 0
        
        foreach ($filteredMoves as $move) {
            $hour = Carbon::parse($move->fecha)->tz('America/Mexico_City')->hour;

            if ($hour >= 1 && $hour <= 24) {
                $accessCounts[$hour]++;
            }
        }

        $labels = [];
        for ($i = 1; $i <= 24; $i++) {
            $labels[] = (string)$i;
        }

        $maxAccesses = max($accessCounts);
        $hourWithMostAccesses = array_search($maxAccesses, $accessCounts);

        $this->emit('updateStats', [
            'hourWithMostAccesses' => $hourWithMostAccesses,
            'maxAccesses' => $maxAccesses
        ]);

        return [
            'labels' => $labels,
            'data' => array_values($accessCounts),
        ];
    }
///////////////////////////////////////////////////////////////////////////

private function getChartDataForAll()
{
    $host = env("MOBILE_API_HOST", "http://localhost:3000");
    $responseMoves = Http::get($host . '/api/getMovimientos', [
        "emailAdmin" => session('userAdmin')->email
    ]);
    $this->moves = json_decode($responseMoves->body());
    
    $accessCounts = array_fill(1, 24, 0); // Inicializa un array del 1 al 8 con el valor 0
    
    foreach ($this->moves as $move) {
        $hour = Carbon::parse($move->fecha)->tz('America/Mexico_City')->hour;

        if ($hour >= 1 && $hour <= 24) {
            $accessCounts[$hour]++;
        }
    }

    $labels = [];
    for ($i = 1; $i <= 24; $i++) {
        $labels[] = (string)$i;
    }

    $maxAccesses = max($accessCounts);
    $hourWithMostAccesses = array_search($maxAccesses, $accessCounts);

    $this->emit('updateStats', [
        'hourWithMostAccesses' => $hourWithMostAccesses,
        'maxAccesses' => $maxAccesses
    ]);

    return [
        'labels' => $labels,
        'data' => array_values($accessCounts),
    ];
}




/////////////////////////////////////////////////////////////////////////////////
    public function toggleDoorStatus($doorId)
    {
        $host = env("MOBILE_API_HOST", "http://localhost:3000");
        $door = array_filter($this->doors, function ($door) use ($doorId) {
            return $door->_id == $doorId;
        });
        
        if (!empty($door)) {
            $door = reset($door);
            if($door->alarma == "false"){
                $alarma = "true";
            }else{$alarma = "false";} 

            $data = [
                '_id' => $doorId,
                'alarma' => $alarma
            ];
            
            $response = Http::put($host . "/api/puertasDispositivos/",$data);
                
        }

        $this->emit('doorToggled');
    }
    



    //////////////////////////////////////////////////////////////////////////
    public function hydrate()
    {
        $host = env("MOBILE_API_HOST", "http://localhost:3000");

        $responseDoors = Http::get($host . '/api/puertas', [
            "emailAdmin" => session('userAdmin')->email
        ]);
        
        $this->doors = json_decode($responseDoors->body());
    }



    //////////////////////////////////////////////////////////////////////////
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
