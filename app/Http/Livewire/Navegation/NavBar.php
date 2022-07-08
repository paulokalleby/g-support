<?php

namespace App\Http\Livewire\Navegation;

use Illuminate\Support\Facades\Auth;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;

class NavBar extends Component
{
    use LivewireAlert;

    protected $listeners = ['$refresh'];

    public function render()
    {
        return view('navegation.nav-bar');
    }

    public function navLogout()
    {
         Auth::logout();

         return redirect( route('auth.login'));

    }
}
