<?php

namespace App\Http\Livewire\Components;

use Livewire\Component;

class CardStats extends Component
{
    public $title = 'Carregando...'; 
    public $info  = 0; 
    public $color = 'primary';
    public $icon  = 'fa-spinner-third fa-pulse';

    public function render()
    {
        return view('components.card-stats');
    }
}
