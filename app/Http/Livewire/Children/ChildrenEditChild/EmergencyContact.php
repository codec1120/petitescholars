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

class EmergencyContact extends Component
{
    use ChilldrenFields, ChildrenViewData;

    public $disableInputs = true;
    public $child_id;

    public $directory = 'children_permision_slips';
    protected $disk = 'spaces';

    public function render()
    {
        return view('livewire.children.children-edit-child.emergency-contact');
    }

    public function submit ()
    {
        $this->disableInputs = true;
        return $this->createEmergencyContact($this->child_id);
    }

    public function mount ($child_id)
    {
        $this->child_id = $child_id;

        return $this->getChildStepsInformation($this->child_id);
    }
}
