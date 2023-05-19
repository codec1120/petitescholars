<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Sushi\Sushi;

use App\Models\StaffTitle;

class StaffReviewRatingScale extends Model
{
    use Sushi;

    public function getRows()
    {
        return [
            [
                'id' => 1,
                'value' => 1,
                'title' => StaffTitle::CO_TEACHER,
                'name' => 'Unsatisfactory'
            ],
            [
                'id' => 2,
                'value' => 2,
                'title' => StaffTitle::CO_TEACHER,
                'name' => 'Development Needed'
            ],
            [
                'id' => 3,
                'value' => 3,
                'title' => StaffTitle::CO_TEACHER,
                'name' => 'Meets Expectations'
            ],
            [
                'id' => 4,
                'value' => 4,
                'title' => StaffTitle::CO_TEACHER,
                'name' => 'Exceeds Expectations'
            ],
            [
                'id' => 5,
                'value' => 1,
                'title' => StaffTitle::DIRECTOR,
                'name' => 'Always'
            ],
            [
                'id' => 6,
                'value' => 2,
                'title' => StaffTitle::DIRECTOR,
                'name' => 'Frequently'
            ],
            [
                'id' => 7,
                'value' => 3,
                'title' => StaffTitle::DIRECTOR,
                'name' => 'Some of the Time'
            ],
            [
                'id' => 8,
                'value' => 4,
                'title' => StaffTitle::DIRECTOR,
                'name' => 'Occasionally'
            ],
            [
                'id' => 9,
                'value' => 5,
                'title' => StaffTitle::DIRECTOR,
                'name' => 'Never'
            ],
            [
                'id' => 10,
                'value' => 'N/A',
                'title' => StaffTitle::DIRECTOR,
                'name' => 'Not Applicable'
            ]
        ];
    }
}
