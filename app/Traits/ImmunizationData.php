<?php

namespace App\Traits;

use App\Traits\Fields\ImmunizationFields;

use App\Models\ImmunizationConfigurations;

use Illuminate\Support\Carbon;

use Illuminate\Support\Facades\Storage;

trait ImmunizationData 
{
   public function ImmunizationSettings ()
   {
         $immunizationRecordCount = 0;
         
         foreach ($this->immunizationFields[$this->selectedImmunizationFields['immunization_index']]['dosages'] as $key => $immnunization) {
            if ($immnunization['dose_age_month'] || $immnunization['dose_age_year']) {
               $immunizationRecord = [
                  'immunization_index' => $this->selectedImmunizationFields['immunization_index'],
                  'selected_immunization_dosage' => $this->selectedImmunizationFields['selected_immunization_dosage'],
                  'dose_age_month' => $immnunization['dose_age_month'],
                  'dose_age_year' => $immnunization['dose_age_year']
               ]; 
               
               // Delete old records that
               ImmunizationConfigurations::where([
                  'immunization_index' => $this->selectedImmunizationFields['immunization_index'],
                  'selected_immunization_dosage' => $this->selectedImmunizationFields['selected_immunization_dosage']
               ])->delete();
               // Create Immunization Record
               ImmunizationConfigurations::create($immunizationRecord);

               $immunizationRecordCount += 1;
            } 
         }
        
        // get updated data
        self::getImmunizationData();
        
        return  $this->alert('success','Successfully Created Immunization Settings.');
   }

   public function getImmunizationData ()
   {
      $immnunizations = ImmunizationConfigurations::get();
      $currentSelectedDosageIndex = '';
      $currentSelectedDosageIndexCnt = 0;
      
      if ($immnunizations) {
         
         $immnunizationsArray = $immnunizations->toArray();
         
         foreach ($immnunizationsArray as $key => $item) {
            $this->selectedImmunizationFields['immunization_index'] = $item['immunization_index'];
            $this->selectedImmunizationFields['selected_immunization_dosage'] = $item['selected_immunization_dosage'];
            $this->immunizationFields[$item['immunization_index']]['value'] = $item['selected_immunization_dosage'];
            
            if (!$currentSelectedDosageIndex || $currentSelectedDosageIndex != $item['selected_immunization_dosage']) {
               $currentSelectedDosageIndex = $item['selected_immunization_dosage'];
               $currentSelectedDosageIndexCnt = 0;
            } else {
               $currentSelectedDosageIndexCnt += 1;
            }

            $this->immunizationFields[$item['immunization_index']]['dosages'][$currentSelectedDosageIndexCnt]['dose_age_month'] = $item['dose_age_month'];
            $this->immunizationFields[$item['immunization_index']]['dosages'][$currentSelectedDosageIndexCnt]['dose_age_year'] = $item['dose_age_year'];
         }
     }
     
      return $this->immunizationFields;
   }


}