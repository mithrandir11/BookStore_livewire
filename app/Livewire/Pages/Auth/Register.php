<?php

namespace App\Livewire\Pages\Auth;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('ساخت حساب')]
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
 
        return $this->redirectRoute('home', navigate: true);         
    }
    
    public function render()
    {
        return view('livewire.pages.auth.register');
    }
}
