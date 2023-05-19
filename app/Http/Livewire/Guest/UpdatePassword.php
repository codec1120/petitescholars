<?php

namespace App\Http\Livewire\Guest;

use Illuminate\Http\Request;

use Livewire\Component;

use App\Models\{
    User,
};

use Illuminate\Support\Facades\Hash;

class UpdatePassword extends Component
{
    public $request;
    public $newPasswordValue;

    public function mount($token, Request $req)
    {
        $this->request = $req->all();

        $tokenVerify = User::where([
            'id' => $this->request['id'],
            'email' => $this->request['email'],
            'password_token' => $token,
        ])->first();

        if (!$tokenVerify) {
            return abort(403, 'Invalid Token.');
        }
    }

    public function updatePassword(Request $req)
    {
        // Update User Password and set token to null
        User::where('id', $this->request['id'])->update([
            'password' => Hash::make($this->newPasswordValue),
            'password_token' => null
        ]);

        return redirect()->route('login');
    }

    public function render()
    {
        return view('livewire.guest.update-password')
             ->layout('layouts.guest');
    }
}
