<?php

namespace App\Traits;

use App\Traits\Fields\ParentsViewFields;
use App\Models\{ParentFormData, User};


trait ParentsViewData { 

    public function getParentData ( $queryString = null, $onlyTrashed ) {
        
        if ( $onlyTrashed ) {
            $parentDetails =  $queryString ? 
                                ParentFormData::with('user')->withTrashed()
                                                ->where( 'first_name', 'like', '%'.$queryString.'%')
                                                ->orWhere( 'last_name', 'like', '%'.$queryString.'%')
                                                ->whereHas('user', fn($innerQuery) => 
                                                    $innerQuery->where('users.created_from_child_contacts', 0)
                                                )
                                                ->get(): 
                                ParentFormData::with('user')
                                                ->whereHas('user', fn($innerQuery) => 
                                                    $innerQuery->where('users.created_from_child_contacts', 0)
                                                )->withTrashed()->get();

            return $this->tableRow = $parentDetails ? 
                            $parentDetails->toArray() : 
                            [];
        } else {
            $parentDetails =  $queryString ? 
                            ParentFormData::with('user')
                                            ->where( 'first_name', 'like', '%'.$queryString.'%')
                                            ->orWhere( 'last_name', 'like', '%'.$queryString.'%')
                                            ->whereHas('user', fn($innerQuery) => 
                                                $innerQuery->where('users.created_from_child_contacts', 0)
                                            )
                                            ->get(): 
                                            ParentFormData::with('user')
                                                        ->whereHas('user', fn($innerQuery) => 
                                                            $innerQuery->where('users.created_from_child_contacts', 0)
                                                        )->get();
            
            return $this->tableRow = $parentDetails ? 
                    $parentDetails->toArray() : 
                    $this->tableRow;
        }
    }

    public function archiveParent ( $parentId ) {
       ParentFormData::where('user_id', $parentId )->delete();
    }

    public function checkParentNewRequiredInfor ($parentId)
    {
        return  ParentFormData::where( 'user_id', $parentId )
                        ->whereNull('phone_number_1')
                        ->first();
    }
}