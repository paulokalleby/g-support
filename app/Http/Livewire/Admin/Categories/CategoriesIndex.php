<?php

namespace App\Http\Livewire\Admin\Categories;

use App\Models\Category;
use Livewire\Component;
use Livewire\WithPagination;

class CategoriesIndex extends Component
{
    use WithPagination;
 
    public $name   = '';
    public $status = '';
    public $pages  = 6;

    protected $paginationTheme = 'bootstrap';

    protected $listeners = ['$refresh'];

    public function resetFilters()
    {
        $this->reset();
    }

    public function updating()
    {
        $this->resetPage();
    }
    
    public function render()
    {
        $categories = Category::where('name', 'like', '%'.$this->name.'%')
                     ->where('active', 'like', '%'.$this->status.'%')
                     ->orderBy('name', 'ASC')
                     ->paginate($this->pages);

        return view('admin.categories.categories-index', [
            'categories' => $categories,
        ]);
        
    }

    public function openCreateModal()
    {
        $this->emitTo('admin.categories.categories-create','clean');
    }
}
