<?php

namespace App\Http\Livewire\Admin\Categories;

use App\Models\Category;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;

class CategoriesCreate extends Component
{
    use LivewireAlert;
    
    public $name;

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
            'name' => ['required','string', 'min:3','max:50'],
        ]);

        Category::create([
            'name' => $this->name,
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
