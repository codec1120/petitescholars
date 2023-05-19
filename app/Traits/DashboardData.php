<?php

namespace App\Traits;

use App\Traits\Fields\ChilldrenFields;
use App\Models\{User, ChildInformation};
use DB;


trait DashboardData {
    public function getTotalUsers () {
        $parentCount = User::where('role', 'parent')->count();
        $staffCount = User::where('role', 'staff')->count();
        $childrenCount = ChildInformation::count();

        return [
            'parentCnt' => $parentCount,
            'staffCnt' => $staffCount,
            'childrenCnt' => $childrenCount,
        ];
    }

}