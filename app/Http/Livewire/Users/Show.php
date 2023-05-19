<?php

namespace App\Http\Livewire\Users;

use Livewire\Component;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

use App\Models\User;

class Show extends Component
{
    use AuthorizesRequests;

    public User $user;

    public function mount(User $user)
    {
        $this->authorize('view', $user);
        $this->user = $user;
    }

    public function goToProfile()
    {
        return redirect()->route('staffs.profile.general', $this->user);
    }

    public function render()
    {
        return view('livewire.users.show');
    }
}
