<?php

namespace App\Http\Livewire\Parents\ParentsForm;

use Livewire\Component;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

use App\Traits\Fields\ParentFormFields;
use App\Traits\ParentForm;

class ParentsForm extends Component
{
    use ParentFormFields, AuthorizesRequests, ParentForm;

    public $user; 
    public $route = 'parents.parents-form.parents-form';
    public $edited = false;
    
    public function submit(  ) {
  
         // Populate for saving record
        $result = $this->populateData(  );
        
        if ( $result ) {
            session()->flash('success', "Parent data successfully saved. Please check your email to confirm and create password.");
        
            return redirect()->route('parents');
        }
        
    }

    public function render()
    {
        return view('livewire.parents.parents-form.parents-form');
    }
}
