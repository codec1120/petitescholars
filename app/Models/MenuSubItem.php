<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Sushi\Sushi;

use App\Models\Role;

class MenuSubItem extends Model
{
    use Sushi;

    public function getRows ()
    {
        return [
            [
                'parent_menu_id' => 'users',
                'id' => 'users',
                'label' => 'All Users',
                'link' => route('users.index'),
                'visible' => auth()->user()->isAdmin(),
                'active' => $this->active('users') && !request()->has('role'),
                'icon' => ''
            ],
            [
                'parent_menu_id' => 'users',
                'id' => 'staff',
                'label' => 'Staff',
                'link' =>  route('users.index', ['role' =>  Role::STAFF]),
                'visible' => auth()->user()->isAdmin(),
                'active' => ($this->active('users') && request()->has('role')) || $this->active('staffs'),
                'icon' => ''
            ],
            [
                'parent_menu_id' => 'users',
                'id' => 'parents',
                'label' => 'Parent',
                'link' => route('parents'),
                'visible' => auth()->user()->isAdmin(),
                'active' => $this->active('parents'),
                'icon' => ''
            ],
            [
                'parent_menu_id' => 'users',
                'id' => 'children',
                'label' => 'Children',
                'link' => route('children', ['user' => auth()->user()->id ]),
                'visible' => auth()->user()->canAccessBoth() || auth()->user()->isParent(),
                'active' =>  $this->active('children'),
                'icon' => ''
            ],
            [
                'parent_menu_id' => 'settings',
                'id' => 'immunization',
                'label' => 'Immunization',
                'link' => route('immunization'),
                'visible' => auth()->user()->isAdmin(),
                'active' =>  $this->active('immunization'),
                'icon' => ''
            ],
            [
                'parent_menu_id' => 'settings',
                'id' => 'file-manager',
                'label' => 'File Manager',
                'link' => route('file-manager'),
                'visible' => auth()->user()->isAdmin(),
                'active' =>  $this->active('file-manager'),
                'icon' => ''
            ],
            [
                'parent_menu_id' => 'settings',
                'id' => 'frequency',
                'label' => 'Frequency',
                'link' => route('frequency'),
                'visible' => auth()->user()->isAdmin(),
                'active' =>  $this->active('frequency'),
                'icon' => ''
            ],
            [
                'parent_menu_id' => 'settings',
                'id' => 'notifications',
                'label' => 'Notifications',
                'link' => route('notifications'),
                'visible' => auth()->user()->isAdmin(),
                'active' =>  $this->active('notifications'),
                'icon' => ''
            ],
        ];
    }

    private function active( string $key ): bool
    {
        return request()->segment(1) === $key ? true : false;
    }
}
