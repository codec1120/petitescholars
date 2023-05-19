<?php

namespace App\Http\Livewire\Settings;

use Livewire\Component;

use App\Traits\Fields\FrequencyFields;

use App\Traits\FrequencyData;

class Frequency extends Component
{
    use FrequencyFields, FrequencyData;

    public $showFreqModal = false;
    public $selectedDocType;

    public function render()
    {
        return view('livewire.settings.frequency', $this->getData());
    }

    public function EditFrequencyMode($data)
    {
        $this->selectedDocType =  $data['doc_type'];
        $this->frequencyFormFields['id'] = $data['id'];
        $this->frequencyFormFields['activity'] = $data['activity'] == 'Enable' ? true : false;
        $this->frequencyFormFields['frequency_date_type'] = trim(preg_replace('/[0-9]+/', '', $data['frequency']));
        $this->frequencyFormFields['frequency'] = intval($data['frequency']);
        $this->frequencyFormFields['frequency_type'] = $data['frequency_type'];
        $this->showFreqModal = true;
    }

    public function submit()
    {
        $this->frequencySaveSettings();

        $this->showFreqModal = false;
    } 
}
