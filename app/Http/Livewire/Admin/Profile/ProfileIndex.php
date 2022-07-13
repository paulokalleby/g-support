<?php

namespace App\Http\Livewire\Admin\Profile;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithFileUploads;

class ProfileIndex extends Component
{
    use WithFileUploads, LivewireAlert;

    public $uuid; 
    public $name; 
    public $email;
    public $password;
    public $confirm; 
    public $avatar;
    public $photo;
    public $user;
    public $cell;
    public $technician;

    public function mount()
    {
        $this->setProfile();
    }

    private function setProfile()
    {
        $this->user = User::with('permissions')->find(Auth::id());

        $this->uuid       = $this->user->id;
        $this->name       = $this->user->name;
        $this->email      = $this->user->email;
        $this->avatar     = $this->user->avatar;
        $this->cell       = $this->user->cell;
        $this->technician = $this->user->technician;
        $this->password   = '';
        $this->confirm    = '';
        
    }

    public function render()
    {
        return view('admin.profile.profile-index');
    }

    public function updateProfile()
    {
        $this->validate([
            'name'  => ['required','string', 'max:50'],
            'email' => [
                'required',
                'max:120',
                'email', 
                "unique:users,email,{$this->uuid},id",
            ],
            'cell'  => ['nullable', 'celular_com_ddd'],
        ]);

        $this->user->update([
            'name'  => $this->name,
            'email' => $this->email,
            'cell'  => $this->cell,
        ]);

        $this->emit('$refresh');

        $this->alert('success', 'Dados do perfil atualizados com sucesso!', [           
            'position' => 'bottom',
            'timer'    => 5000,
            'toast'    => true,
            'customClass' => [
                'popup' => 'bg-dark',
                'title' => 'text-white',
            ]
        ]);
        
    }

    public function updatePassword()
    {
        $this->validate([
            'password' => ['required','min:8','max:16'],
            'confirm'  => ['required','same:password'],
        ]);        
        
        $this->user->update(['password' => bcrypt($this->password)]);

        $this->reset(['password', 'confirm']);

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


    public function uploadAvatar()
    {
        $this->validate([
            'photo' => ['required','image','mimes:jpeg,png,jpg','max:1024'] // 1MB Max
        ]);

        if ($this->avatar != null && Storage::disk('public')->exists($this->avatar)) {

            Storage::disk('public')->delete($this->avatar);

        }

        $image = $this->photo->store('images','public');
    
        
        $this->user->avatar = $image;
        $this->user->save();
        
        $this->avatar = $image;

        $this->reset('photo');

        $this->emit('$refresh');

        $this->alert('success', 'Logo atualizada com sucesso!', [           
            'position' => 'bottom',
            'timer'    => 5000,
            'toast'    => true,
            'customClass' => [
                'popup' => 'bg-dark',
                'title' => 'text-white',
            ]
        ]);
    }

    public function uploadCancel()
    {
        $this->reset('photo');
    }

    public function clear()
    {
        $this->setProfile();
        $this->resetValidation();
    }
}
