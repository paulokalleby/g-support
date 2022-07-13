<?php

namespace App\Http\Livewire\Admin\Supports;

use App\Models\Called;
use App\Models\Category;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;

class SupportsCreate extends Component
{
    use LivewireAlert;
    
    private $called;
    public $category;
    public $title;
    public $problem;
    public $status;
    public $requester;

    protected $listeners = ['$refresh'];

    public function mount()
    {
        $this->clear();
    }
    
    public function render()
    {
        $categories = Category::whereActive(1)
                              ->orderBy('name', 'ASC')
                              ->get();
            
        $requesters = User::whereActive(1)
                              ->orderBy('name', 'ASC')
                              ->get();

        return view('admin.supports.supports-create',[
            'categories' => $categories,
            'requesters' => $requesters
        ]);
    }

    public function store()
    {

        if(Auth::user()->technician) {
            $rules = [
                'requester' => ['required', 'exists:users,id', 'uuid'],
                'category'  => ['required', 'exists:categories,id', 'uuid'],
                'title'     => ['required', 'min:3','max:50'],
                'problem'   => ['required', 'min:3','max:1000'],
            ];
        } else {
            $rules = [
                'category' => ['required', 'exists:categories,id', 'uuid'],
                'title'    => ['required', 'min:3','max:50'],
                'problem'  => ['required', 'min:3','max:1000'],
            ];
        }

        $this->validate($rules);
        
        $identify = ( Called::count() + 1 );
        
        $called = Called::create([
            'category_id'  => $this->category,
            'requester_id' => $this->requester ?? '',
            'identify'     => $identify,
            'title'        => $this->title,
            'problem'      => $this->problem,
            'status'       => 'pending',
        ]);

        $called->timelines()->create([
            'label' => 'Aberto',
            'icon'  => 'fa-comment-alt',
            'color' => 'warning',
        ]);

        $this->emitTo('admin.supports.supports-index', '$refresh');

        $this->alert('success', 'Chamado aberto com sucesso!', [           
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
