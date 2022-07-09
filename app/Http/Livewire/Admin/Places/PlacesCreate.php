<?php

namespace App\Http\Livewire\Admin\Places;

use App\Models\Locality;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;

class PlacesCreate extends Component
{
    use LivewireAlert;
    
    public $name;
    public $description;
    public $active = 0;

    protected $listeners = ['$refresh'];

    public function mount()
    {
        $this->clear();
    }
    
    public function render()
    {
        return view('admin.places.places-create');
    }

    public function store()
    {
        $this->validate([
            'name' => ['required','min:3','max:50'],
            'description' => ['nullable', 'max:255'],
        ]); 
        
        Locality::create([
            'name'        => $this->name, 
            'description' => $this->description
        ]);

        $this->emitTo('admin.places.places-index', '$refresh');

        $this->alert('success', 'Registro criado com sucesso!', [           
            'position' => 'bottom',
            'timer'    => 5000,
            'toast'    => true,
            'customClass' => [
                'popup' => 'bg-dark',
                'title' => 'text-white',
            ]
        ]);

        $this->reset();
    }

    public function clear()
    {
        $this->reset();
        $this->resetValidation();
    }
}
