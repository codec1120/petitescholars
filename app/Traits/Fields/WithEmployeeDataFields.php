<?php

namespace App\Traits\Fields;

trait WithEmployeeDataFields
{
    public $user;

    public $employee = [
        "employee_name" => null,
        "created_at" => null,
        "location" => null,
        "email_address" => null,
        "address" => null,
        "phone_number" => null,
        "dob" => null,
        "user_id" => null,
        "employee_title"=>  null,
        "status"=>  0,
        "date_submitted" => null
    ];

    public $education = [
        "high_school_name" => null,
        "high_school_address" => null,
        "name_of_college" => null,
        "college_address" => null,
        "grade_completed" => null,
        "graduate_date" => null,
        "semester_hours_completed" => null,
        "degree_earned" => null,
        "user_id" => null,
        "select_options" => [
            [
                'value' => 9,
                'label' => '9'
            ],
            [
                'value' => 10,
                'label' => '10'
            ],
            [
                'value' => 11,
                'label' => '11'
            ],
            [
                'value' => 12,
                'label' => '12'
            ]
        ]
    ];

    public $employmentExperience = [
        [
            "employer" => null,
            "employer_address" => null,
            "job_description" => null,
            "job_title" => null,
            "employment_start_date" => null,
            "employment_end_date" => null,
            "user_id" => null
        ],
        [
            "employer" => null,
            "employer_address" => null,
            "job_description" => null,
            "job_title" => null,
            "employment_start_date" => null,
            "employment_end_date" => null,
            "user_id" => null
        ],
        [
            "employer" => null,
            "employer_address" => null,
            "job_description" => null,
            "job_title" => null,
            "employment_start_date" => null,
            "employment_end_date" => null,
            "user_id" => null
        ]
    ];

    public $presentPosition = [
        "date_start" => null,
        "days_week_available_for_work" => null,
        "hours_available_for_work" => null,
        "user_id" => null
    ];

    public $disclosureAgreement = [
        "date_signed_disclosure_agreement" => null
    ];

    public $handbookAgreement = [
        "date_signed_disclosure_agreement" => null
    ];

    
    
}
