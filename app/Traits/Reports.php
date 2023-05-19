<?php

namespace App\Traits;

use App\Models\User;

trait Reports 
{
    public function exportStaffDetails ()
    {
        
        $staffToExport = [];
        
        return  User::with(['getEmployeeInfo','getDisclosureAgreement', 
                                'getHandbookAgreement', 'getEmergencyContactDetails',
                                'getEmergencyContact'])->UserRole('staff')->get();
    }

    public function exportParentDetails ()
    {
        
    }

    public function exportChildrenDetails ()
    {
        
    }
}