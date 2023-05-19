<?php

namespace App\Traits;

use App\Models\Role;

trait HasRole
{
    public function getRoleNameAttribute()
    {
        $role = Role::select('role_name')
            ->where('role', $this->role)->first();

        return $role->role_name;
    }

    public function setRole(Role $role): void
    {
        $this->role = $role->role;
        $this->save();
    }

    public function isAdmin(): bool
    {
        return $this->role === Role::ADMIN;
    }

    public function isStaff(): bool
    {
        return $this->role === Role::STAFF;
    }

    public function isParent(): bool
    {
        return $this->role === Role::PARENT;
    }

    public function myself($id): bool
    {
        return $this->id === $id;
    }

    public function canAccessBoth(): bool
    {
        return $this->isAdmin() || $this->isStaff();
    }
}
