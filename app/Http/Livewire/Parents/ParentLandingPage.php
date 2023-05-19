<?php

namespace App\Http\Livewire\Parents;

use Livewire\Component;
use App\Models\User;

class ParentLandingPage extends Component
{   
    public $name;
    public $user;

    public function mount ( User $user) {
        $this->name = $user['first_name'].' '.$user['last_name'];
        $this->user = $user;
    }

    public function registerChildren () {
        return redirect()->route('children.children-form.childre-form', $this->user);
    }

    public function render()
    {
        return view('livewire.parents.parent-landing-page');
    }
}
