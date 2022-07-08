<?php

namespace App\Http\Livewire\Auth;

use Livewire\Component;
use Illuminate\Support\Facades\Password;

class ForgotPassword extends Component
{

    public $email;

    public function render()
    {
        return view('auth.forgot-password');
    }

    public function sendResetLink()
    {

        $this->validate([
            'email' => ['required', 'email'],
        ]);

        $status = Password::sendResetLink(['email' => $this->email]);

        if( $status === Password::RESET_LINK_SENT ) {

            session()->flash('success', 'Link para redefinição enviado para o email!');
          
        } else {

            session()->flash('danger', __($status));

        }
         
    }

}
