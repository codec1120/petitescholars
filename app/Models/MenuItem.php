<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Sushi\Sushi;

use App\Models\Role;

class MenuItem extends Model
{
    use Sushi;

    public function getRows()
    {
        return [
            [
                'id' => 'dashboard',
                'parent_id' => 'dashboard',
                'label' => 'Dashboard',
                'link' => route('dashboard'),
                'visible' => auth()->user()->isAdmin(),
                'active' => $this->active('dashboard'),
                'with_sub_menu' => false,
                'icon' => '<svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 5a1 1 0 011-1h14a1 1 0 011 1v2a1 1 0 01-1 1H5a1 1 0 01-1-1V5zM4 13a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H5a1 1 0 01-1-1v-6zM16 13a1 1 0 011-1h2a1 1 0 011 1v6a1 1 0 01-1 1h-2a1 1 0 01-1-1v-6z" />
                </svg>'
            ],
            [
                'id' => 'users',
                'parent_id' => 'users',
                'label' => 'User Accounts',
                'link' => route('users.index'),
                'visible' => auth()->user()->isAdmin(),
                'active' => $this->active('users') && !request()->has('role'),
                'with_sub_menu' => true,
                'icon' => '<svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                </svg>'
            ],
            // [
            //     'id' => 'training-center',
            //     'parent_id' => 'training-center',
            //     'label' => 'Training Center',
            //     'link' => route('dashboard'),
            //     'visible' => auth()->user()->canAccessBoth(),
            //     'active' => $this->active('training-center'),
            //     'with_sub_menu' => false,
            //     'icon' => '<svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            //         <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z" />
            //     </svg>'
            // ],
            [
                'id' => 'reports',
                'parent_id' => 'reports',
                'label' => 'Reports',
                'link' => route('reports'),
                'visible' => auth()->user()->isAdmin(),
                'active' => $this->active('reports'),
                'with_sub_menu' => false,
                'icon' => '<svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                </svg>'
            ],
            [
                'id' => 'settings',
                'parent_id' => 'settings',
                'label' => 'Settings',
                'link' => route('settings'),
                'visible' => auth()->user()->isAdmin(),
                'active' => $this->active('settings'),
                'with_sub_menu' => true,
                'icon' => '<svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                </svg>'
            ],
            [
                'id' => 'profile',
                'parent_id' => 'profile',
                'label' => 'Profile',
                'link' => route('staffs.profile.index', auth()->user()),
                'visible' => auth()->user()->isStaff(),
                'active' =>  $this->active('staffs'),
                'with_sub_menu' => false,
                'icon' => '<svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                </svg>'
            ],
            [
                'id' => 'children',
                'parent_id' => 'children',
                'label' => 'Child Accounts',
                'link' => route('children', ['user' => auth()->user()->id ]),
                'visible' =>auth()->user()->isParent(),
                'active' =>  $this->active('children'),
                'with_sub_menu' => false,
                'icon' => '<svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                </svg>'
            ],
            // [
            //     'id' => 'downloads',
            //     'parent_id' => 'downloads',
            //     'label' => 'My Downloads',
            //     'link' => route('dashboard'),
            //     'visible' => auth()->user()->isAdmin() || auth()->user()->isParent(),
            //     'active' =>  $this->active('downloads'),
            //     'with_sub_menu' => false,
            //     'icon' => '<svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            //         <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-6l-2-2H5a2 2 0 00-2 2z" />
            //     </svg>'
            // ],
            // [
            //     'id' => 'messages',
            //     'parent_id' => 'messages',
            //     'label' => 'Messages',
            //     'link' => route('dashboard'),
            //     'visible' => auth()->user()->isParent(),
            //     'active' =>  $this->active('downloads'),
            //     'with_sub_menu' => false,
            //     'icon' => '<svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            //         <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z" />
            //     </svg>'
            // ]
        ];
    }

    private function active( string $key ): bool
    {
        return request()->segment(1) === $key ? true : false;
    }
}
