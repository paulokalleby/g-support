<?php

namespace App\Http\Livewire\Admin\Users;

use App\Models\User;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;

class UsersDelete extends Component
{
    use LivewireAlert;
    
    public $uuid;

    protected $listeners = ['setDeleteUser'];

    public function render()
    {
        return view('admin.users.users-delete');
    }

    public function cancel()
    {
        $this->reset();
    }

    public function setDeleteUser($uuid)
    {
        $this->uuid = $uuid;
    }

    public function delete(User $user)
    {

        $user->delete();

        $this->emitTo('admin.users.users-index', '$refresh');

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
