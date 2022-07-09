<?php

namespace App\Http\Livewire\Admin\Places;

use App\Models\Locality;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;

class PlacesEdit extends Component
{
    use LivewireAlert;

    public $uuid;
    public $name;
    public $description;
    public $active;

    protected $listeners = ['$refresh','setEditLocality',];

    public function render()
    {
        return view('admin.places.places-edit');
    }

    public function setEditLocality(Locality $locality)
    {

        $this->uuid        = $locality->id;
        $this->name        = $locality->name;
        $this->description = $locality->description;
        $this->active      = $locality->active;

    }
    
    public function update()
    {

        if ($this->uuid) {

            $places = Locality::find($this->uuid);

            $this->validate([
                'name' => ['required','min:3','max:50'],
                'description' => ['nullable', 'max:255'],
            ]); 
            
            $update = $places->update([
                'name'        => $this->name,
                'description' => $this->description,
                'active'      => $this->active,
            ]);

            if($update) {
               
                $this->emitTo('admin.places.places-index', '$refresh');

                $this->alert('success', 'Registro alterado com sucesso!', [           
                    'position' => 'bottom',
                    'timer'    => 5000,
                    'toast'    => true,
                    'customClass' => [
                        'popup' => 'bg-dark',
                        'title' => 'text-white',
                    ]
                ]);
                
            }

        }        

    }

    public function clear()
    {
        $this->reset();
        $this->resetValidation();
    }
}
