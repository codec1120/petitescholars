<?php

namespace App\Http\Livewire\Parents\ParentsPassword;

use Livewire\Component;
use App\Traits\Fields\ParentFormFields;
use App\Traits\ParentForm;
use Illuminate\Support\Facades\Auth;

class ParentPassword extends Component
{
    use ParentFormFields, ParentForm;
    
    public $edited = false;
    public $parentId;

    public function mount( ) {
;
        // Verify Parent Id
        if ( !$this->verifyParentId( $this->parentId ) ) {
            session()->flash('warning', 'Invalid Parent ID.');
            return redirect()->route('parents');
        }

        // Verify password already populated
        if ( !empty( $this->verifyParentId( $this->parentId )['password'] ) ) {
            return redirect()->route('parents');
        }

        $this->getParentData(  $this->parentId );
    }
    
    public function submit () {

        $this::getParentData( $this->parentId );

        // Create User Access
        $this->createParentUserAccessibility( );

        // Alert
        session()->flash('success', "Successfully created user accessibility.");

        return redirect()->route('parents');
    }

    public function render()
    {
        return view('livewire.parents.parents-password.parent-password');
    }
}
