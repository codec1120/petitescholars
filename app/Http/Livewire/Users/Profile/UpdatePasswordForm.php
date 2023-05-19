<?php

namespace App\Http\Livewire\Users\Profile;

use Illuminate\Support\Facades\Auth;
use Laravel\Fortify\Contracts\UpdatesUserPasswords;
use Livewire\Component;

use Illuminate\Support\Facades\Password;

class UpdatePasswordForm extends Component
{
    /**
     * The component's state.
     *
     * @var array
     */
    public $user;
    public $state = [
        'current_password' => '',
        'password' => '',
        'password_confirmation' => '',
    ];
    public $send_reset_like = false;

    /**
     * Update the user's password.
     *
     * @param  \Laravel\Fortify\Contracts\UpdatesUserPasswords  $updater
     * @return void
     */
    public function updatePassword(UpdatesUserPasswords $updater)
    {
        $this->resetErrorBag();

        $updater->update($this->user, $this->state);

        $this->state = [
            'current_password' => '',
            'password' => '',
            'password_confirmation' => '',
        ];

        $this->emit('saved');
    }

    /**
     * Render the component.
     *
     * @return \Illuminate\View\View
     */
    public function render()
    {
        return view('livewire.users.profile.update-password-form');
    }

    public function sendResetLink ()
    {   
        $this->send_reset_like = true;
        
        $status = Password::sendResetLink(
           ['email' => $this->user->email]
        );

        return $status === Password::RESET_LINK_SENT
                ? back()->with(['status' => __($status)])
                : back()->withErrors(['email' => __($status)]);
    }
}
