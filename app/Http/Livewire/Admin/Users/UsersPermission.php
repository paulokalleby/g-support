<?php

namespace App\Http\Livewire\Admin\Users;

use App\Models\Permission;
use App\Models\User;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;

class UsersPermission extends Component
{
    use LivewireAlert;

    public $user;
    public $userPermissions = [];
    public $permission = [];
    public $technician;

    protected $listeners = ['setPermissionUser'];

    public function mount()
    {
        
    }

    public function render()
    {
        $permissions = Permission::all();

        return view('admin.users.users-permission',[
            'permissions' => $permissions,
        ]);
    }

    public function cancel()
    {
        $this->reset();
    }

    public function setPermissionUser($uuid)
    {
        $this->user            = User::with('permissions')->whereId($uuid)->first();
        $this->technician      = $this->user->technician;
        $this->userPermissions = $this->user->permissions->pluck('id')->toArray();
        $this->permission      = array_fill_keys($this->userPermissions, true);
    }

    public function update()
    {

        foreach($this->permission as $k => $v) {

            if ($v == false ) {

                unset($this->permission[$k]);
            
            }
        }

        if( $this->user) {

            $this->user->permissions()->sync(array_keys($this->permission));
            $this->user->technician = $this->technician;
            $this->user->save();

            $this->alert('success', 'Permissões do usuário atualizadas!', [           
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


    public function clear()
    {
        $this->reset();
    }

}
