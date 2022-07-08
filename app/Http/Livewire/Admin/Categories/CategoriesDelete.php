<?php

namespace App\Http\Livewire\Admin\Categories;

use App\Models\Category;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;

class CategoriesDelete extends Component
{
    use LivewireAlert;

    public $uuid;

    protected $listeners = ['setDeleteCategory'];

    public function render()
    {
        return view('admin.categories.categories-delete');
    }

    public function cancel()
    {
        $this->reset();
    }

    public function setDeleteCategory($uuid)
    {
        $this->uuid = $uuid;
    }

    public function delete(Category $category)
    {
        $category->delete();

        $this->emitTo('admin.categories.categories-index', '$refresh');

        $this->alert('success', 'Registro excluido com sucesso!', [           
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
