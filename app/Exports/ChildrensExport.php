<?php

namespace App\Exports;

use App\Models\ChildInformation;

use Maatwebsite\Excel\Concerns\{
    FromCollection,
    ShouldAutoSize,
    WithHeadings,
};

use App\Traits\Fields\{
    ChilldrenFields
};

use Illuminate\Support\Carbon;

class ChildrensExport implements FromCollection, WithHeadings, ShouldAutoSize
{
    use ChilldrenFields;
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $chilInfo = ChildInformation::with([
                        'getChildGuardians', 'getChildMedicalInformation',
                        'getPermissionSlips', 'getFeeAgreement', 'getRelativeInformations',
                        'getFamilyQuestionaire', 'getParentSignedHandbook', 'getPhotographPermission',
                        'getImmunization', 'getFathersInfo', 'getMothersInfo', 'getEmergencyContactPersons', 'getAuthorizePersons'
                    ])->get();

        $childInforTransform = [];

        foreach ($chilInfo as $key => $child) {
            if ($child->getMothersInfo || $child->getFathersInfo) {
                $primaryGuardian = $child->getMothersInfo['primary_guardian'] ?  $child->getMothersInfo['first_name'] .' '. $child->getMothersInfo['last_name']: $child->getFathersInfo['first_name'] .' '. $child->getFathersInfo['last_name'];
            }

            $childInforTransform[$key] = [
                'Child First Name' => $child['first_name'],
                'Child Last Name' => $child['last_name'],
                'Birthdate' => $child['birthdate'],
                'Age' => Carbon::now()->diffInYears( $child['birthdate'] ),
                'Sex' => $child['sex'] ==  1 ? 'Male' : 'Female',
                'Address' => $child['home_address'],
                'City' => $child['city'],
                'State' => $child['state'],
                'Zip' => $child['zip'],
                'Primary Guardian' => $primaryGuardian ?? null, 
                "Mother's Name" => $child->getMothersInfo ? ($child->getMothersInfo['first_name'] .' '. $child->getMothersInfo['last_name']) : null,
                "Mother's Email" => $child->getMothersInfo ? $child->getMothersInfo['email']: null, 
                "Mother's Phone" => $child->getMothersInfo ? $child->getMothersInfo['phone']: null,
                "Mother's Phone Type" => ($child->getMothersInfo && $child->getMothersInfo['phone_type']) ? $this->childs_mother['phone_type_option'][$child->getMothersInfo['phone_type']]: null,
                "Mother's Work/Employer" => $child->getMothersInfo ? $child->getMothersInfo['businesss_employer']: null,
                "Mother's Work address" => $child->getMothersInfo ? $child->getMothersInfo['work_address']: null,
                "Mother's Work City" => $child->getMothersInfo ? $child->getMothersInfo['work_city']: null,
                "Mother's Work State" => $child->getMothersInfo ? $child->getMothersInfo['work_state']: null,
                "Mother's Work Zip" => $child->getMothersInfo ? $child->getMothersInfo['work_zip']: null,
                "Father's Name"=> $child->getFathersInfo ? ($child->getFathersInfo['first_name'] .' '. $child->getFathersInfo['last_name']) : null,
                "Father's Email"=> $child->getFathersInfo ? $child->getFathersInfo['email']: null,
                "Father's Phone"=> $child->getFathersInfo ? $child->getFathersInfo['phone']: null,
                "Father's Phone Type"=> ($child->getFathersInfo && $child->getFathersInfo['phone_type'] )? $this->childs_father['phone_type_option'][$child->getFathersInfo['phone_type']]: null,
                "Father's Work/Employer"=> $child->getFathersInfo ? $child->getFathersInfo['businesss_employer']: null,
                "Father's Work address"=> $child->getFathersInfo ? $child->getFathersInfo['work_address']: null,
                "Father's Work City"=> $child->getFathersInfo ? $child->getFathersInfo['work_city']: null,
                "Father's Work State"=> $child->getFathersInfo ? $child->getFathersInfo['work_state']: null,
                "Father's Work Zip"=> $child->getFathersInfo ? $child->getFathersInfo['work_zip']: null,
                "Child Physician Name"=> $child->getChildMedicalInformation['physician_name'] ?? null,
                "Child Physician Number"=> $child->getChildMedicalInformation['physician_number'] ?? null,
                "Child Physician Address"=> $child->getChildMedicalInformation['physician_address'] ?? null,
                "Child Physician State"=> $child->getChildMedicalInformation['physician_state'] ?? null,
                "Child Physician City"=> $child->getChildMedicalInformation['physician_city'] ?? null,
            ];
        }

        return collect($childInforTransform);

    }

    public function headings(): array
    {
        return [
            'Child First Name',
            'Child Last Name',
            'Birthdate',
            'Age',
            'Sex',
            'Address',
            'City',
            'State',
            'Zip',
            'Primary Guardian',
            "Mother's Name",
            "Mother's Email",
            "Mother's Phone",
            "Mother's Phone Type",
            "Mother's Work/Employer",
            "Mother's Work address",
            "Mother's Work City",
            "Mother's Work State",
            "Mother's Work Zip",
            "Father's Name",
            "Father's Email",
            "Father's Phone",
            "Father's Phone Type",
            "Father's Work/Employer",
            "Father's Work address",
            "Father's Work City",
            "Father's Work State",
            "Father's Work Zip",
            "Child Physician Name",
            "Child Physician Number",
            "Child Physician Address",
            "Child Physician State",
            "Child Physician City",
        ];
    }
}
