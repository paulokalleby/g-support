<?php

namespace App\Http\Livewire\Admin\Users;

use App\Models\User;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;

class UsersPassword extends Component
{
    use LivewireAlert;

    public $uuid;
    public $name;
    public $password;
    public $confirm;

    protected $listeners = ['$refresh', 'setPasswordUser',];

    public function render()
    {        
        return view('admin.users.users-password');
    }

    public function setPasswordUser(User $user)
    {
        $this->uuid = $user->id;
        $this->name = $user->name;
    }

    public function update()
    {

        if ($this->uuid) {

            $user = User::find($this->uuid);

            $this->validate([
                'password' => ['required', 'same:confirm', 'min:8', 'max:16'],
                'confirm'  => ['required', 'same:password'],
            ]);

            $update = $user->update([
                'password' => bcrypt($this->password),
            ]);

            if ($update) {

                $this->emitTo('admin.users.users-index', '$refresh');

                $this->password = '';
                $this->confirm = '';

                $this->alert('success', 'Senha alterada com sucesso!', [           
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
