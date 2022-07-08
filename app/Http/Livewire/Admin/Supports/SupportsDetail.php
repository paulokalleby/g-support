<?php

namespace App\Http\Livewire\Admin\Supports;

use App\Models\Called;
use Livewire\Component;

class SupportsDetail extends Component
{
    public $uuid;
    public $identify = 0;
    public $requester = '';
    public $avatar_r = '';
    public $title =  '';
    public $problem = '';
    public $solution = '';
    public $created = '';
    public $updated = '';
    public $status = 'pending';

    protected $listeners = ['$refresh', 'setDetailSupport',];

    public function render()
    {
        return view('admin.supports.supports-detail');
    }

    public function setDetailSupport($uuid)
    {
        $called = Called::with('requester','attendance')->whereId($uuid)->first();

        $this->requester = $called->requester->name;
        $this->avatar_r  = $called->requester->avatar;
        $this->identify  = $called->identify;
        $this->title     = $called->title;
        $this->problem   = $called->problem;
        $this->solution  = $called->solution;
        $this->created   = $called->created_at;
        $this->updated   = $called->updated_at;
        $this->status    = $called->status;
    }

    public function clear()
    {
        $this->reset();
        $this->resetValidation();
    }
}
