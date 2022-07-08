<?php

namespace App\Http\Livewire\Admin\Places;

use App\Models\Locality;
use Livewire\Component;
use Livewire\WithPagination;

class PlacesIndex extends Component
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

        $places = Locality::with('users')
                                ->where('name', 'like', '%'.$this->name.'%')
                                ->where('active', 'like', '%'.$this->status.'%')
                                ->orderBy('name', 'ASC')
                                ->paginate($this->pages);

        return view('admin.places.places-index', [
            'places' => $places,
        ]);

    }

    public function openCreateModal()
    {
        $this->emitTo('admin.places.places-create','clean');
    }
}
