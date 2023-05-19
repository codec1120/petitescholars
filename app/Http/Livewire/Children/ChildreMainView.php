<?php

namespace App\Http\Livewire\Children;

use Livewire\Component;
use App\Models\{
    User,
    ChildInformation
};

use App\Traits\Fields\ChilldrenFields;
use App\Traits\ChildrenViewData;

use Illuminate\Support\Facades\Validator;

class ChildreMainView extends Component
{
    use ChilldrenFields, ChildrenViewData;

    public $showDeleteModal = false;
    public $onlyTrashed = false;
    public $role;
    public $search;
    public $list_of_child_info_to_update;
    public $newEnrollment;
    public $user;
    public $incompleData = false;
    public $addNewChildren = false;

    protected $queryString = [
        'list_of_child_info_to_update'
    ];

    public function createChildAccount ()
    {
        $validatedData = Validator::make(
            
                [
                    'first_name' => $this->childrenFields['first_name'],
                    'last_name' => $this->childrenFields['last_name']
                ],
                [
                    'first_name' => 'required',
                    'last_name' => 'required',
                ],
                [
                    'required' => 'The :attribute field is required',
                    'required' => 'The :attribute field is required'
                ],
            
        )->validate();

        // Check if Children Name exist
        $childVerification =  ChildInformation::where([
            'first_name' => $this->childrenFields['first_name'],
            'last_name' => $this->childrenFields['last_name'],
        ])->first();

        if ($childVerification) {
            $this->alert('warning', 'Child Name Already Exist.');
            return false;
        }

        $child_id = ChildInformation::create([
                        'first_name' => $this->childrenFields['first_name'],
                        'last_name' => $this->childrenFields['last_name'],
                        'user_id' => Auth()->user()->id
                    ])->id;

        return redirect()->route('children.children-view', [
            'user' => Auth()->user()->id, 
            'first_name' => $this->childrenFields['first_name'],
            'last_name' => $this->childrenFields['last_name'],
            'child_id' => $child_id
        ]);
    }

    public function delete ( $id ) {
        $this->softChildrenInformation( $id );
    }

    public function mount (User $user)
    {
        $this->user = $user;
    }

    public function render()
    {
        return view('livewire.children.childre-main-view', $this->getRegisteredChildren( $this->search, $this->onlyTrashed, $this->list_of_child_info_to_update, $this->user->id));
    }
    
}
