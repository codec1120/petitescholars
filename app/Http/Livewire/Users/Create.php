<?php

namespace App\Http\Livewire\Users;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

use App\Models\{User, Role};
use App\Traits\Fields\WithUserFields;

class Create extends Component
{
    use AuthorizesRequests, WithUserFields;

    public $showCreateUserModal = false;

    public function getUserProperty()
    {
        return Auth::user();
    }

    protected function getTitle(): string
    {
        return $this->role === Role::STAFF ? 'Staff' : 'User';
    }

    public function submit()
    {
        $this->authorize('create', Auth::user());

        $this->validate(
            $this->validationRules(),
            $this->validationMessages(),
            $this->validationAttributes()
        );

        $this->user = User::create(
            array_merge($this->fields, ['role' => $this->role]),
        );

        $this->user->setMeta('learning_center', $this->fields['learning_center']);

        session()->flash('success', "{$this->user->full_name} created!");

        $redirectionRole = $this->role === Role::STAFF ? $this->role : null;

        return redirect()->route('users.index', ['role' => $redirectionRole]);
    }

    public function render()
    {
        return view('livewire.users.create', [
            'title' => $this->getTitle()
        ]);
    }
}
