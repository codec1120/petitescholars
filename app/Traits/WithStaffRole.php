<?php

namespace App\Traits;

use App\Models\{StaffTitle, StaffReview};

use Illuminate\Support\Carbon;

trait WithStaffRole
{
    public function reviews()
    {
        return $this->hasMany(StaffReview::class, 'staff_id');
    }

    public function getTitleAttribute()
    {
        return  $this->getMeta('title');
    }

    public function getJobTitleAttribute(): string
    {
        $title = StaffTitle::where('value', $this->getMeta('title'))->first();

        if (!$title) {
            return '';
        }

        return $title->name;
    }

    public function getGeneralInfo(): array
    {
        return [
            'staff_name' => $this->getMeta('staff_name') ?? $this->full_name,
            'title' => $this->getMeta('title'),
            'dob' => $this->getMeta('dob') ? ensure_date_format($this->getMeta('dob')) : null,
            'address' => $this->getMeta('address'),
            'state' => $this->getMeta('state'),
            'city' => $this->getMeta('city'),
            'zip' => $this->getMeta('zip'),
            'phone_number' => $this->phone_number,
            'email' => $this->email,
            'doh' => $this->getMeta('doh') ? ensure_date_format($this->getMeta('doh')) : null,
            'first_date_in_child_care' => $this->getMeta('first_date_in_child_care') ? ensure_date_format($this->getMeta('first_date_in_child_care')) : null,
            'pd_registry' => $this->getMeta('pd_registry'),
            'provisional_hire_date' => $this->getMeta('doh') ? Carbon::parse($this->getMeta('doh'))->addDays(90)->format('m/d/Y') : null,
        ];
    }

    public function getGeneralInfoForHumans(): array
    {
        $title = StaffTitle::where('value', $this->getMeta('title'))->first();

        return [
            'Staff Name' => $this->getMeta('staff_name') ?? $this->full_name,
            'Title' => $title ? $title->name : '',
            'DOB' => $this->getMeta('dob') ? ensure_date_format($this->getMeta('dob')) : null,
            'Address' => $this->getMeta('address'),
            'State' => $this->getMeta('state'),
            'City' => $this->getMeta('city'),
            'Zip' => $this->getMeta('zip'),
            'Phone Number' => $this->phone_number,
            'Email Address' => $this->email,
            'DOH' => $this->getMeta('doh') ? ensure_date_format($this->getMeta('doh')) : null,
            'First Date in Child Care' => $this->getMeta('first_date_in_child_care') ? ensure_date_format($this->getMeta('first_date_in_child_care')) : null,
            'PD Registry' => $this->getMeta('pd_registry'),
            'Provisional Hire Date' => $this->getMeta('doh') ? Carbon::parse($this->getMeta('doh'))->addDays(90)->format('m/d/Y') : null,
        ];
    }

    public function getEducationInfo(): array
    {
        return [
            'hs_diploma' => ensure_date_format($this->getMeta('hs_diploma')),
            'college_diploma' => ensure_date_format($this->getMeta('college_diploma')),
            'college_transcripts' => ensure_date_format($this->getMeta('college_transcripts')),
            'cda' => ensure_date_format($this->getMeta('cda')),
            'other_relevant_education' => ensure_date_format($this->getMeta('other_relevant_education')),
        ];
    }

    public function getEducationInfoForHumans(): array
    {
        return [
            'HS Diploma' => ensure_date_format($this->getMeta('hs_diploma')),
            'College Diploma' => ensure_date_format($this->getMeta('college_diploma')),
            'College Transcripts' => ensure_date_format($this->getMeta('college_transcripts')),
            'CDA' => ensure_date_format($this->getMeta('cda')),
            'Other Relevant Education' => ensure_date_format($this->getMeta('other_relevant_education')),
        ];
    }

    public function getClearancesInfo(): array
    {
        return [
            "health_assessment_tb" => ensure_date_format($this->getMeta('health_assessment_tb')),
            "child_abuse" => ensure_date_format($this->getMeta('child_abuse')),
            "state_police" => ensure_date_format($this->getMeta('state_police')),
            "fbi_fingerprinting" => ensure_date_format($this->getMeta('fbi_fingerprinting')),
            "nsor" => ensure_date_format($this->getMeta('nsor'))
        ];
    }

    public function getClearancesInfoForHumans(): array
    {
        return [
            "Health Assessment/TB" => ensure_date_format($this->getMeta('health_assessment_tb')),
            "Child Abuse" => ensure_date_format($this->getMeta('child_abuse')),
            "State Police" => ensure_date_format($this->getMeta('state_police')),
            "FBI Fingerprinting" => ensure_date_format($this->getMeta('fbi_fingerprinting')),
            "NSOR" => ensure_date_format($this->getMeta('nsor'))
        ];
    }

    public function getTrainingInfo(): array
    { 
        return [
            "first_aid_cpr" => array( 'label' => 'First Aid/CPR', 'value' => ensure_date_format($this->getMeta('first_aid_cpr'))),
            "fire_safety" => array( 'label' => 'Fire Safety', 'value' => ensure_date_format($this->getMeta('fire_safety'))),
            "mandated_reported" => array( 'label' => 'Mandated Reported', 'value' => ensure_date_format($this->getMeta('mandated_reported'))),
            "health_safety" => array( 'label' => 'Health & Safety', 'value' => ensure_date_format($this->getMeta('health_safety'))),
            "stars101" => array( 'label' => 'Stars 101', 'value' => ensure_date_format($this->getMeta('stars101'))),
            "stars102" => array( 'label' => 'Stars 102', 'value' => ensure_date_format($this->getMeta('stars102'))),
            "s_q343" => array( 
                    'label' => 'SQ 3.4.3', 
                    'value' => ( is_array($this->getMeta('s_q343')) ? $this->getMeta('s_q343')['value']: $this->getMeta('s_q343') )  ?? 'Not Completed', 
                    's_q343_date_compilation_key' =>  isset($this->getMeta('s_q343')['s_q343_date_compilation_key']) ? (ensure_date_format( $this->getMeta('s_q343')['s_q343_date_compilation_key'] ) ?? null): null ),
            "s_q344" => array( 
                    'label' => 'SQ 3.4.4', 
                    'value' => ( is_array($this->getMeta('s_q344')) ? $this->getMeta('s_q344')['value']: $this->getMeta('s_q344') )  ?? 'Not Completed', 
                    's_q344_date_compilation_key' => isset($this->getMeta('s_q344')['s_q344_date_compilation_key']) ? (ensure_date_format($this->getMeta('s_q344')['s_q344_date_compilation_key']) ?? null): null ),
            "s_q345" => array( 
                'label' => 'SQ 3.4.5', 
                'value' => ( is_array($this->getMeta('s_q345')) ? $this->getMeta('s_q345')['value']: $this->getMeta('s_q345') )  ?? 'Not Completed', 
                's_q345_date_compilation_key' => isset($this->getMeta('s_q345')['s_q345_date_compilation_key']) ? (ensure_date_format( $this->getMeta('s_q345')['s_q345_date_compilation_key'] ) ?? null): null ),
            "s_q346" => array( 
                'label' => 'SQ 3.4.6', 
                'value' => ( is_array($this->getMeta('s_q346')) ? $this->getMeta('s_q346')['value']: $this->getMeta('s_q346') )  ?? 'Not Completed', 
                's_q346_date_compilation_key' => isset($this->getMeta('s_q346')['s_q346_date_compilation_key']) ? (ensure_date_format( $this->getMeta('s_q346')['s_q346_date_compilation_key'] ) ?? null): null ),
            "s_q347" => array( 
                'label' => 'SQ 3.4.7', 
                'value' => ( is_array($this->getMeta('s_q347')) ? $this->getMeta('s_q347')['value']: $this->getMeta('s_q347') )  ?? 'Not Completed', 
                's_q347_date_compilation_key' => isset($this->getMeta('s_q347')['s_q347_date_compilation_key']) ? (ensure_date_format( $this->getMeta('s_q347')['s_q347_date_compilation_key'] ) ?? null): null ),
            "s_q348" => array( 
                'label' => 'SQ 3.4.8', 
                'value' => ( is_array($this->getMeta('s_q348')) ? $this->getMeta('s_q348')['value']: $this->getMeta('s_q348') )  ?? 'Not Completed', 
                's_q348_date_compilation_key' => isset($this->getMeta('s_q348')['s_q348_date_compilation_key']) ? (ensure_date_format( $this->getMeta('s_q348')['s_q348_date_compilation_key'] ) ?? null): null ),
            "s_q349" => array( 
                'label' => 'SQ 3.4.9', 
                'value' => ( is_array($this->getMeta('s_q349')) ? $this->getMeta('s_q349')['value']: $this->getMeta('s_q349') )  ?? 'Not Completed', 
                's_q349_date_compilation_key' => isset($this->getMeta('s_q349')['s_q349_date_compilation_key']) ? (ensure_date_format( $this->getMeta('s_q349')['s_q349_date_compilation_key'] ) ?? null): null ),
            "20206_hour_training" => array( 'label' => 'Yearly 6-hour Training',  'value' => $this->getMeta('20206_hour_training') ?? 'Not Completed', '20206_hour_training_creation_date' => $this->getMeta('20206_hour_training_creation_date') ?? null ),
            "emergency_plan" => array( 'label' => 'Emergency Plan',  'value' => $this->getMeta('emergency_plan') ),
        ];
    }

    public function getTrainingInfoForHumans(): array
    {
        return [
            'First Aid/CPR'   => ensure_date_format($this->getMeta('first_aid_cpr')),
            'Fire Safety'   => ensure_date_format($this->getMeta('fire_safety')),
            'Mandated Reported'  => ensure_date_format($this->getMeta('mandated_reported')),
            'Health & Safety'  => ensure_date_format($this->getMeta('health_safety')),
            'Stars 101'   => ensure_date_format($this->getMeta('stars101')),
            'Stars 102'  => ensure_date_format($this->getMeta('stars102')),
            'SQ 3.4.3'   => $this->getMeta('s_q343') ?? 'Not Completed',
            'SQ 3.4.4'   => $this->getMeta('s_q344') ?? 'Not Completed',
            'SQ 3.4.5'   => $this->getMeta('s_q345') ?? 'Not Completed',
            'SQ 3.4.7'   => $this->getMeta('s_q347') ?? 'Not Completed',
            'SQ 3.4.8'   => $this->getMeta('s_q348') ?? 'Not Completed',
            'SQ 3.4.9'   => $this->getMeta('s_q349') ?? 'Not Completed',
            '2020 6-hour Training'   => $this->getMeta('20206_hour_training') ?? 'Not Completed',
            'Emergency Plan'   => $this->getMeta('emergency_plan') ?? 'Not Completed',
        ];
    }

    public function getEmploymentRequirementsInfo()
    {
        return [
            "w4"                => ensure_date_format($this->getMeta('w4')),
            "resume"            => $this->getMeta('resume') ?? 'Not Submitted',
            "reference1"        => $this->getMeta('reference1') ?? 'Not Submitted',
            "reference2"        => $this->getMeta('reference2') ?? 'Not Submitted',
            "drivers_license"   => $this->getMeta('drivers_license') ?? 'Not Submitted',
            "emergency_contact" => ensure_date_format($this->getMeta('emergency_contact')),
            "signed_disclosure" => ensure_date_format($this->getMeta('signed_disclosure')),
            "emergency_plan"    => ensure_date_format($this->getMeta('emergency_plan')),
            "job_description"   => $this->getMeta('job_description') ?? 'Not Submitted',
            "staff_handbook"    => ensure_date_format($this->getMeta('staff_handbook')),
            "staff_data_sheet"  => ensure_date_format($this->getMeta('staff_data_sheet')),
        ];
    }

    public function getEmploymentRequirementsInfoForHumans()
    {
        return [
            'W4' => ensure_date_format($this->getMeta('w4')),
            'Resume' => $this->getMeta('resume') ?? 'Not Submitted',
            'Reference 1' => $this->getMeta('reference1') ?? 'Not Submitted',
            'Reference 2' => $this->getMeta('reference2') ?? 'Not Submitted',
            "Driver's License" => $this->getMeta('drivers_license') ?? 'Not Submitted',
            'Emergency Contact' => ensure_date_format($this->getMeta('emergency_contact')),
            'Signed Disclosure' => ensure_date_format($this->getMeta('signed_disclosure')),
            'Emergency Plan' => ensure_date_format($this->getMeta('emergency_plan')),
            'Job Description' => $this->getMeta('job_description') ?? 'Not Submitted',
            'Staff Handbook' => ensure_date_format($this->getMeta('staff_handbook')),
            'Staff Data Sheet' => ensure_date_format($this->getMeta('staff_data_sheet')),
        ];
    }

    public function saveProfileFields(array $data): void
    {
        foreach ($data as $key => $value) {
            if (is_array($value)) {
                // Extract Array and Get index does have VALUE and _KEY value
                $newMetaValue = [];
                foreach($value as $index => $value) {
                    if ( $index == 'value' || strpos($index, '_key') ) {
                        $newMetaValue[$index] = $value;
                    }
                }
                $this->setMeta($key,  count($newMetaValue) > 1 ? $newMetaValue: array_values($newMetaValue)[0] );
            } else {
                $this->setMeta($key, $value);
            }

            // This is only intended for 2020 6hours training
            if ($key == '20206_hour_training') {
                $this->setMeta($key.'_creation_date', Carbon::now()->format('m/d/Y') );
            }
            
        }
    }
}
