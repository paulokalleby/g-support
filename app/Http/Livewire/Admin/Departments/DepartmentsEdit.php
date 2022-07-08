<?php

namespace App\Http\Livewire\Admin\Departments;

use App\Models\Department;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;

class DepartmentsEdit extends Component
{
    use LivewireAlert;

    public $uuid;
    public $name;
    public $active;

    protected $listeners = ['$refresh','setEditDepartment',];

    public function render()
    {
        return view('admin.departments.departments-edit');
    }

    public function setEditDepartment(Department $department)
    {

        $this->uuid   = $department->id;
        $this->name   = $department->name;
        $this->active = $department->active;

    }
    
    public function update()
    {

        if ($this->uuid) {

            $department = Department::find($this->uuid);

            $this->validate(['name' => ['required', 'max:50']]);      
            
            $update = $department->update([
                'name'   => $this->name,
                'active' => $this->active,
            ]);

            if($update) {
               
                $this->emitTo('admin.departments.departments-index', '$refresh');

                
                $this->alert('success', 'Registro alterado com sucesso!', [           
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
