<?php

namespace App\Http\Livewire\Dashboard\DashboardAlertSection;

use Livewire\Component;
use App\Traits\Fields\DashboardFields;

class EmergencyContactSection extends Component
{
    use DashboardFields;

    public function render()
    { 
        return view('livewire.dashboard.dashboard-alert-section.emergency-contact-section', $this->OutdatedEmergencyContactList );
    }
}
