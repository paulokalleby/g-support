<?php

namespace App\Http\Livewire\Admin\Departments;

use App\Models\Department;
use Livewire\Component;

class DepartmentsDelete extends Component
{
    public $uuid;

    protected $listeners = ['setDeleteDepartment'];

    public function render()
    {
        return view('admin.departments.departments-delete');
    }

    public function cancel()
    {
        $this->reset();
    }

    public function setDeleteDepartment($uuid)
    {
        $this->uuid = $uuid;
    }

    public function delete($uuid)
    {
        if($uuid){

            Department::whereId($uuid)->delete();
            
            $this->emitTo('admin.departments.departments-index', '$refresh');

        }

    }
}
