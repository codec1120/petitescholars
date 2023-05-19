<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Sushi\Sushi;

class ChildMenu extends Model
{
    use HasFactory;
    use Sushi;

    public function getRows () 
    {
        return [
            [
                'name' => 'childInfo',
                'icon' => null,
                'label' => 'Child Info',
                'link' => 'children.children-edit-child.enrollment-application',
                'active' => $this->active('children.children-edit-child.enrollment-application'),
                'slug' => 'childInfo'
            ],
            [
                'name' => 'medicalInfo',
                'icon' => null,
                'label' => 'Medical Info',
                'link' => 'children.children-edit-child.medical-information',
                'active' => $this->active('children.children-edit-child.medical-information'),
                'slug' => 'medicalInfo'
            ],
            [
                'name' => 'familyQuestionaire',
                'icon' => null,
                'label' => 'Family Questionaire',
                'link' => 'children.children-edit-child.family-questionaire',
                'active' => $this->active('children.children-edit-child.family-questionaire'),
                'slug' => 'familyQuestionaire'
            ],
            [
                'name' => 'emergencyContact',
                'icon' => null,
                'label' => 'Emergenct Contacts',
                'link' => 'children.children-edit-child.emergency-contact',
                'active' => $this->active('children.children-edit-child.emergency-contact'),
                'slug' => 'emergencyContact'
            ],
            [
                'name' => 'permissionSlip',
                'icon' => null,
                'label' => 'Permission Slips',
                'link' => 'children.children-edit-child.permission-slip',
                'active' => $this->active('children.children-edit-child.permission-slip'),
                'slug' => 'permissionSlip'
            ],
            [
                'name' => 'immunizationRecord',
                'icon' => null,
                'label' => 'Immunization Records',
                'link' => 'children.children-edit-child.immunization-record',
                'active' => $this->active('children.children-edit-child.immunization-record'),
                'slug' => 'immunizationRecord'
            ],

        ];
    }

    private function active( string $key ): bool
    {
        return request()->segment(1) === $key ? true : false;
    }
}
