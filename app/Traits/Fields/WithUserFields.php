<?php

namespace App\Traits\Fields;

use Illuminate\Validation\Rule;

use App\Models\Role;

trait WithUserFields
{
    public $role;
    public $fields = [
        'first_name',
        'last_name',
        'email',
        'password',
        'phone_number',
        'password_confirmation',
        'learning_center' => ''
    ];

    protected function validationRules(): array
    {
        return [
            'fields.first_name' => 'required',
            'fields.last_name' => 'required',
            'fields.email' => 'required|email|unique:users,email',
            'fields.password' => 'required|min:8|confirmed',
            'role' => $this->roleRules()
        ];
    }

    protected function roleRules(): array
    {
        return ['required', Rule::in([Role::ADMIN, Role::STAFF, Role::PARENT])];
    }

    protected function validationMessages(): array
    {
        return [
            'role.in' => 'Invalid role!'
        ];
    }

    protected function validationAttributes(): array
    {
        return [
            'fields.first_name' => 'First Name',
            'fields.last_name' => 'Last Name',
            'fields.email' => 'Email',
            'fields.password' => 'Password',
            'fields.password_confirmation' => 'Password Confirmation',
            'role' => 'User role'
        ];
    }
}
