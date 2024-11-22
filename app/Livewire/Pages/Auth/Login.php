<?php

namespace App\Livewire\Pages\Auth;

use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Title;
use Livewire\Component;



#[Title('ورود به حساب')]
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
