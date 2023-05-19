<?php

namespace App\Traits;

use App\Models\{
    FrequencyChildProfile
};

use App\Traits\Fields\FrequencyFields;

trait FrequencyData {

    public function getData($id = null)
    {
        $this->frequencyChildProfileFields = FrequencyChildProfile::when($id, fn($query) => $query->where('id', $id) )->get();
        
        return $this->frequencyChildProfileFields;
    }

    public function frequencySaveSettings()
    {
        FrequencyChildProfile::where('id', $this->frequencyFormFields['id'])
                            ->update([
                                'frequency' => $this->frequencyFormFields['frequency'].' '.$this->frequencyFormFields['frequency_date_type'],
                                'frequency_type' => $this->frequencyFormFields['frequency_type'],
                                'activity' => $this->frequencyFormFields['activity'] ? 'Enable': 'Disable',
                            ]);
        return $this->alert('success','Successfully Updated Frequency Settings.');
    }
}
