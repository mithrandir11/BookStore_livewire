<?php

namespace App\Livewire\Pages\Auth;

use App\Models\User;
use App\Repositories\Interfaces\IUserRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class Register extends Component
{
    public $name,$email,$password,$password_confirmation;
    public function register(){
        $this->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        User::create([
            'name' => $this->name,
            'email' => $this->email,
            'password' => Hash::make($this->password)
        ]);

        $credentials = [
            'email' => $this->email,
            'password' => $this->password,
        ];

        Auth::attempt($credentials);
        // session()->flash('message', 'You have successfully registered & logged in!');
 
        return $this->redirectRoute('home', navigate: true);         
    }
    
    public function render()
    {
        return view('livewire.pages.auth.register');
    }
}
