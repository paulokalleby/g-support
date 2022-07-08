<?php

namespace App\Http\Livewire\Admin\Places;

use App\Models\Department;
use Livewire\Component;

class PlacesDelete extends Component
{
    public $uuid;

    protected $listeners = ['setDeleteLocality'];

    public function render()
    {
        return view('admin.places.places-delete');
    }

    public function cancel()
    {
        $this->reset();
    }

    public function setDeleteLocality($uuid)
    {
        $this->uuid = $uuid;
    }

    public function delete($uuid)
    {
        if($uuid){

            Department::whereId($uuid)->delete();
            
            $this->emitTo('admin.places.places-index', '$refresh');

        }

    }
}
