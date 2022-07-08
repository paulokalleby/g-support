<?php

namespace App\Http\Livewire\Admin\Settings;

use App\Models\Setting;
use App\Traits\FindCepTrait;
use Illuminate\Support\Facades\Storage;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithFileUploads;

class SettingsIndex extends Component
{
    use WithFileUploads, FindCepTrait, LivewireAlert;

    public $name;
    public $url;
    public $logo;
    public $photo;
    public $setting;

    protected $listeners = ['$refresh'];

    public function mount()
    {
        $this->setSettings();
    }

    public function render()
    {
        return view('admin.settings.settings-index');
    }

    public function updateData()
    {
        $this->validate([
            'name'=> ['nullable','string','min:3', 'max:50'],
            'url' => ['nullable','url','max:255'],
        ]);

        $this->setting->name  = $this->name;
        $this->setting->url   = $this->url;
        $this->setting->save();

        $this->alert('success', 'Dados atualizados com sucesso!', [           
            'position' => 'bottom',
            'timer'    => 5000,
            'toast'    => true,
            'customClass' => [
                'popup' => 'bg-dark',
                'title' => 'text-white',
            ]
        ]);

    }

    public function setSettings()
    {
        $this->setting = Setting::first();

        $this->name    = $this->setting->name;
        $this->url     = $this->setting->url;
        $this->logo    = $this->setting->logo;

        $this->resetValidation();
    }

    public function uploadLogo()
    {
        $this->validate([
            'photo' => ['required','image', 'mimes:jpeg,png,jpg,webp','max:1024'] // 1MB Max
        ]);

        if ($this->logo != null && Storage::disk('public')->exists($this->logo)) {

            Storage::disk('public')->delete($this->logo);

        }

        $image = $this->photo->store('images','public');
        
        $this->setting->logo = $image;
        $this->setting->save();

        $this->logo = $image;

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
        $this->setSettings();
       
    }
}
