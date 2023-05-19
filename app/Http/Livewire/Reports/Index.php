<?php

namespace App\Http\Livewire\Reports;

use Livewire\Component;

use App\Traits\Reports;

use Illuminate\Support\Facades\Storage;

use App\Exports\{
    StaffReportExport,
    ParentsExport,
    ChildrensExport
};

use Excel;

class Index extends Component
{
    use Reports;

    public $loading = false;
    
    public function render()
    {
        return view('livewire.reports.index');
    }

    public function exportStaff ()
    {
        $this->loading = true;

        $filename = "staff/spreadsheets/Petite_Scholars_Staff.csv";

        if (Storage::disk('spaces')->has($filename)) {
            Storage::disk('spaces')->delete($filename);
        }
        
        Excel::store(
            new StaffReportExport(),
            $filename,
            'spaces',
            null
        );

        $this->loading = false;

        return Storage::disk('spaces')->download($filename);
    }

    public function exportParents ()
    {
        $this->loading = true;

        $filename = "parent/spreadsheets/Petite_Scholars_Parents.csv";

        if (Storage::disk('spaces')->has($filename)) {
            Storage::disk('spaces')->delete($filename);
        }
        
        Excel::store(
            new ParentsExport(),
            $filename,
            'spaces',
            null
        );

        $this->loading = false;

        return Storage::disk('spaces')->download($filename);
    }

    public function exportChildren ()
    {
        $this->loading = true;

        $filename = "children/spreadsheets/Petite_Scholars_Childrens.csv";

        if (Storage::disk('spaces')->has($filename)) {
            Storage::disk('spaces')->delete($filename);
        }
        
        Excel::store(
            new ChildrensExport(),
            $filename,
            'spaces',
            null
        );

        $this->loading = false;

        return Storage::disk('spaces')->download($filename);
    }
}
