<?php

namespace App\Http\Livewire\Admin\Users;

use App\Models\Department;
use App\Models\Locality;
use App\Models\User;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;

class UsersCreate extends Component
{
    use LivewireAlert;

    public $name;
    public $email;
    public $locality;
    public $department;
    public $password;
    public $confirm;
    public $active = 1;

    protected $listeners = ['$refresh'];

    public function mount()
    {
        $this->clear();
    }

    public function render()
    {
        $localities  = Locality::whereActive(1)->get();
        $departments = Department::whereActive(1)->get();

        return view('admin.users.users-create',[
            'localities'  => $localities,
            'departments' => $departments,
        ]);
    }

    public function store()
    {
        $this->validate([
            'locality'   => ['required', 'exists:localities,id', 'uuid'],
            'department' => ['required', 'exists:departments,id', 'uuid'],
            'name'       => ['required', 'string', 'max:50'],
            'email'      => ['required', 'string', 'max:120', 'email', "unique:users,email"],
            'password'   => ['required', 'same:confirm', 'min:8', 'max:16'],
            'confirm'    => ['required', 'same:password'],
        ]);

        User::create([
            'locality_id'   => $this->locality,
            'department_id' => $this->department,
            'name'          => $this->name,
            'email'         => $this->email,
            'password'      => bcrypt($this->password),
            'active'        => $this->active,
        ]);

        $this->emitTo('admin.users.users-index', '$refresh');

        $this->alert('success', 'Usuário cadastrado com sucesso!', [           
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
