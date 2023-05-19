<?php

namespace App\Http\Livewire\Users\Profile;

use Illuminate\Support\Facades\Auth;
use Laravel\Fortify\Contracts\UpdatesUserProfileInformation;
use Livewire\Component;
use Livewire\WithFileUploads;

use App\Models\User;
use App\Traits\ParentForm;
use App\Traits\Fields\ParentFormFields;

class UpdateProfileInformationForm extends Component
{
    use WithFileUploads, ParentForm, ParentFormFields;

    /**
     * The component's state.
     *
     * @var array
     */
    public $state = [];
    public $user;

    /**
     * The new avatar for the user.
     *
     * @var mixed
     */
    public $photo;

    /**
     * Prepare the component.
     *
     * @return void
     */
    public function mount(User $user)
    {
        $this->user = $user;
        $this->state = $user->withoutRelations()->toArray();
        // Inserted new field under parent table
        $parentInfo = $this->getParentData( $this->user->id);
        
        $this->state['phone_type_1'] = $parentInfo['phone_type_1'];
        $this->state['address'] = $parentInfo['address'];
        $this->state['city'] = $parentInfo['city'];
        $this->state['state'] = $parentInfo['state'];
        $this->state['zip'] = $parentInfo['zip'];
    }

    /**
     * Update the user's profile information.
     *
     * @param  \Laravel\Fortify\Contracts\UpdatesUserProfileInformation  $updater
     * @return void
     */
    public function updateProfileInformation(UpdatesUserProfileInformation $updater)
    {
        $this->resetErrorBag();
      
        $this->user->role = $this->state['role'];

        if (  $this->user->role == 'parent') {
            $this->updateParent( $this->state );
        }

        $updater->update(
            $this->user,
            $this->photo
                ? array_merge($this->state, ['photo' => $this->photo])
                : $this->state
        );

        if (isset($this->photo)) {
            return redirect()->route('profile.show');
        }

        $this->emit('saved');
    }

    /**
     * Render the component.
     *
     * @return \Illuminate\View\View
     */
    public function render()
    {
        return view('livewire.users.profile.update-profile-information-form');
    }
}
