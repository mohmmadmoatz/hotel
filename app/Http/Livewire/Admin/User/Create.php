<?php

namespace App\Http\Livewire\Admin\User;

use App\Models\User;
use Livewire\Component;
use Livewire\WithFileUploads;

use Illuminate\Support\Facades\Artisan;

class Create extends Component
{
    use WithFileUploads;

    public $name;
    public $email;
    public $password;
    public $role;
    
    protected $rules = [
        'name' => 'required',
        'email' => 'required',
        'password' => 'required',
        'role' => 'required',        
    ];

    public function updated($input)
    {
        $this->validateOnly($input);
    }

    public function create()
    {
        if($this->getRules())
            $this->validate();

        $this->dispatchBrowserEvent('show-message', ['type' => 'success', 'message' => __('CreatedMessage', ['name' => __('User') ])]);
        
        $user = User::create([
            'name' => $this->name,            'email' => $this->email,
            'password' => bcrypt($this->password),
            'role' => $this->role,            
        ]);

        // call artisan 

        Artisan::call('panel:add ' . $user->id);

        $this->reset();
    }

    public function render()
    {
        return view('livewire.admin.user.create')
            ->layout('admin::layouts.app', ['title' => __('CreateTitle', ['name' => __('User') ])]);
    }
}
