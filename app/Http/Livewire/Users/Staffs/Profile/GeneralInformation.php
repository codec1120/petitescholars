<?php

namespace App\Http\Livewire\Users\Staffs\Profile;

use Livewire\Component;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

use App\Models\User;
use App\Traits\Fields\WithStaffFields;

use Carbon\Carbon;

class GeneralInformation extends Component
{
    use AuthorizesRequests, WithStaffFields;

    public $editing = false;
    public $route = 'staffs.profile.general';

    public function mount(User $user)
    {
        $this->authorize('viewStaffProfile', $user);
        
        $this->user = $user;
        $this->syncFields();
    }

    public function syncFields()
    {
        $this->generalInfoFields = array_merge($this->generalInfoFields, $this->user->getGeneralInfo());
    }

    public function submit()
    {
        $this->authorize('viewStaffProfile', $this->user);

        $this->validate(
            $this->generalInfoValidationRules(),
            $this->validationMessages(),
            $this->generalInfoValidationAttributes()
        );
       
        $user = $this->user;
        $user->update(collect($this->generalInfoFields)->only([
            'email',
            'phone_number'
        ])->toArray());

        $user->saveProfileFields($this->generalInfoFields);

        session()->flash('success', 'Changes saved!');

        return redirect()->route($this->route, $this->user);
    }

    public function render()
    {
        return view('livewire.users.staffs.profile.general-information', [
            'generalInfos' => $this->user->getGeneralInfoForHumans()
        ]);
    }
}
