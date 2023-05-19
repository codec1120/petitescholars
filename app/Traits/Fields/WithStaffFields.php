<?php

namespace App\Traits\Fields;

trait WithStaffFields
{
    public $user;

    public $generalInfoFields = [
        'staff_name' => null,
        'title' => null,
        'dob' => null,
        'address' => null,
        'city' => null,
        'zip' => null,
        'state' => null,
        'phone_number' => null,
        'email' => null,
        'doh' => null,
        'first_date_in_child_care' => null,
        'pd_registry' => null,
        'provisional_hire_date' => null
    ];

    public $educationInfoFields = [
        'hs_diploma' => null,
        'college_diploma' => null,
        'college_transcripts' => null,
        'cda' => null,
        'other_relevant_education' => null
    ];

    public $educationInfoFiles = [
        'hs_diploma_file' => null,
        'college_diploma_file' => null,
        'college_transcripts_file' => null,
        'cda_file' => null,
        'other_relevant_education_file' => null
    ];

    public $clearancesFields = [
        "health_assessment_tb" => null,
        "child_abuse" => null,
        "state_police" => null,
        "fbi_fingerprinting" => null,
        "nsor" => null,
    ];

    public $trainingFields = [
        "first_aid_cpr" => null,
        "fire_safety" => null,
        "mandated_reported" => null,
        "health_safety" => null,
        "stars101" => null,
        "stars102" => null,
        "s_q343" => null,
        "s_q344" => null,
        "s_q345" => null,
        "s_q347" => null,
        "s_q348" => null,
        "s_q349" => null,
        "20206_hour_training" => null,
        "emergency_plan" => null
    ];

    public $employmentRequirementFields = [
        "w4" => null,
        "resume" => null,
        "reference1" => null,
        "reference2" => null,
        "drivers_license" => null,
        "emergency_contact" => null,
        "signed_disclosure" => null,
        "emergency_plan" => null,
        "job_description" => null,
        "staff_handbook" => null,
        "staff_data_sheet" => null,
    ];

    protected function generalInfoValidationRules(): array
    {
        return [
            'generalInfoFields.staff_name' => 'required',
            'generalInfoFields.email' => $this->emailRules()
        ];
    }

    protected function emailRules(): string
    {
        if ($this->user) {
            return 'required|email|unique:users,email,' . $this->user->id . ',id';
        }

        return 'required|email|unique:users,email';
    }

    protected function validationMessages(): array
    {
        return [];
    }

    protected function generalInfoValidationAttributes(): array
    {
        return [
            'generalInfoFields.staff_name' => 'Staff Name',
            'generalInfoFields.email' => 'Email'
        ];
    }
}
