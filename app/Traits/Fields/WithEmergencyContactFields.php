<?php 

namespace App\Traits\Fields;

trait WithEmergencyContactFields 
{
    public $user;

    public $emergencyContactFields = [
        "date_of_submission" => null,
        "updated_at" => null,
        "emergency_contact_details" => [
            [
                "emergency_contact_name" => null,
                "emergency_home_phone" => null,
                "emergency_work_phone" => null,
                "emergency_cell_phone" => null,
                "emergency_relation_to_staff" => null,
            ],
            [
                "emergency_contact_name" => null,
                "emergency_home_phone" => null,
                "emergency_work_phone" => null,
                "emergency_cell_phone" => null,
                "emergency_relation_to_staff" => null,
            ]
        ],
        "staff_allergies" => null,
        "staff_reaction_allergies" => null,
        "staff_medication" => null,
        "staff_medical_conditions" => null,
        "actions_needed_to_medical_conditions" => null,
        "staff_medical_insurance" => null,
        "staff_policy_number" => null,
        "user_id" => null,
        "completed" => 0,
        "status" => null
    ];

    protected $rules = [
        "emergencyContactFields.emergency_contact_details.0.emergency_contact_name"        => 'required',
        "emergencyContactFields.emergency_contact_details.0.emergency_home_phone"          => 'required',
        "emergencyContactFields.emergency_contact_details.0.emergency_work_phone"          => 'required',
        "emergencyContactFields.emergency_contact_details.0.emergency_cell_phone"          => 'required',
        "emergencyContactFields.emergency_contact_details.0.emergency_relation_to_staff"   => 'required',
        "emergencyContactFields.staff_allergies"                                           => 'required',
        "emergencyContactFields.staff_reaction_allergies"                                  => 'required',
        "emergencyContactFields.staff_medication"                                          => 'required',
    ];

    protected $messages = [
        "emergencyContactFields.emergency_contact_details.0.emergency_contact_name.required"        => 'This field is required.',
        "emergencyContactFields.emergency_contact_details.0.emergency_home_phone.required"          => 'This field is required.',
        "emergencyContactFields.emergency_contact_details.0.emergency_work_phone.required"          => 'This field is required.',
        "emergencyContactFields.emergency_contact_details.0.emergency_cell_phone.required"          => 'This field is required.',
        "emergencyContactFields.emergency_contact_details.0.emergency_relation_to_staff.required"   => 'This field is required.',
        "emergencyContactFields.staff_allergies.required"                                           => 'This field is required.',
        "emergencyContactFields.staff_reaction_allergies.required"                                  => 'This field is required.',
        "emergencyContactFields.staff_medication.required"                                          => 'This field is required.',
    ];
}