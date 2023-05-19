<?php

namespace App\Http\Livewire\Users;

use Illuminate\Validation\ValidationException;
use Laravel\Jetstream\Contracts\DeletesUsers;
use Livewire\Component;

class Delete extends Component
{
    public $user;
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
    public $email = '';

    /**
     * Confirm that the user would like to delete their account.
     *
     * @return void
     */
    public function confirmUserDeletion()
    {
        $this->email = '';
        $this->resetErrorBag();

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
    public function deleteUser(DeletesUsers $deleter)
    {
        $this->resetErrorBag();

        if ($this->email !== $this->user->email) {
            throw ValidationException::withMessages([
                'email' => [__('The email does not match the user email')],
            ]);
        }

        $deleter->delete($this->user->fresh());

        session()->flash('success', "{$this->user->full_name} successfully deleted!");

        return redirect('/users');
    }

    public function render()
    {
        return view('livewire.users.delete');
    }
}
