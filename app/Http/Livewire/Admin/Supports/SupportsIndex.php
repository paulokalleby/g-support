<?php

namespace App\Http\Livewire\Admin\Supports;

use App\Models\Called;
use App\Models\Category;
use Livewire\Component;
use Livewire\WithPagination;

class SupportsIndex extends Component
{
    use WithPagination;
 
    public $identify = '';
    public $category = '';
    public $search = '';
    public $status = '';
    public $active = 1;

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

        $categories = Category::whereActive(1)
                        ->orderBy('name', 'ASC')
                        ->get();
                        
        $calleds = Called::with('category', 'requester')
                        ->where('identify', 'like', '%'.$this->identify.'%')
                        ->where('category_id', 'like', '%'.$this->category.'%')
                        ->where('title', 'like', '%'.$this->search.'%')
                        ->where('status', 'like', '%'.$this->status.'%')
                        ->whereActive($this->active)
                        ->orderByDesc('updated_at')
                        ->paginate();

        return view('admin.supports.supports-index', [
            'categories' => $categories,
            'calleds'    => $calleds,
        ]);

    }

    public function openCreateModal()
    {
        $this->emitTo('admin.supports.supports-create','clean');
    }

}
