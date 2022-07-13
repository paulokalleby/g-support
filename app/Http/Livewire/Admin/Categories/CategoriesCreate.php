<?php

namespace App\Http\Livewire\Admin\Categories;

use App\Models\Category;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Illuminate\Validation\Rule;
use Livewire\Component;

class CategoriesCreate extends Component
{
    use LivewireAlert;
    
    public $name;
    public $priority;

    protected $listeners = ['$refresh'];

    public function mount()
    {
        $this->clear();
    }
    
    public function render()
    {
        return view('admin.categories.categories-create');
    }

    public function store()
    {
 
        $this->validate([
            'name'     => ['required','string', 'min:3','max:50'],
            'priority' => ['required', Rule::in(array_keys(config('enums.priority')))],
        ]);

        Category::create([
            'name'     => $this->name,
            'priority' => $this->priority,
        ]);

        $this->emitTo('admin.categories.categories-index', '$refresh');
        
        $this->alert('success', 'Categoria cadastrada com sucesso!', [           
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
