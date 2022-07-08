<?php

namespace App\Http\Livewire\Auth;

use Livewire\Component;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;

class ResetPassword extends Component
{
    public $token;
    public $email;
    public $password;
    public $password_confirmation;

    protected $queryString = ['token','email'];

    public function render()
    {
        return view('auth.reset-password');
    }
    

    public function resetPassword()
    {

        $this->validate([
            'token'    => ['required'],
            'email'    => ['required','email'],
            'password' => ['required', 'min:8', 'max:16'],
            'password_confirmation' =>  [
                'required','same:password'
            ],
        ]);

        $status = Password::reset(
            
            [
                'token' => $this->token,
                'email' => $this->email,
                'password' => $this->password,
                'password_confirmation' => $this->password_confirmation,
            ],

            function ($user, $password) {

                $user->forceFill([
                    'password' => Hash::make($password)
                ])->setRememberToken(Str::random(60));

                $user->save();

                event(new PasswordReset($user));
                
            }
        );

        if( $status == Password::PASSWORD_RESET ) {

            session()->flash('success', 'Senha redefinida com sucesso!');
          
        } else {

            session()->flash('danger', __($status));

        }

    }
}
