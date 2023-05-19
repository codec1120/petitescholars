<?php

namespace App\Http\Livewire\Guest;

use Livewire\Component;
use App\Traits\Fields\LoginUserCreationFields;
use App\Traits\LoginUserCreationData;

class CreateUser extends Component
{
    use LoginUserCreationFields, LoginUserCreationData;


    public $userCreated = false;

    protected function passwordRules()
    {
        return ['required', 'string', new Password, 'confirmed'];
    }
    
    public function mount () {
        $this->formFields;    
    }

    public function submit () {
        // Validate Required Fields
        $this->validate();

        $this->userCreated = $this->createUser();  

        if ( $this->userCreated ) {
            $this->formFields['first_name'] = null;
            $this->formFields['last_name'] = null;
            $this->formFields['email'] = null;
            $this->formFields['password'] = null;
            $this->formFields['phone_number'] = null;
        }
    }

    public function render()
    {
        return view('livewire.guest.create-user')
            ->layout('layouts.guest');
    }
}
