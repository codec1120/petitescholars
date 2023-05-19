<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Sushi\Sushi;

class StaffTitle extends Model
{
    use Sushi;

    const OWNER = 'owner';
    const DIRECTOR = 'director';
    const LEAD_TEACHER = 'lead_teacher';
    const CO_TEACHER = 'co_teacher';
    const CLASSROOM_AIDE = 'classroom_aide';
    const ADMIN_AIDE = 'admin_aide';

    public function getRows()
    {
        return [
            [
                'value' => self::OWNER,
                'name' => 'Owner'
            ],
            [
                'value' => self::DIRECTOR,
                'name' => 'Director'
            ],
            [
                'value' => self::LEAD_TEACHER,
                'name' => 'Lead Teacher'
            ],
            [
                'value' => self::CO_TEACHER,
                'name' => 'Co-Teacher'
            ],
            [
                'value' => self::CLASSROOM_AIDE,
                'name' => 'Classroom Aide'
            ],
            [
                'value' => self::ADMIN_AIDE,
                'name' => 'Admin Aide'
            ]
        ];
    }
}
