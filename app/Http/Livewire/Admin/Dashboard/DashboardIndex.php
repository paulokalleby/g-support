<?php

namespace App\Http\Livewire\Admin\Dashboard;

use Livewire\Component;

class DashboardIndex extends Component
{

    public $name = '';
    
    public function render()
    {
        return view('admin.dashboard.dashboard-index');
    }
}
