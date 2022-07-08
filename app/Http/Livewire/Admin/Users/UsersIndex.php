<?php

namespace App\Http\Livewire\Admin\Users;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class UsersIndex extends Component
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
        $users = User::where('name', 'like', '%' . $this->name . '%')
            ->where('active', 'like', '%' . $this->status . '%')
            ->orderBy('name', 'ASC')
            ->paginate($this->pages);

        return view('admin.users.users-index', [
            'users' => $users,
        ]);
    }

    public function test($uuid)
    {
        dd('UUID: ' . $uuid);
    }

    public function openCreateModal()
    {
        $this->emitTo('admin.users.users-create', 'clean');
    }
}
