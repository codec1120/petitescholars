<?php

namespace App\Http\Livewire\Users\Staffs\Profile\EmployeeDataSheet;

use Livewire\Component;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;


use App\Models\{User, EmployeeEducation, EmployeeEmploymentExperience, EmployeeInfo, EmployeePresentPosition, DisclosureAgreement};
use App\Traits\EmployeeData;
use App\Traits\Fields\WithEmployeeDataFields;

class EmployeeDataForm extends Component
{
    use AuthorizesRequests, WithEmployeeDataFields, EmployeeData;

    public $route = 'staffs.profile.employee-data-sheet.employee-data-form';
    public $user; 
    public $edited = 0;
    public $message;

    public function mount(User $user)
    {
        $this->authorize('viewStaffProfile', $user);
        $this->getEmployeeDataSheetRecord();
        $this->user = $user;
        $this->edited = isset( $this->getEmployeeDataSheetRecord()['eds']['getEmployeeInfo']['created_at'] ) ? 1: 0 ;
        $this->employee['employee_name']            = $this->user->first_name.' '.$this->user->last_name;
        $this->employee['employee_title']           = $this->user->title ?? null;
        $this->employee['location']                 = $this->user->learning_center ?? null;
        $this->employee['email_address']            = $this->user->email;
        $this->employee['user_id']                  = $this->user->id;
        $this->education['user_id']                 = $this->user->id;
        $this->presentPosition['user_id']           = $this->user->id;
    }

    public function submit() {
        // Check user authorizaton
        $this->authorize('viewStaffProfile', $this->user);
        $user = $this->user;

        // Populate for saving/updating record
        $this->populateData( );
        
        // Set session message
        $this->alert('success', $this->edited ? "Employee data successfully updated." : "Employee data successfully save.");
        
        // Set $edited = true to change Button Text
        $this->edited = 1;
    }

    public function render()
    {
        return view('livewire.users.staffs.profile.employee-data-sheet.employee-data-form');
    }
}
