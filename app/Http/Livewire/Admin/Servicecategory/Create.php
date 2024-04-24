<?php

namespace App\Http\Livewire\Admin\Servicecategory;

use App\Models\Servicecategory;
use Livewire\Component;
use Livewire\WithFileUploads;

class Create extends Component
{
    use WithFileUploads;

    public $name;
    public $printer;
    
    public $printers;

    protected $rules = [
        'name' => 'required',        
    ];

    public function updated($input)
    {
        $this->validateOnly($input);
    }

    function getPrintersWindows() {

        $value = shell_exec('wmic printer list brief');

        $lines = explode("\n", $value);
        $printerNames = [];
        foreach ($lines as $line) {
            $printerNames[] = trim(substr($line, 0, 40));
        }
        
        array_shift($printerNames);

        $printerNames = array_filter($printerNames);
        $this->printers = $printerNames;
    }

    function mount() {
        
       $this->getPrintersWindows();
        

    }

    public function create()
    {
        if($this->getRules())
            $this->validate();

        $this->dispatchBrowserEvent('show-message', ['type' => 'success', 'message' => __('CreatedMessage', ['name' => __('Servicecategory') ])]);
        
        Servicecategory::create([
            'name' => $this->name,            'printer' => $this->printer,            
        ]);

        $this->reset();
        $this->getPrintersWindows();
    }

    public function render()
    {
        return view('livewire.admin.servicecategory.create')
            ->layout('admin::layouts.app', ['title' => __('CreateTitle', ['name' => __('Servicecategory') ])]);
    }
}
