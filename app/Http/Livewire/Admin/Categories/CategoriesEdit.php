<?php

namespace App\Http\Livewire\Admin\Categories;

use App\Models\Category;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;

class CategoriesEdit extends Component
{

    use LivewireAlert;
    
    public $uuid;
    public $name;
    public $active;
    
    protected $listeners = ['$refresh','setEditCategory'];

    public function render()
    {
        return view('admin.categories.categories-edit');
    }

    public function setEditCategory(Category $category)
    {
        $this->uuid   = $category->id;
        $this->name   = $category->name;
        $this->active = $category->active;
    }
    
    public function update()
    {

        if ($this->uuid) {

            $category = Category::whereId($this->uuid)->first();

            $this->validate([
                'name' => ['required','string', 'min:3','max:50'],
            ]);      

            $update = $category->update([
                'name'   => $this->name,
                'active' => $this->active,
            ]);

            if($update) {
               
                $this->emitTo('admin.categories.categories-index', '$refresh');

                $this->alert('success', 'Categoria alterada com sucesso!', [           
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
