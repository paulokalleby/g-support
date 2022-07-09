<?php

namespace App\Http\Livewire\Admin\Users;

use App\Models\Department;
use App\Models\Locality;
use App\Models\User;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;

class UsersEdit extends Component
{
    use LivewireAlert;

    public $uuid;
    public $name;
    public $email;
    public $locality;
    public $department;
    public $technician;
    public $password;
    public $confirm;
    public $active;

    protected $listeners = ['$refresh', 'setEditUser',];

    public function render()
    {
        $localities  = Locality::whereActive(1)->get();
        $departments = Department::whereActive(1)->get();

        return view('admin.users.users-edit', [
            'localities'  => $localities,
            'departments' => $departments,
        ]);
    }

    public function setEditUser(User $user)
    {
        $this->uuid       = $user->id;
        $this->name       = $user->name;
        $this->email      = $user->email;
        $this->locality   = $user->locality_id;
        $this->department = $user->department_id;
        $this->technician = $user->technician;
        $this->password   = '';
        $this->active     = $user->active;
    }

    public function update()
    {

        if ($this->uuid) {

            $user = User::find($this->uuid);

            $this->validate([
                'locality'   => ['required', 'exists:localities,id', 'uuid'],
                'department' => ['required', 'exists:departments,id', 'uuid'],
                'name'       => ['required', 'string','min:3', 'max:50'],
                'email'      => ['required', 'string', 'max:120', 'email', "unique:users,email,{$this->uuid},id"],
                'password'   => ['nullable', 'same:confirm', 'min:6', 'max:16'],
                'confirm'    => ['nullable', 'same:password'],
            ]);

            if ($this->password != '') {

                $update = $user->update([
                    'name'          => $this->name,
                    'email'         => $this->email,
                    'locality_id'   => $this->locality,
                    'department_id' => $this->department,
                    'technician'    => $this->technician,
                    'password'      => bcrypt($this->password),
                    'active'        => $this->active,
                ]);

            } else {

                $update = $user->update([
                    'name'          => $this->name,
                    'email'         => $this->email,
                    'locality_id'   => $this->locality,
                    'department_id' => $this->department,
                    'technician'    => $this->technician,
                    'active'        => $this->active,
                ]);

            }

            if ($update) {

                $this->emitTo('admin.users.users-index', '$refresh');

                $this->alert('success', 'Usuário alterado com sucesso!', [
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
