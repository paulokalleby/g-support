<?php

namespace App\Http\Livewire\Components;

use Livewire\Component;

class Toast extends Component
{
    public $title, $message, $type;
    
    public function render()
    {
        return view('components.toast');
    }
}
