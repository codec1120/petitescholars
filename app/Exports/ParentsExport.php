<?php

namespace App\Exports;

use App\Models\User;

use Maatwebsite\Excel\Concerns\{
    FromCollection,
    ShouldAutoSize,
    WithHeadings,
};


class ParentsExport implements FromCollection, WithHeadings, ShouldAutoSize
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $parentList = User::with(['getParentData', 'getChild'])->UserRole('parent')->get();
        
        $parentCollection = [];
        $keyCnt = 0;

        foreach ($parentList as $parentKeyIndex => $parent) {

            $parentData = $parent->getParentData ?? null;
            $parentChildData = $parent->getChild ?? null;
            
            if (count($parentChildData) > 0) {
                foreach ($parentChildData as $childKeyIndex => $child) {
                    $parentCollection[$keyCnt] = [
                        'Parent First Name' => $parent->first_name,
                        'Parent Last Name' => $parent->last_name,
                        'Phone Number' => $parentData->phone_number_1 ?? $parent->phone_number,
                        'Phone Type' => $parentData->phone_type_1 ?? null,
                        'Address' => $parentData->address ?? null,
                        'City' => $parentData->city ?? null,
                        'State' => $parentData->state ?? null,
                        'Zip' => $parentData->zip ?? null,
                        'Email' => $parentData->email_address ?? $parent->email,
                        'Role' => 'Parent',
                        'Status' => $parentData && $parentData->status ? 'Active': 'Not Active', 
                        'Child Name' => $child->first_name.' '.$child->last_name
                    ];

                    $keyCnt += 1;
                }
            } else {
                $parentCollection[$keyCnt] = [
                    'Parent First Name' => $parent->first_name,
                    'Parent Last Name' => $parent->last_name,
                    'Phone Number' => $parentData->phone_number_1 ?? $parent->phone_number,
                    'Phone Type' => $parentData->phone_type_1 ?? null,
                    'Address' => $parentData->address ?? null,
                    'City' => $parentData->city ?? null,
                    'State' => $parentData->state ?? null,
                    'Zip' => $parentData->zip ?? null,
                    'Email' => $parentData->email_address ?? $parent->email,
                    'Role' => 'Parent',
                    'Status' => $parentData && $parentData->status ? 'Active': 'Not Active', 
                    'Child Name' => null
                ];
                $keyCnt += 1;
            }
        }

        return collect($parentCollection);
    }

    public function headings(): array
    {
        return [
            'Parent First Name',
            'Parent Last Name',
            'Phone Number',
            'Phone Type',
            'Address',
            'City',
            'State',
            'Zip',
            'Email',
            'Role',
            'Status',
            'Child Name'
        ];
    }
}
