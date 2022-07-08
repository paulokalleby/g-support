<?php

namespace App\Http\Livewire\Admin\Departments;

use App\Models\Department;
use Livewire\Component;
use Livewire\WithPagination;

class DepartmentsIndex extends Component
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
                     
        $departments = Department::with('users')
                                ->where('name', 'like', '%'.$this->name.'%')
                                ->where('active', 'like', '%'.$this->status.'%')
                                ->orderBy('name', 'ASC')
                                ->paginate($this->pages);

        return view('admin.departments.departments-index', [
            'departments' => $departments,
        ]);

    }

    public function openCreateModal()
    {
        $this->emitTo('admin.departments.departments-create','clean');
    }
}
