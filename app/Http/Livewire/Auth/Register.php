<?php

namespace App\Http\Livewire\Auth;

use App\Models\User;
use Livewire\Component;

class Register extends Component
{
    public $name;
    public $email;
    public $password;
    public $confirm;

    protected $messages = [
        'email.required'    => 'Email é obrigatório.',
        'email.email'       => 'Informe um e-mail válido.',
        'password.required' => 'Senha é obrigatório.',
    ];

    public function render()
    {
        return view('auth.register');
    }

    public function store()
    {
        
        $this->validate([
            'name'     => ['required', 'string','max:50'],
            'email'    => ['required', 'string','max:120', 'email', "unique:users,email"],
            'password' => ['required','string','min:8', 'max:16'],
        ]);
        
        $store = User::create([
            'name'     => $this->name,
            'email'    => $this->email,
            'password' => bcrypt($this->password),
            'active'   => 1,
        ]);
    
        if($store) {
                    
            session()->flash('success', 'Registro realizado com sucesso!');

            $this->reset();

        } else {

            session()->flash('danger', 'Falha ao tentar registrar-se!');

        }
        

    
    }
}
