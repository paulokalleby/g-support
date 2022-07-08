<?php

namespace App\Http\Livewire\Navegation;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class SideBar extends Component
{
    protected $listeners = ['$refresh'];
    
    public function render()
    {
        return view('navegation.side-bar');
    }

    public function sideLogout()
    {
         Auth::logout();

         return redirect( route('auth.login'));
    }
}
