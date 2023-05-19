<?php

namespace App\Http\Livewire\Users\Staffs\Profile;

use Livewire\Component;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

use App\Traits\Fields\WithStaffFields;

use App\Models\{StaffTitle, StaffReview, User};

use Illuminate\Support\Carbon;

use Illuminate\Support\Facades\Storage;

class Training extends Component
{
    use AuthorizesRequests, WithStaffFields;

    public $editing = false;
    public $route = 'staffs.profile.training';
    public $disableUploadButtonForThisFields = ['SQ 3.4.3', 'SQ 3.4.4', 'SQ 3.4.5', 'SQ 3.4.6', 'SQ 3.4.7', 'SQ 3.4.8', 'SQ 3.4.9'];
    public $emergencyPlanModal = false;
    public $viewemergencyPlanModal = false;
    public $showAcceptBtnForEmergencyPlan = false;
    public $acceptEmergencyPlan = false;
    public $acceptEmergencyPlanChecker = false;
    public $viewModal = false;
    public $view_modal_title;
    public $view_modal_description;
    public $view_modal_tempURL;
    public $disk = 'spaces';

    public function mount(User $user)
    {
        $this->authorize('viewStaffProfile', $user);
        $disableUploadButtonForThisFields;
        $this->user = $user;
        $this->syncFields();
    }

    public function syncFields()
    {
        $this->trainingFields = array_merge($this->trainingFields, $this->user->getTrainingInfo());
    }

    public function submit()
    {
        $this->authorize('viewStaffProfile', $this->user);

        // Validate SQ Date
        $SQ_FIELD = ['s_q343', 's_q344', 's_q345', 's_q346', 's_q347', 's_q348', 's_q349'];

        foreach($this->trainingFields as $key => $value) {
            if (in_array($key, $SQ_FIELD) 
                && empty($value[$key.'_date_compilation_key'])
                && $value['value'] == 'Completed') {
                $this->addError('trainingFields.'.$key.'.'.$key.'_date_compilation_key', $value['label'].' Date is required.');
                return $this->addError('modal', 'Please fill-up all required fields.');
            } else if (in_array($key, $SQ_FIELD) 
            && !empty($value[$key.'_date_compilation_key'])
            && $value['value'] != 'Completed') {
                $this->trainingFields[$key][$key.'_date_compilation_key'] = null;
            }
        }
        
        $this->resetErrorBag();
        $this->resetValidation();

        $user = $this->user;
        $user->saveProfileFields($this->trainingFields);

        return redirect()->route($this->route, $this->user);
    }

    public function render()
    {
        return view('livewire.users.staffs.profile.training', [
            'trainings' => $this->user->getTrainingInfo()
        ]);
    }

    public function acceptEmergencyPlan (StaffTitle $staff)
    {
        $user = $this->user;
        $user->saveProfileFields([ 'emergency_plan' =>Carbon::now()->format('Y-m-d') ]);
        return $this->emergencyPlanModal = false;
    }

    public function acceptEmergencyPlanAgreement ()
    {
        if ($this->acceptEmergencyPlanChecker) {
            $this->acceptEmergencyPlanChecker = false;
            $this->showAcceptBtnForEmergencyPlan = false;
        } else {
            $this->acceptEmergencyPlanChecker = true;
            $this->showAcceptBtnForEmergencyPlan = true;
        }
    }

    public function cancel()
    {
        $this->emergencyPlanModal = false;
        $this->showAcceptBtnForEmergencyPlan = false;
        $this->acceptEmergencyPlanChecker = false;
    }

    public function viewEmergencyPlan ()
    {
        $this->emergencyPlanModal = true;
        $this->viewemergencyPlanModal = true;
    }

    public function setEmpDataSheetModal($title, $slug)
    {
        $this->viewModal = true;
        $this->view_modal_title = $title;
        $url = $this->user->getMedia($slug)[0]['directory']."/".$this->user->getMedia($slug)[0]['filename'].".".$this->user->getMedia($slug)[0]['extension'];
        $this->view_modal_tempURL = Storage::disk($this->disk)->temporaryUrl($url, now()->addMinutes(30));
    }
}
