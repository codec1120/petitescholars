<?php

namespace App\Http\Livewire\Users\Profile;

use Illuminate\Contracts\Auth\StatefulGuard;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Laravel\Jetstream\Contracts\DeletesUsers;
use Livewire\Component;

class DeleteUserForm extends Component
{
    /**
     * Indicates if user deletion is being confirmed.
     *
     * @var bool
     */
    public $confirmingUserDeletion = false;

    /**
     * The user's current password.
     *
     * @var string
     */
    public $password = '';

    /**
     * Confirm that the user would like to delete their account.
     *
     * @return void
     */
    public function confirmUserDeletion()
    {
        $this->password = '';

        $this->dispatchBrowserEvent('confirming-delete-user');

        $this->confirmingUserDeletion = true;
    }

    /**
     * Delete the current user.
     *
     * @param  \Laravel\Jetstream\Contracts\DeletesUsers  $deleter
     * @param  \Illuminate\Contracts\Auth\StatefulGuard  $auth
     * @return void
     */
    public function deleteUser(DeletesUsers $deleter, StatefulGuard $auth)
    {
        $this->resetErrorBag();

        if (!Hash::check($this->password, $this->user->password)) {
            throw ValidationException::withMessages([
                'password' => [__('This password does not match our records.')],
            ]);
        }

        $deleter->delete($this->user->fresh());

        $auth->logout();

        return redirect('/');
    }

    public function render()
    {
        return view('livewire.users.profile.delete-user-form');
    }
}
