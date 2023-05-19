<?php

namespace App\Traits;

use App\Models\{User, EmergencyContactDetails, EmployeeInfo, EmergencyContact};
use App\Traits\Fields\{WithEmployeeDataFields, WithEmergencyContactFields};

trait EmergencyContactData {

    public function getContactForm () {
        $emergencyContact = User::with(['getEmergencyContact', 'getEmergencyContactDetails', 'getEmployeeInfo'])->find( $this->user->id );
        
        $this->emergencyContactFields   = isset($emergencyContact->getEmergencyContact) ? 
                                            array_merge($this->emergencyContactFields, 
                                                $emergencyContact->getEmergencyContact->toArray(), 
                                                array( 'emergency_contact_details' => count($emergencyContact->getEmergencyContactDetails->toArray()) > 0 ?
                                                                                            $emergencyContact->getEmergencyContactDetails->toArray(): 
                                                                                                [
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
                                                                                                ] )
                                            ) :
                                            $this->emergencyContactFields;

        $this->emergencyContactFields['status'] =  $this->emergencyContactFields['completed'] ? "Submitted & Acknowledged" : "Incomplete"; 
        
        return $this->emergencyContactFields;
    }

    public function getEmployeeInfo () {
        $this->employee['employee_name']            = $this->user->first_name.' '.$this->user->last_name;
        $this->employee['employee_title']           = $this->user->title ?? null;
        $this->employee['email_address']            = $this->user->email;
        $this->employee['phone_number']             = $this->user->phone_number;
        $this->employee['dob']                      = $this->user->getGeneralInfo()['dob'];
        
        return $this->employee;
    }

    public function syncEmployeeInfoAndContactForm () {
        return [
            'employee'                  => $this->getEmployeeInfo(),
            'emergencyContactFields'    => $this->getContactForm(),
        ];
    }

    public function populate () {

        // Validate Required Fields
        $this->validate();
       
        // Delete all record
        EmergencyContactDetails::where('user_id', $this->user->id)->delete();
        EmergencyContact::where('user_id', $this->user->id)->delete();
        // Save Emergency Contact Details
        for ($i = 0; $i < count($this->emergencyContactFields['emergency_contact_details']); $i++) {
            // Populate Record
            
            $emergency_contact_details = [
                "user_id"                       => $this->user->id,
                "emergency_contact_name"        => $this->emergencyContactFields['emergency_contact_details'][$i]['emergency_contact_name'],
                "emergency_home_phone"          => $this->emergencyContactFields['emergency_contact_details'][$i]['emergency_home_phone'],
                "emergency_work_phone"          => $this->emergencyContactFields['emergency_contact_details'][$i]['emergency_work_phone'],
                "emergency_cell_phone"          => $this->emergencyContactFields['emergency_contact_details'][$i]['emergency_cell_phone'],
                "emergency_relation_to_staff"   => $this->emergencyContactFields['emergency_contact_details'][$i]['emergency_relation_to_staff']
            ];
            
            EmergencyContactDetails::insert( $emergency_contact_details );
        }
        // Save Emergency Contact
        $this->emergencyContactFields['user_id'] = $this->user->id;

        $emergency_contact = [
            "date_of_submission"                    => isset($this->emergencyContactFields['date_of_submission']) ? carbon( $this->emergencyContactFields['date_of_submission'] )->format('Y-m-d'): carbon( date('Y-m-d') )->format('Y-m-d'),
            "staff_allergies"                       => $this->emergencyContactFields['staff_allergies'],
            "staff_reaction_allergies"              => $this->emergencyContactFields['staff_reaction_allergies'],
            "staff_medication"                      => $this->emergencyContactFields['staff_medication'],
            "staff_medical_conditions"              => $this->emergencyContactFields['staff_medical_conditions'],
            "actions_needed_to_medical_conditions"  => $this->emergencyContactFields['actions_needed_to_medical_conditions'],
            "staff_medical_insurance"               => $this->emergencyContactFields['staff_medical_insurance'],
            "staff_policy_number"                   => $this->emergencyContactFields['staff_policy_number'],
            "user_id"                               => $this->emergencyContactFields['user_id'],
            "completed"                             => $this->emergencyContactFields['completed'] == true? 1: 0,
        ];
        
        return EmergencyContact::create( $emergency_contact );
    }

    public function validateContactDetails ( $emergencyContactFields ) {
        $required_fields = [
            "emergency_contact_name",
            "emergency_home_phone",
            "emergency_work_phone",
            "emergency_cell_phone",
            "emergency_relation_to_staff"];
        $empty_field_count = 0;

        foreach ($required_fields as $key => $field) {
            if ( empty($emergencyContactFields[$field]) ) $empty_field_count += 1;
        }
        

        return $empty_field_count > 0 ? true: false;
    }

}