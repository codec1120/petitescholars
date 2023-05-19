<?php

namespace App\Traits;

use App\Models\{User};
use App\Traits\Fields\WithEmployeeDataFields;
use App\Models\{
    EmployeeEducation, 
    EmployeeEmploymentExperience, 
    EmployeeInfo, 
    EmployeePresentPosition, 
    DisclosureAgreement, 
    HandbookAgreement
};


trait EmployeeData {

    public $completedCompletedCount = 4;
    public $completedStat = 0;

    public function getEmployeeDataSheetRecord ( ) {
        // First: Get Employee Data Sheet Records.
       $employeeRecord = User::with(['getEmployeeInfo', 'getEmployeeEducation', 
                        'getEmployeeEmploymentExperience', 'getEmployeePresentPosition']
                        )->find( $this->user->id );
                      
        // Second: Sync Fields and Employee Records.
       
        $this->employee                 =   isset($employeeRecord->getEmployeeInfo)
                                                ? array_merge($this->employee, $employeeRecord->getEmployeeInfo->toArray()) 
                                                : $this->employee;

        $this->education                =   isset($employeeRecord->getEmployeeEducation)
                                                ? array_merge($this->education, $employeeRecord->getEmployeeEducation->toArray()) 
                                                : $this->education;

        $this->employmentExperience     =   isset($employeeRecord->getEmployeeEmploymentExperience) && count($employeeRecord->getEmployeeEmploymentExperience) > 0
                                                ? $employeeRecord->getEmployeeEmploymentExperience->toArray() 
                                                : $this->employmentExperience;
                                                
        $this->presentPosition          =  isset($employeeRecord->getEmployeePresentPosition)
                                                ? array_merge($this->presentPosition, $employeeRecord->getEmployeePresentPosition->toArray()) 
                                                : $this->presentPosition;
        
        // Check if Employment Agreement contains 3 items
        for ($i = count($this->employmentExperience); $i < 3; $i++) {
            array_push($this->employmentExperience, [
                "employer" => null,
                "employer_address" => null,
                "job_description" => null,
                "job_title" => null,
                "employment_start_date" => null,
                "employment_end_date" => null,
                "user_id" => null
            ]);
        }
        
        return [
            'employee'             => $this->employee,
            'education'            => $this->education,
            'employmentExperience' => $this->employmentExperience,
            'presentPosition'      => $this->presentPosition,
            'eds'                  => $employeeRecord
        ];
    }

    public function populateData () {
        // Save Employee Info
        $this->saveEmployee();

        // Save Employee Education record
        $this->saveEmployeeEducation();

        // Save Employee Employment record
        $this->saveEmployeeEmploymentExperience();

        // Save Employee Present Position
        $this->saveEmployeePresentPosition();

        return true;
    }

    public function saveEmployee () {
        // Check IF record Existed
        $empExist = EmployeeInfo::where('user_id', '=', $this->user->id)->exists();
        
        // Simulate Update/Insert
        $empRecord =  [
            'user_id' => $this->employee['user_id'],
            'address' => $this->employee['address'],
            'phone_number' => $this->employee['phone_number'],
            'dob' => carbon( $this->employee['dob'] )->format('Y-m-d'),
            'status' => $this->employee['status'] == true ? 1: 0,
            'date_submitted' => $this->employee['status'] == true ? carbon( date('Y-m-d') )->format('Y-m-d'): null 
        ];
        
        $empExist 
            ? EmployeeInfo::where('user_id', '=' ,$this->user->id)->update( $empRecord )
            : EmployeeInfo::create( $empRecord );
    }

    public function saveEmployeeEducation () {
         // Check IF record Existed
         $empExist = EmployeeEducation::where('user_id', '=', $this->user->id)->exists();
         
         // Simulate Update/Insert
         $empEducationRecord =  [
             'user_id' => $this->user->id,
             'high_school_name' => $this->education['high_school_name'],
             'high_school_address' => $this->education['high_school_address'],
             'name_of_college' => $this->education['name_of_college'],
             'college_address' => $this->education['college_address'],
             'grade_completed' => $this->education['grade_completed'],
             'graduate_date' => carbon( $this->education['graduate_date'] )->format('Y-m-d'),
             'semester_hours_completed' => $this->education['semester_hours_completed'],
             'degree_earned' => $this->education['degree_earned']
         ];
         
         $empExist 
             ? EmployeeEducation::where('user_id', '=' ,$this->user->id)->update( $empEducationRecord )
             : EmployeeEducation::create( $empEducationRecord );
    }

    public function saveEmployeeEmploymentExperience () {
        foreach ($this->employmentExperience as $key => $data) {
            // Delete Old Records
            EmployeeEmploymentExperience::where([
                'user_id' => $this->user->id
            ])->delete();
            // Check if all fields are populated
            $employmentExperience[$key] =  [
                'cnt'     => $key,
                'user_id' => $this->user->id,
                'employer' => $data['employer'] ?? null,
                'employer_address' => $data['employer_address'] ?? null,
                'job_description' => $data['job_description'] ?? null,
                'employment_start_date' => carbon( $data['employment_start_date'] )->format('Y-m-d') ?? null,
                'employment_end_date' => carbon( $data['employment_end_date'] )->format('Y-m-d') ?? null,
                'job_title' => $data['job_title'] ?? null,
            ];
        }
        
        // Create new records
        EmployeeEmploymentExperience::insert($employmentExperience);
   }

   public function saveEmployeePresentPosition () {
       // Check IF record Existed
       $empExist = EmployeePresentPosition::where('user_id', '=', $this->user->id)->exists();
       
       // Simulate Update/Insert
       $EmployeePresentPosition =  [
           'user_id' => $this->presentPosition['user_id'],
           'days_week_available_for_work' => $this->presentPosition['days_week_available_for_work'],
           'hours_available_for_work' => $this->presentPosition['hours_available_for_work'],
           'date_start' => carbon( $this->presentPosition['date_start'] )->format('Y-m-d'),
       ];
       
       $empExist 
           ? EmployeePresentPosition::where('user_id', '=' ,$this->user->id)->update( $EmployeePresentPosition )
           : EmployeePresentPosition::create( $EmployeePresentPosition );
   }

   public function saveDisclosureAgreement () {
        // Save Disclosure Agreement Signed Date
        $disclosure = [
            "user_id" => $this->user->id,
            "date_signed_disclosure_agreement" => carbon( date('Y-m-d') )->format('Y-m-d h:i:s'),
            "updated_at" => carbon( date('Y-m-d') )->format('Y-m-d h:i:s')
        ];

        $this->disclosureAgreement['date_signed_disclosure_agreement'] = carbon( date('Y-m-d') )->format('Y-m-d H:i:s');

        DisclosureAgreement::where('user_id', $this->user->id)->delete();

        return DisclosureAgreement::insert( $disclosure );
   }

   public function saveHandbookAgreement () {
        // Save Staff handbook signed date
        $handbook = [
                "user_id" => $this->user->id,
                "date_signed_disclosure_agreement" => carbon( date('Y-m-d H:i:s') )->format('Y-m-d H:i:s'),
                "updated_at" => carbon()
        ];
        
        $this->handbookAgreement['date_signed_disclosure_agreement'] = carbon( date('Y-m-d h:i:s') )->format('Y-m-d h:i:s');

        HandbookAgreement::where('user_id', $this->user->id)->delete();
        
        return HandbookAgreement::insert($handbook);
   }
}
