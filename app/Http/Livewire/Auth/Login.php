<?php

namespace App\Http\Livewire\Auth;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class Login extends Component
{
    public $email;
    public $password;

    protected $messages = [
        'email.required'    => 'Email é obrigatório.',
        'email.email'       => 'Informe um e-mail válido.',
        'password.required' => 'Senha é obrigatório.',
    ];

    public function mount()
    {
        Auth::logoutOtherDevices($this->password);
    }

    public function render()
    {
        return view('auth.login');
    }

    public function submit()
    {
        
        $this->validate([
            'email'    => ['required', 'email'],
            'password' => ['required'],
        ]);

        if ( Auth::attempt(['email' => $this->email, 'password' => $this->password]) ) {

            if(Auth::user()->active) {

                return redirect( route('dashboard.index'));
            
            }

            Auth::logout();

            return session()->flash('message', 'A conta do usuário informado está inativa!');

        }

        session()->flash('message', 'As credenciais fornecidas não correspondem a nenhum registro.');
    
    }

    public function logout()
    {
         Auth::logout();

         return redirect( route('auth.login'));
    }

}
