<?php

namespace App\Http\Livewire\Admin\Departments;

use App\Models\Department;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;

class DepartmentsCreate extends Component
{
    use LivewireAlert;
    
    public $name;
    public $active = 0;

    protected $listeners = ['$refresh'];

    public function mount()
    {
        $this->clear();
    }
    
    public function render()
    {
        return view('admin.departments.departments-create');
    }

    public function store()
    {
        $this->validate([
            'name' => ['required', 'max:50'],
        ]);
        
        Department::create(['name'   => $this->name]);

        $this->emitTo('admin.departments.departments-index', '$refresh');

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
