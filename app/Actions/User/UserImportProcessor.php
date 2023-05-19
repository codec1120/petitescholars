<?php

namespace App\Actions\User;

use Illuminate\Support\Collection;

use App\Models\{Role, User};

class UserImportProcessor
{
    protected Collection $users;

    public function __construct(Collection $users)
    {
        $this->users = $users;
    }

    public function execute()
    {
        foreach ($this->users as $user) {
            User::updateOrCreate(
                [
                    'email' => $user['email']
                ],
                [
                    'first_name' => $user['first_name'],
                    'last_name' => $user['last_name'],
                    'email' => $user['email'],
                    'phone_number' => $user['phone_number'],
                    'role' => Role::where('role', strtolower($user['role']))->first()->role
                ]
            );
        }
    }

    public function importStaffProfile()
    {
        foreach ($this->users as $meta) {
            $user = User::whereEmail($meta['email'])->first();
            $user->saveProfileFields($meta);
        }
    }
}
