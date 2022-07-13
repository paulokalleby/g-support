<?php

namespace App\Http\Livewire\Admin\Supports;

use App\Models\Called;
use App\Models\Timeline;
use Illuminate\Support\Facades\Auth;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;

class SupportsDetail extends Component
{

    use LivewireAlert;
    
    public $called;
    public $uuid;
    public $identify = 0;
    public $requester = '';
    public $avatar_r = '';
    public $attendance_id = '';
    public $attendance = '';
    public $avatar_a = '';
    public $title =  '';
    public $problem = '';
    public $solution = '';
    public $created = '';
    public $updated = '';
    public $status = 'pending';
    public $active;
    public $timelines = [];

    protected $listeners = ['$refresh', 'setDetailSupport',];

    public function render()
    {
        return view('admin.supports.supports-detail');
    }

    public function setDetailSupport($uuid)
    {

        $this->called    = Called::with('requester','attendance')->whereId($uuid)->first();
        $this->timelines = Timeline::where('called_id', $uuid)->orderBy('created_at')->get();

        $this->requester     = $this->called->requester->name;
        $this->avatar_r      = $this->called->requester->avatar;
        $this->attendance_id = $this->called->attendance_id ?? '';
        $this->attendance    = $this->called->attendance->name ?? '';
        $this->avatar_a      = $this->called->attendance->avatar ?? '';
        $this->identify      = $this->called->identify;
        $this->title         = $this->called->title;
        $this->problem       = $this->called->problem;
        $this->solution      = $this->called->solution;
        $this->created       = $this->called->created_at;
        $this->updated       = $this->called->updated_at;
        $this->status        = $this->called->status;
        //$this->timelines     = $this->called->timelines;
        $this->active        = $this->called->active;

    }

    public function toMeet()
    {
        if($this->called) {

            $this->called->attendance_id = Auth::user()->id;
            $this->called->status = 'attending';
            $this->called->save();

            $this->called->timelines()->create([
                'label' => 'Em Atendimento',
                'icon'  => 'fa-comment-alt-dots',
                'color' => 'info',
            ]);

            $this->setDetailSupport($this->called->id);

            $this->emitTo('admin.supports.supports-index', '$refresh');

            $this->alert('success', 'Atendimento iniciado!', [           
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

    public function finishing()
    {
        if($this->called) {

            $this->validate([
                'solution' => ['required','string', 'min:3','max:1000'],
            ]);

            $this->called->solution = $this->solution;
            $this->called->status   = 'solved';
            $this->called->active   = 0;
            $this->called->save();

            $this->called->timelines()->create([
                'label' => 'Solucionado',
                'icon'  => 'fa-comment-alt-check',
                'color' => 'success',
            ]);

            $this->setDetailSupport($this->called->id);

            $this->emitTo('admin.supports.supports-index', '$refresh');

            $this->alert('success', 'Chamado solucionado com sucesso!', [           
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
        $this->resetValidation();
    }
}
