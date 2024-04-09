<?php

namespace App\Http\Livewire\Auth;

use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Http;
use Livewire\Component;

class Login extends Component
{

    public $email='';
    public $password='';

    protected $rules= [
        'email' => 'required|email',
        'password' => 'required'

    ];

    public function render()
    {
        return view('livewire.auth.login');
    }

    public function mount() {
      
        $this->fill(['email' => 'ejemplo@email.com', 'password' => 'secret']);    
    }
    
    public function store()
    {
        $host = env("MOBILE_API_HOST", "http://localhost:3000");

        $responseUsersAdmin = Http::get($host . "/api/getUsuaioAdmin");
        // Probar con esta api en lugar de la anterior:
        // $responseUsersAdmin = Http::get("http://localhost:3000/api/login");

        $usersAdmin = collect(
            json_decode($responseUsersAdmin->body())
        );
        
        $userFound = $usersAdmin->first(function ($user) {
            return $user->email == $this->email;
        });

        if ($responseUsersAdmin->successful() && $userFound) {
            session()->regenerate();
            session(['userAdmin' => $userFound]);

            return redirect('/dashboard');
        } else {
            throw ValidationException::withMessages([
                'email' => 'No se encontro un usuario con las credenciales ingresadas.',
            ]);
        }

    }
    
}
