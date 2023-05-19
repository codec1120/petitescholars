<?php

namespace App\Http\Livewire\Settings;

use Livewire\Component;

use App\Traits\Fields\ImmunizationFields;
use App\Traits\ImmunizationData;

class Immunization extends Component
{
    use ImmunizationFields, ImmunizationData;

    public $editImmunization=false;

    public function mount ()
    {
        // $this->getImmunizationData();
    }

    public function render()
    {
        return view('livewire.settings.immunization');
    }

    public function enableImmunizationModal ($key)
    {
        $this->editImmunization = true;

        if ($this->immunizationFields[$key]) {
            $this->selectedImmunizationFields['selected_immunization_dosage']= $this->immunizationFields[$key]['value'];
            $this->selectedImmunizationFields['immunization_index'] = $key;
            
        } else {
            return $this->selectedImmunizationFields['immunization_index'] = $key;
        }
    }

    public function submitImmunization ()
    {
        if ($this->validateImmunizationRecord()) {
            return $this->alert('warning','Please complete all required fields.');
        }

        $this->ImmunizationSettings();

        return $this->editImmunization = false;
    }

    public function validateImmunizationRecord()
    {
        $immunizationRecordCount = 0;
         
         foreach ($this->immunizationFields[$this->selectedImmunizationFields['immunization_index']]['dosages'] as $key => $immnunization) {
            if ($immnunization['dose_age_month'] || $immnunization['dose_age_year']) {
               $immunizationRecordCount += 1;
            }
         }
         
        if ($immunizationRecordCount <= 0) {
            return true;
        }

        return false;
    }
}
