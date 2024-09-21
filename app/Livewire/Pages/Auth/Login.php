<?php

namespace App\Livewire\Pages\Auth;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

use function Laravel\Prompts\error;

class Login extends Component
{
    public $email,$password,$error;
    public function login(){
        $this->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $credentials = [
            'email' => $this->email,
            'password' => $this->password,
        ];

        if(Auth::attempt($credentials)){
            // session()->flash('message', 'You have successfully logged in!');
            return $this->redirectRoute('home', navigate: true);
        }else{
            $this->addError('credentials', 'اطلاعات ورود نامعتبر است.');
        }
    }

    public function render()
    {
        return view('livewire.pages.auth.login');
    }
}
