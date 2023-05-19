<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Sushi\Sushi;

class Role extends Model
{
    use Sushi;

    const ADMIN = 'admin';
    const STAFF = 'staff';
    const PARENT = 'parent';

    public function getRows()
    {
        return [
            [
                'role' => self::ADMIN,
                'role_name' => 'Admin'
            ],
            [
                'role' => self::STAFF,
                'role_name' => 'Staff'
            ],
            [
                'role' => self::PARENT,
                'role_name' => 'Parent'
            ]
        ];
    }
}
