<?php

namespace App\Http\Livewire\Users\Staffs\Profile;

use Livewire\Component;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

use App\Models\User;
use App\Traits\Fields\WithStaffFields;
use Illuminate\Support\Facades\Storage;

class Education extends Component
{
    use AuthorizesRequests, WithStaffFields;

    public $user;
    public $icon = 'pencil';
    public $editing = false;
    public $route = 'staffs.profile.education';
    public $viewModal = false;
    public $view_modal_title;
    public $view_modal_description;
    public $view_modal_tempURL;
    public $disk = 'spaces';

    public function mount(User $user)
    {
        $this->authorize('viewStaffProfile', $user);

        $this->user = $user;
        $this->syncFields();
    }

    public function syncFields()
    {
        $this->educationInfoFields = array_merge($this->educationInfoFields, $this->user->getEducationInfo());
    }

    public function submit()
    {
        $this->authorize('viewStaffProfile', $this->user);

        $user = $this->user;
        $user->saveProfileFields($this->educationInfoFields);

        return redirect()->route($this->route, $this->user);
    }

    public function setEmpDataSheetModal($title, $slug)
    {
        $this->viewModal = true;
        $this->view_modal_title = $title;
        $url = $this->user->getMedia($slug)[0]['directory']."/".$this->user->getMedia($slug)[0]['filename'].".".$this->user->getMedia($slug)[0]['extension'];
        $this->view_modal_tempURL = Storage::disk($this->disk)->temporaryUrl($url, now()->addMinutes(30));
    }

    public function render()
    {
        return view('livewire.users.staffs.profile.education', [
            'education' => $this->user->getEducationInfoForHumans()
        ]);
    }
}
