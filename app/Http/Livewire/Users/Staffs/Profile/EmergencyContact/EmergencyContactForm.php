<?php

namespace App\Http\Livewire\Users\Staffs\Profile\EmergencyContact;

use Livewire\Component;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

use App\Models\{User};
use App\Traits\Fields\{WithEmergencyContactFields, WithEmployeeDataFields};
use App\Traits\EmergencyContactData;

class EmergencyContactForm extends Component
{
    use AuthorizesRequests, WithEmergencyContactFields, EmergencyContactData, WithEmployeeDataFields;
    
    public $user; 
    public $route = 'staffs.profile.emergency-contact.emergency-contact-form';
    public $edited = 0;

    public function mount(User $user)
    {
        $this->authorize('viewStaffProfile', $user);
        $this->user = $user;
        
        $address = $user->getMeta('address') ? "{$user->getMeta('address')}": ''; 
        $city = $user->getMeta('city') ? " {$user->getMeta('city')}": ''; 
        $state = $user->getMeta('state') ? ",{$user->getMeta('state')}": ''; 
        $zip = $user->getMeta('zip') ? "{$user->getMeta('zip')}": ''; 
        
        $this->employee['address'] = trim(substr(" {$address} {$city} {$state} {$zip}", 1),',');
    }



    public function submit () {
        // Check user authorizaton
        $this->authorize('viewStaffProfile', $this->user);

        $user = $this->user;

        // Populate Record
        $return_populate = $this->populate();

        // Set session message
        if ($return_populate) {
            $this->alert('success', "Emergency Contact Successfully Created.");
            $this->edited = true;
        }
    }


    public function render()
    {
        return view('livewire.users.staffs.profile.emergency-contact.emergency-contact-form', $this->syncEmployeeInfoAndContactForm());
    }
}
