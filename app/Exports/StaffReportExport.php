<?php

namespace App\Exports;

use App\Models\User;

use Maatwebsite\Excel\Concerns\{
    FromCollection,
    ShouldAutoSize,
    WithHeadings,
};

use Illuminate\Support\LazyCollection;

class StaffReportExport implements FromCollection, WithHeadings, ShouldAutoSize
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $staffList = User::with(['getEmployeeInfo','getDisclosureAgreement', 
                'getHandbookAgreement', 'getEmergencyContactDetails',
                'getEmergencyContact'])->UserRole('staff')->get();

        $staffTransformed = [];
        
        foreach ($staffList as $key => $staff) {

            $getEmployeeInfo = $staff->getEmployeeInfo ?? null;
            $getStaffDisclosureAgreement = $staff->getDisclosureAgreement ?? null;
            $getStaffHandbookAgreement = $staff->getHandbookAgreement ?? null;
            $getStaffEmergencyContactsList = $staff->getEmergencyContactDetails ?? null;
            $getStaffEmergencyContacts = $staff->getEmergencyContact ?? null;

            $staffTransformed[$key] = [
                    'Staff First Name' => $staff['first_name'],
                    'Staff Last Name' => $staff['last_name'],
                    'Title' => $staff->getGeneralInfo()['title'] ?? null,
                    'DOB' => $staff->getGeneralInfo()['dob'] ?? null,
                    'Phone Number' => $staff->getGeneralInfo()['phone_number'] ?? null,
                    'Email Address' => $staff->getGeneralInfo()['email'] ?? null,
                    'DOH' => $staff->getGeneralInfo()['doh'] ?? null,
                    'First Date in Childcare' => $staff->getGeneralInfo()['first_date_in_child_care'] ?? null,
                    'PD Registry' => $staff->getGeneralInfo()['pd_registry'] ?? null,
                    'Employee Data Sheet - Status' => $getEmployeeInfo && $getEmployeeInfo->date_submitted ? "Submitted & Acknowledged" : "Incomplete",
                    'Disclosure Statement - Status' => $getStaffDisclosureAgreement && $getStaffDisclosureAgreement->date_signed_disclosure_agreement? "Disclosure Signed": "Disclosure Not Signed",
                    'Disclosure Statement - Signed Date' => $getStaffDisclosureAgreement && $getStaffDisclosureAgreement->date_signed_disclosure_agreement ? $getStaffDisclosureAgreement->date_signed_disclosure_agreement: null,
                    'Staff Handbook - Status' => $getStaffHandbookAgreement && $getStaffHandbookAgreement->date_signed_disclosure_agreement? 'Handbook Signed' : 'Handbook Not Signed',
                    'Staff Handbook - Signed Date' => $getStaffHandbookAgreement && $getStaffHandbookAgreement->date_signed_disclosure_agreement ? $getStaffHandbookAgreement->date_signed_disclosure_agreement: null,
                    'HS Diploma - Date' => $staff->getEducationInfo()['hs_diploma'] ?? null,
                    'HS Diploma - Documentation' => $staff->getEducationInfo()['hs_diploma'] ? 'TRUE': 'FALSE',
                    'College Diploma - Date' => $staff->getEducationInfo()['college_diploma'] ?? null,
                    'College Diploma - Documentation' => $staff->getEducationInfo()['college_diploma'] ? 'TRUE': 'FALSE',
                    'College Transcripts - Date' => $staff->getEducationInfo()['college_transcripts'] ?? null,
                    'College Transcripts - Documentation' => $staff->getEducationInfo()['college_transcripts'] ? 'TRUE': 'FALSE',
                    'CDA - Date' => $staff->getEducationInfo()['cda'] ?? null,
                    'CDA -Documentation' => $staff->getEducationInfo()['cda'] ? 'TRUE': 'FALSE',
                    'Other Relevant Education - Date' => $staff->getEducationInfo()['other_relevant_education'] ?? null,
                    'Health Assessment/TB - Date' => $staff->getClearancesInfo()['health_assessment_tb'] ?? null,
                    'Health Assessment/TB - Documentation' => $staff->getClearancesInfo()['health_assessment_tb'] ? 'TRUE': 'FALSE',
                    'Child Abuse - Date' => $staff->getClearancesInfo()['child_abuse'] ?? null,
                    'Child Abuse - Documentation' => $staff->getClearancesInfo()['child_abuse'] ? 'TRUE': 'FALSE',
                    'State Police - Date' => $staff->getClearancesInfo()['state_police'] ?? null,
                    'FBI Fingerprinting - Date' => $staff->getClearancesInfo()['fbi_fingerprinting'] ?? null,
                    'FBI Fingerprinting - Documentation' => $staff->getClearancesInfo()['fbi_fingerprinting'] ? 'TRUE': 'FALSE',
                    'NSOR - Date' => $staff->getClearancesInfo()['nsor'] ?? null,
                    'NSOR - Documentation' => $staff->getClearancesInfo()['nsor'] ? 'TRUE': 'FALSE',
                    'Emergency Contact - Status' => $getStaffEmergencyContacts && $getStaffEmergencyContacts->status ? 'TRUE': 'FALSE',
                    'Emergency 1 Contact Name' => count($getStaffEmergencyContactsList) > 0 ? $getStaffEmergencyContactsList->toArray()[0]['emergency_contact_name'] : null,
                    'Emergency 1 Home Phone' => count($getStaffEmergencyContactsList) > 0 ? $getStaffEmergencyContactsList->toArray()[0]['emergency_home_phone'] : null,
                    'Emergency 1 Cell Phone' => count($getStaffEmergencyContactsList) > 0 ? $getStaffEmergencyContactsList->toArray()[0]['emergency_cell_phone'] : null,
                    'Emergency 1 Work Phone' => count($getStaffEmergencyContactsList) > 0 ? $getStaffEmergencyContactsList->toArray()[0]['emergency_work_phone'] : null,
                    'Emergency 1 Relation to Staff' => count($getStaffEmergencyContactsList) > 0 ? $getStaffEmergencyContactsList->toArray()[0]['emergency_relation_to_staff'] : null,
                    'Emergency 2 Contact Name' => count($getStaffEmergencyContactsList) > 0 ? $getStaffEmergencyContactsList->toArray()[1]['emergency_contact_name'] : null,
                    'Emergency 2 Home Phone' => count($getStaffEmergencyContactsList) > 0 ? $getStaffEmergencyContactsList->toArray()[1]['emergency_home_phone'] : null,
                    'Emergency 2 Cell Phone' => count($getStaffEmergencyContactsList) > 0 ? $getStaffEmergencyContactsList->toArray()[1]['emergency_cell_phone'] : null,
                    'Emergency 2 Work Phone' => count($getStaffEmergencyContactsList) > 0 ? $getStaffEmergencyContactsList->toArray()[1]['emergency_work_phone'] : null,
                    'Emergency 2 Relation to Staff' => count($getStaffEmergencyContactsList) > 0 ? $getStaffEmergencyContactsList->toArray()[1]['emergency_relation_to_staff'] : null,
                    'Staff Allergies' => $getStaffEmergencyContacts && $getStaffEmergencyContacts->staff_allergies ? $getStaffEmergencyContacts->staff_allergies: null,
                    'Staff Reactions to allergies' => $getStaffEmergencyContacts && $getStaffEmergencyContacts->staff_allergies ? $getStaffEmergencyContacts->staff_allergies: null,
                    'Staff Medication' => $getStaffEmergencyContacts && $getStaffEmergencyContacts->staff_medication ? $getStaffEmergencyContacts->staff_medication: null,
                    'Staff Medical Conditions' => $getStaffEmergencyContacts && $getStaffEmergencyContacts->staff_medical_conditions ? $getStaffEmergencyContacts->staff_medical_conditions: null,
                    'Actions Needed to Medical Conditions' => $getStaffEmergencyContacts && $getStaffEmergencyContacts->actions_needed_to_medical_conditions ? $getStaffEmergencyContacts->actions_needed_to_medical_conditions : null,
                    'Medical Insurance (Staff)' => $getStaffEmergencyContacts && $getStaffEmergencyContacts->staff_medical_insurance ? $getStaffEmergencyContacts->staff_medical_insurance: null,
                    'Policy Number (Staff)' => $getStaffEmergencyContacts && $getStaffEmergencyContacts->staff_policy_number ? $getStaffEmergencyContacts->staff_policy_number: null,
                    'First Aid/CPR - Date' => $staff->getTrainingInfo()['first_aid_cpr']['value'] ?? null,
                    'First Aid/CPR - Documentation' => $staff->getTrainingInfo()['first_aid_cpr']['value'] ? 'Completed: '.$staff->getTrainingInfo()['first_aid_cpr']['value'] : 'Missing Documentation',
                    'Fire Safety - Date' => $staff->getTrainingInfo()['fire_safety']['value'] ?? null,
                    'Fire Safety - Documentation' => $staff->getTrainingInfo()['fire_safety']['value'] ? 'Completed: '.$staff->getTrainingInfo()['fire_safety']['value'] : 'Missing Documentation',
                    'Mandated Reported - Date' => $staff->getTrainingInfo()['mandated_reported']['value'] ?? null,
                    'Mandated Reporter - Documentation' => $staff->getTrainingInfo()['mandated_reported']['value'] ? 'Completed: '.$staff->getTrainingInfo()['mandated_reported']['value'] : 'Missing Documentation',
                    'Health & Safety - Date' => $staff->getTrainingInfo()['health_safety']['value'] ?? null,
                    'Health & Safety - Documentation' => $staff->getTrainingInfo()['health_safety']['value'] ? 'Completed: '.$staff->getTrainingInfo()['health_safety']['value'] : 'Missing Documentation',
                    'Stars 101 - Date' => $staff->getTrainingInfo()['stars101']['value'] ?? null,
                    'Stars 101 - Documentation' => $staff->getTrainingInfo()['stars101']['value'] ? 'Completed: '.$staff->getTrainingInfo()['stars101']['value'] : 'Missing Documentation',
                    'Stars 102 - Date' => $staff->getTrainingInfo()['stars102']['value'] ?? null,
                    'Stars 102 - Documentation' => $staff->getTrainingInfo()['stars102']['value'] ? 'Completed: '.$staff->getTrainingInfo()['stars102']['value'] : 'Missing Documentation',
                    'SQ 3.4.3 - Date' => $staff->getTrainingInfo()['s_q343']['s_q343_date_compilation_key'] ?? null,
                    'SQ 3.4.3 - Status' => $staff->getTrainingInfo()['s_q343']['s_q343_date_compilation_key'] ? 'Completed: '.$staff->getTrainingInfo()['s_q343']['s_q343_date_compilation_key'] : 'Missing Documentation',
                    'SQ 3.4.4 - Date' => $staff->getTrainingInfo()['s_q344']['s_q344_date_compilation_key'] ?? null,
                    'SQ 3.4.4 - Status' => $staff->getTrainingInfo()['s_q344']['s_q344_date_compilation_key'] ? 'Completed: '.$staff->getTrainingInfo()['s_q344']['s_q344_date_compilation_key'] : 'Missing Documentation',
                    'SQ 3.4.5 - Date' => $staff->getTrainingInfo()['s_q345']['s_q345_date_compilation_key'] ?? null,
                    'SQ 3.4.5 - Status' => $staff->getTrainingInfo()['s_q345']['s_q345_date_compilation_key'] ? 'Completed: '.$staff->getTrainingInfo()['s_q345']['s_q345_date_compilation_key'] : 'Missing Documentation',
                    'SQ 3.4.6 - Date' => $staff->getTrainingInfo()['s_q346']['s_q346_date_compilation_key'] ?? null,
                    'SQ 3.4.6 - Status' => $staff->getTrainingInfo()['s_q346']['s_q346_date_compilation_key'] ? 'Completed: '.$staff->getTrainingInfo()['s_q346']['s_q346_date_compilation_key'] : 'Missing Documentation',
                    'SQ 3.4.7 - Date' => $staff->getTrainingInfo()['s_q347']['s_q347_date_compilation_key'] ?? null,
                    'SQ 3.4.7 - Status' => $staff->getTrainingInfo()['s_q347']['s_q347_date_compilation_key'] ? 'Completed: '.$staff->getTrainingInfo()['s_q347']['s_q347_date_compilation_key'] : 'Missing Documentation',
                    'SQ 3.4.8 - Date' => $staff->getTrainingInfo()['s_q348']['s_q348_date_compilation_key'] ?? null,
                    'SQ 3.4.8 - Status' => $staff->getTrainingInfo()['s_q348']['s_q348_date_compilation_key'] ? 'Completed: '.$staff->getTrainingInfo()['s_q348']['s_q348_date_compilation_key'] : 'Missing Documentation',
                    'SQ 3.4.9 - Date' => $staff->getTrainingInfo()['s_q349']['s_q349_date_compilation_key'] ?? null,
                    'SQ 3.4.9 - Status' => $staff->getTrainingInfo()['s_q349']['s_q349_date_compilation_key'] ? 'Completed: '.$staff->getTrainingInfo()['s_q349']['s_q349_date_compilation_key'] : 'Missing Documentation',
                    'Yearly 6-hour Training - Date' => $staff->getTrainingInfo()['20206_hour_training']['20206_hour_training_creation_date'] ?? null,
                    'Yearly 6-hour Training - Status' => $staff->getTrainingInfo()['20206_hour_training']['value'] ?? 'Not Completed',
                    'Yearly 6-hour Training - Documentation' => $staff->getTrainingInfo()['20206_hour_training']['value'] ? $staff->getTrainingInfo()['20206_hour_training']['value'].$staff->getTrainingInfo()['20206_hour_training']['20206_hour_training_creation_date'] : 'Missing Documentation',
                    'Emergency Plan' => $staff->getTrainingInfo()['emergency_plan']['value'] ? 'Completed: '.$staff->getTrainingInfo()['emergency_plan']['value']: 'Missing Documentation',
                    'W4 - Date' => $staff->getEmploymentRequirementsInfo()['w4'] ?? null,
                    'W4 - Documentation' => $staff->getEmploymentRequirementsInfo()['w4'] ? 'TRUE': 'FALSE',
                    'Resume - Status' => $staff->getEmploymentRequirementsInfo()['resume'] ?? 'Not Submitted',
                    'Resume - Documentation' => $staff->getEmploymentRequirementsInfo()['resume'] ? 'TRUE': 'FALSE',
                    'Reference 1 - Status' => $staff->getEmploymentRequirementsInfo()['reference1'] ?? 'Not Submitted',
                    'Reference 1 - Documentation' => $staff->getEmploymentRequirementsInfo()['reference1'] ? 'TRUE': 'FALSE',
                    'Reference 2 - Status' => $staff->getEmploymentRequirementsInfo()['reference2'] ?? 'Not Submitted',
                    'Reference 2 - Documentation'  => $staff->getEmploymentRequirementsInfo()['reference2'] ? 'TRUE': 'FALSE',
                    "Driver's License - Status" => $staff->getEmploymentRequirementsInfo()['drivers_license'] ?? 'Not Submitted',
                    "Driver's LIcense - Documentation" => $staff->getEmploymentRequirementsInfo()['drivers_license'] ? 'TRUE': 'FALSE',
                    "Job Description - Status" => $staff->getEmploymentRequirementsInfo()['job_description'] ? 'TRUE': 'FALSE',
                    "Job Description - Documentation" => $staff->getEmploymentRequirementsInfo()['job_description'] ?? 'Not Submitted',
                ];
               
        }
    

        return collect($staffTransformed);
    }

    public function headings(): array
    {
        return [
            'Staff First Name',
            'Staff Last Name',
            'Title',
            'DOB',
            'Phone Number',
            'Email Address',
            'DOH',
            'First Date in Childcare',
            'PD Registry',
            'Employee Data Sheet - Status',
            'Disclosure Statement - Status',
            'Disclosure Statement - Signed Date',
            'Staff Handbook - Status',
            'Staff Handbook - Signed Date',
            'HS Diploma - Date',
            'HS Diploma - Documentation',
            'College Diploma - Date',
            'College Diploma - Documentation',
            'College Transcripts - Date',
            'College Transcripts - Documentation',
            'CDA - Date',
            'CDA -Documentation',
            'Other Relevant Education - Date',
            'Health Assessment/TB - Date',
            'Health Assessment/TB - Documentation',
            'Child Abuse - Date',
            'Child Abuse - Documentation',
            'State Police - Date',
            'FBI Fingerprinting - Date',
            'FBI Fingerprinting - Documentation',
            'NSOR - Date',
            'NSOR - Documentation',
            'Emergency Contact - Status',
            'Emergency 1 Contact Name',
            'Emergency 1 Home Phone',
            'Emergency 1 Cell Phone',
            'Emergency 1 Work Phone',
            'Emergency 1 Relation to Staff',
            'Emergency 2 Contact Name',
            'Emergency 2 Home Phone',
            'Emergency 2 Cell Phone',
            'Emergency 2 Work Phone',
            'Emergency 2 Relation to Staff',
            'Staff Allergies',
            'Staff Reactions to allergies',
            'Staff Medication',
            'Staff Medical Conditions',
            'Actions Needed to Medical Conditions',
            'Medical Insurance (Staff)',
            'Policy Number (Staff)',
            'First Aid/CPR - Date',
            'First Aid/CPR - Documentation',
            'Fire Safety - Date',
            'Fire Safety - Documentation',
            'Mandated Reported - Date',
            'Mandated Reporter - Documentation',
            'Health & Safety - Date',
            'Health & Safety - Documentation',
            'Stars 101 - Date',
            'Stars 101 - Documentation',
            'Stars 102 - Date',
            'Stars 102 - Documentation',
            'SQ 3.4.3 - Date',
            'SQ 3.4.3 - Status',
            'SQ 3.4.4 - Date',
            'SQ 3.4.4 - Status',
            'SQ 3.4.5 - Date',
            'SQ 3.4.5 - Status',
            'SQ 3.4.6 - Date',
            'SQ 3.4.6 - Status',
            'SQ 3.4.7 - Date',
            'SQ 3.4.7 - Status',
            'SQ 3.4.8 - Date',
            'SQ 3.4.8 - Status',
            'SQ 3.4.9 - Date',
            'SQ 3.4.9 - Status',
            'Yearly 6-hour Training - Date',
            'Yearly 6-hour Training - Status',
            'Yearly 6-hour Training - Documentation',
            'Emergency Plan',
            'W4 - Date',
            'W4 - Documentation',
            'Resume - Status',
            'Resume - Documentation',
            'Reference 1 - Status',
            'Reference 1 - Documentation',
            'Reference 2 - Status',
            'Reference 2 - Documentation',
            "Driver's License - Status",
            "Driver's LIcense - Documentation",
            "Job Description - Status",
            "Job Description - Documentation",
        ];
    }
}
