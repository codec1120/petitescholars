<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Sushi\Sushi;

class StaffProfileMenu extends Model
{
    use Sushi;

    public function getRows()
    {
        return [
            [
                'name' => 'general-information',
                'icon' => null,
                'label' => 'General Information',
                'link' => 'staffs.profile.general',
                'active' => $this->active('users.staffs.profile.general'),
                'slug' => 'general'
            ],
            [
                'name' => 'employee-agreement',
                'icon' => null,
                'label' => 'Employee Agreement',
                'link' => 'staffs.profile.employee-agreement',
                'active' => $this->active('users.staffs.profile.employee-agreement'),
                'slug' => 'employee-agreement'
            ],
            [
                'name' => 'education',
                'icon' => null,
                'label' => 'Education',
                'link' => 'staffs.profile.education',
                'active' => $this->active('users.staffs.profile.education'),
                'slug' => 'education'
            ],
            [
                'name' => 'clearances',
                'icon' => null,
                'label' => 'Clearances',
                'link' => 'staffs.profile.clearances',
                'active' => $this->active('users.staffs.profile.clearances'),
                'slug' => 'clearances'
            ],
            [
                'name' => 'emergency-contact',
                'icon' => null,
                'label' => 'Emergency Contact',
                'link' => 'staffs.profile.emergency-contact',
                'active' => $this->active('users.staffs.profile.emergency-contact'),
                'slug' => 'emergency-contact'
            ],
            [
                'name' => 'training',
                'icon' => null,
                'label' => 'Training',
                'link' => 'staffs.profile.training',
                'active' => $this->active('users.staffs.profile.training'),
                'slug' => 'training'
            ],
            [
                'name' => 'employment-requirements',
                'icon' => null,
                'label' => 'Employment Requirements',
                'link' => 'staffs.profile.employment-requirements',
                'active' => $this->active('users.staffs.profile.employment-requirements'),
                'slug' => 'employment-requirements'
            ],
            // [
            //     'name' => 'reviews',
            //     'icon' => null,
            //     'label' => 'Reviews',
            //     'link' => 'staffs.profile.reviews',
            //     'active' => $this->active('users.staffs.profile.reviews'),
            //     'slug' => 'reviews'
            // ]
        ];
    }

    protected function active(string $key): bool
    {
        return request()->segment(3) === $key ? true : false;
    }
}
