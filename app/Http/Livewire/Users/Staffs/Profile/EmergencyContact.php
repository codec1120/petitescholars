<?php

namespace App\Http\Livewire\Users\Staffs\Profile;

use Livewire\Component;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

use App\Traits\Fields\{WithEmergencyContactFields, WithEmployeeDataFields};
use App\Traits\EmergencyContactData;

use App\Models\{User};

use Illuminate\Support\Facades\Storage;
use PDF;

class EmergencyContact extends Component
{
    use AuthorizesRequests, WithEmergencyContactFields, EmergencyContactData, WithEmployeeDataFields;
    
    public $user; 
    public $route = 'staffs.profile.emergency-contact';
    public $enableForm = 0;
    public $viewForm = 0;

    public function mount(User $user)
    {
        $this->authorize('viewStaffProfile', $user);
        $this->user = $user;
        $this->emergencyContactFields['modified_date'] = carbon( $this->emergencyContactFields['updated_at'] )->format('Y-m-d');
    }

    public function enableContactForm () {
        return redirect()->route('staffs.profile.emergency-contact.emergency-contact-form', $this->user);
    }

    public function printPDF () {
        $data = $this->syncEmployeeInfoAndContactForm();
        $filename = "EmployeeEmergencyContact.pdf";
        $data['user'] = $this->user;
        $data['brand_src'] = asset('static/brand/logo.png');
     
        if (Storage::disk('spaces')->has($filename)) {
            Storage::disk('spaces')->delete($filename);
        }
        
        $pdf = PDF::loadView(
            'printables.staff.emergency-contact-form-print', // resources/views/printables/print.blade.php
            $data
        )->output();
        
        Storage::disk('spaces')->put($filename, $pdf);
        return Storage::disk('spaces')->download($filename);
    }

    public function render()
    {
        return view( 'livewire.users.staffs.profile.emergency-contact', $this->syncEmployeeInfoAndContactForm() );
    }
}
