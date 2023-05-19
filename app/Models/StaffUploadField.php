<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Sushi\Sushi;

class StaffUploadField extends Model
{
    use Sushi;

    public function getRows()
    {
        return [
            [
                'id' => 1,
                'category' => 'education',
                'field' => 'hs_diploma',
                'label' => 'HS Disploma'
            ],
            [
                'id' => 2,
                'category' => 'education',
                'field' => 'college_diploma',
                'label' => 'College Diploma'
            ],
            [
                'id' => 3,
                'category' => 'education',
                'field' => 'college_transcripts',
                'label' => 'College Transcripts'
            ],
            [
                'id' => 4,
                'category' => 'education',
                'field' => 'copy_of_cda',
                'label' => 'Copy of CDA'
            ],
            [
                'id' => 5,
                'category' => 'clearances',
                'field' => 'health_assessment_tb',
                'label' => 'Health Assessment/TB'
            ],
            [
                'id' => 6,
                'category' => 'clearances',
                'field' => 'child_abuse',
                'label' => 'Child Abuse'
            ],
            [
                'id' => 7,
                'category' => 'clearances',
                'field' => 'state_police',
                'label' => 'State Police'
            ],
            [
                'id' => 8,
                'category' => 'clearances',
                'field' => 'fbi_fingerprinting',
                'label' => 'FBI Fingerprinting'
            ],
            [
                'id' => 9,
                'category' => 'clearances',
                'field' => 'nsor',
                'label' => 'NSOR'
            ],
            [
                'id' => 10,
                'category' => 'training',
                'field' => 'first_aid_cpr',
                'label' => 'First Aid/CPR'
            ],
            [
                'id' => 11,
                'category' => 'training',
                'field' => 'fire_safety',
                'label' => 'Fire Safety'
            ],
            [
                'id' => 12,
                'category' => 'training',
                'field' => 'mandated_reported',
                'label' => 'Mandated Reported'
            ],
            [
                'id' => 13,
                'category' => 'training',
                'field' => 'health_safety',
                'label' => 'Health & Safety'
            ],
            [
                'id' => 14,
                'category' => 'training',
                'field' => 'stars101',
                'label' => 'Stars 101'
            ],
            [
                'id' => 15,
                'category' => 'training',
                'field' => 'stars102',
                'label' => 'Stars 102'
            ],
            [
                'id' => 16,
                'category' => 'training',
                'field' => 's_q343',
                'label' => 'SQ 3.4.3'
            ],
            [
                'id' => 17,
                'category' => 'training',
                'field' => 's_q344',
                'label' => 'SQ 3.4.4'
            ],
            [
                'id' => 18,
                'category' => 'training',
                'field' => 's_q345',
                'label' => 'SQ 3.4.5'
            ],
            [
                'id' => 19,
                'category' => 'training',
                'field' => 's_q347',
                'label' => 'SQ 3.4.7'
            ],
            [
                'id' => 20,
                'category' => 'training',
                'field' => 's_q348',
                'label' => 'SQ 3.4.8'
            ],
            [
                'id' => 21,
                'category' => 'training',
                'field' => 's_q349',
                'label' => 'SQ 3.4.9'
            ],
            [
                'id' => 22,
                'category' => 'training',
                'field' => 's_q349',
                'label' => '2020 6-hour Training'
            ],
            [
                'id' => 23,
                'category' => 'employment-requirements',
                'field' => 'w4',
                'label' => 'W4'
            ],
            [
                'id' => 24,
                'category' => 'employment-requirements',
                'field' => 'resume',
                'label' => 'Resume'
            ],
            [
                'id' => 25,
                'category' => 'employment-requirements',
                'field' => 'reference1',
                'label' => 'Reference 1'
            ],
            [
                'id' => 26,
                'category' => 'employment-requirements',
                'field' => 'reference2',
                'label' => 'Reference 2'
            ],
            [
                'id' => 27,
                'category' => 'employment-requirements',
                'field' => 'drivers_license',
                'label' => "Driver's License"
            ],
            [
                'id' => 28,
                'category' => 'employment-requirements',
                'field' => 'emergency_contact',
                'label' => "Emergency Contact"
            ],
            [
                'id' => 29,
                'category' => 'employment-requirements',
                'field' => 'signed_disclosure',
                'label' => "Signed Disclosure"
            ],
            [
                'id' => 30,
                'category' => 'employment-requirements',
                'field' => 'emergency_plan',
                'label' => "Emergency Plan"
            ],
            [
                'id' => 31,
                'category' => 'employment-requirements',
                'field' => 'job_description',
                'label' => "Job Description"
            ],
            [
                'id' => 32,
                'category' => 'employment-requirements',
                'field' => 'staff_handbook',
                'label' => "Staff Handbook"
            ],
            [
                'id' => 33,
                'category' => 'employment-requirements',
                'field' => 'staff_data_sheet',
                'label' => "Staff Data Sheet"
            ],
        ];
    }
}
