<?php

namespace App\Http\Livewire\Children\ChildrenEditChild;

use Livewire\Component;

use App\Traits\Fields\ChilldrenFields;

use App\Traits\{
    ChildrenViewData
};

use Illuminate\Support\Facades\{
    Storage
};


class EnrollmentApplication extends Component
{
    use ChilldrenFields, ChildrenViewData;

    public $disableInputs = true;
    public $child_id;
    public $motherSameAsChildAddress = false;
    public $fatherSameAsChildAddress = false;

    public $directory = 'children_permision_slips';
    protected $disk = 'spaces';


    public function render()
    {
        return view('livewire.children.children-edit-child.enrollment-application');
    }
    
    public function submit ()
    {
        $this->disableInputs = true;
        return $this->populateEnrollmentApplication(Auth()->user()->id);
    }

    public function mount ($child_id)
    {
        $this->child_id = $child_id;

        return $this->getChildStepsInformation($this->child_id);
    }
}
