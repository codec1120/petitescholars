<?php

namespace App\Http\Livewire\Parents;

use Livewire\Component;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

use App\Traits\Fields\ParentsViewFields;

use App\Traits\ParentsViewData;

use App\Http\Livewire\DataTable\{
    WithSorting, 
    WithCachedRows, 
    WithBulkActions, 
    WithPerPagePagination
};

use \Illuminate\Session\SessionManager;

use App\Traits\{ ChildrenViewData, DashboardData };

use App\Models\User;

class ParentsView extends Component
{   
    use AuthorizesRequests; 
    use ParentsViewFields; 
    use ParentsViewData;
    use WithPerPagePagination;
    use WithSorting;
    use WithCachedRows;
    use WithBulkActions;
    use AuthorizesRequests;
    use ChildrenViewData, DashboardData;

    public $user; 
    public $route = 'parents.parents-view';
    public $role;
    public $search;
    public $parentChildToUpdate = [];
    public $displayChildToUpdateNotificationModal = false;
    public $parent;
    public $incompleData = false;
    public $diplayIncompleDatamodal = false;

    public $showDeleteModal = false;
    public $onlyTrashed = false;

    public function mount( SessionManager $session) {
        $this->parent = auth()->user();
        $this->parentLoggedInCheckChildInfoToUpdate( $session );
        $this->incompleData = $this->checkParentNewRequiredInfor(Auth()->user()->id) ? true : false;
    }

    public function parentLoggedInCheckChildInfoToUpdate ( $session ) {
        $this->parentChildToUpdate = $this->checkChildInformationIsUpdated();
        if ( $this->parentChildToUpdate ) {
            $this->displayChildToUpdateNotificationModal = $session->get('disable_parent_notification') ? false : true ;
        }
    }

    public function removeNotification ( SessionManager $session ) {
        // For Future functionality
        $session->put('disable_parent_notification', true);
        $this->displayChildToUpdateNotificationModal = false;
    }

    public function proceedToChildList () {
        return redirect()->route('children', 'list_of_child_info_to_update=true' );
    }

    public function archive ( $parentId = null ) {
        // Soft Delete Parent Record
        $this->archiveParent( $parentId );

        // Enable alert message
        session()->flash('success', "Successfully archived record.");
    }

    public function createParentData () {
        return redirect()->route('parents.parents-form.parents-form');
    }

    public function redirectParentToAccount ()
    {
        return redirect()->route('users.show', Auth()->user()->id);
    }

    public function render() {   
        return view('livewire.parents.parents-view',  $this->getParentData( $this->search, $this->onlyTrashed ) );
    }
}
