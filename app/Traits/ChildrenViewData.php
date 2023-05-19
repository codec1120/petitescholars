<?php

namespace App\Traits;

use App\Traits\Fields\{
    ChilldrenFields,
    ParentFormFields
};

use App\Traits\ParentForm;

use App\Models\{ChildInformation, ChildGuardian, ChildAuthorizedAdults,
                ChildrenEmergencyContact, ChildrenMedicalInformation,
                ChildrenPermissionSlips, ChildFeeAgreement, ChildFamilyQuestionaire,
                ChildRelativesInformation, ChildParentHandbook, ChildrenPhotographPermissionSlip,
                ChildImmunization, ImmunizationSettings, ChildImmunizationRecord, ChildrensFather,
                ChildrensMother, Role, ParentFormData, User, ChildEmergencyContactPersons, ChildAuthorizedPersons,
                ChildImmunizationInformations, ImmunizationConfigurations };

use Illuminate\Support\Carbon;

use Illuminate\Support\Facades\{
    Storage,
    Hash,
    Mail
};

trait ChildrenViewData {

    public function populateChildInformation ($parentId) {
        // Start Populating
        $childInformations = [
            'first_name'    => $this->childrenFields['first_name'],
            'last_name'     => $this->childrenFields['last_name'],
            'sex'           => $this->childrenFields['sex'],
            'home_address'       => $this->childrenFields['home_address'],
            'city'          => $this->childrenFields['city'],
            'state'         => $this->childrenFields['state'],
            'zip'           => $this->childrenFields['zip'],
            'birthdate'     => Carbon::parse( $this->childrenFields['birthdate']  )->format('Y-m-d'),
            'user_id'       =>  $parentId
        ];

        $child_id = $this->childrenFields['id'] ?
                    ChildInformation::find( $this->childrenFields['id'] )->update( $childInformations ) :
                    ChildInformation::create( $childInformations )->id;

        // Return child id
        return $this->childrenFields['id'] ? $this->childrenFields['id'] : $child_id;
    }

    public function populatePrimaryInformation ( $child_id, $guardianFirstName, $guardianLastName, $guardianEmail, $sameAsChildAddress ) {
        // Manually Validate Guardian Fields
        if ( empty( $this->primaryGuardianFields['first_name'] ) && empty( $this->primaryGuardianFields['last_name'] ) && $this->primaryGuardianFields['isPrimaryGuardian'] != 'yes' ) {
            $this->addError('primaryGuardianFields.first_name', 'This fields is required.');
            $this->addError('primaryGuardianFields.last_name', 'This fields is required.');
            $this->alert('warning', 'Primary Guardian First and Last Name are required.');
            return false;
        } else {

            // Validate Primary info if same with the Secondary Guardian info
            $duplicate = $this->validatePrimaryDuplicateWithSecondary(
                            $this->primaryGuardianFields['isPrimaryGuardian'] == 'yes' ? $guardianFirstName : $this->primaryGuardianFields['first_name'],
                            $this->primaryGuardianFields['isPrimaryGuardian'] == 'yes' ? $guardianLastName : $this->primaryGuardianFields['last_name'] );
            if ( !$duplicate ) {
                // Populate Primary Infor
                $PrimaryGuardianInformation = [
                    'first_name'    => $this->primaryGuardianFields['isPrimaryGuardian'] == 'yes' ? $guardianFirstName : $this->primaryGuardianFields['first_name'],
                    'last_name'     => $this->primaryGuardianFields['isPrimaryGuardian'] == 'yes' ? $guardianLastName : $this->primaryGuardianFields['last_name'],
                    'email_address' => $this->primaryGuardianFields['isPrimaryGuardian'] == 'yes' ? $guardianEmail :$this->primaryGuardianFields['email_address'],
                    'home_address'       => $this->primaryGuardianFields['home_address'],
                    'city'          => $this->primaryGuardianFields['city'],
                    'state'         => $this->primaryGuardianFields['state'],
                    'zip'           => $this->primaryGuardianFields['zip'],
                    'phone_number_1'=> $this->primaryGuardianFields['phone_number_1'],
                    'phone_type_1'  => $this->primaryGuardianFields['phone_type_1'],
                    'child_id'      => $child_id,
                    'primary_guardian'=> $this->primaryGuardianFields['isPrimaryGuardian'] == 'yes' ? 1: 0,
                    'sameAsChildAddress' => $sameAsChildAddress ? 1: 0
                ];

                $this->childrenFields['id'] ?
                        ChildGuardian::where( 'child_id', $child_id)
                                    ->where( 'id', $this->primaryGuardianFields['id'])
                                    ->update( $PrimaryGuardianInformation ) :
                        ChildGuardian::create( $PrimaryGuardianInformation );
                return true;
            } else {
                return false;
            }
        }
    }

    public function populateSecondaryInformation ( $child_id, $guardianFirstName, $guardianLastName, $guardianEmail, $sameAsChildAddressSecondary ) {

         // Manually Validate Guardian Fields
         if ( empty( $this->secondaryGuardianFields['first_name'] ) && empty( $this->secondaryGuardianFields['last_name']  ) && $this->secondaryGuardianFields['isSecondaryGuardian'] != 'yes' ) {
            return true;
        } else {

                 // Populate Secondary info
                $secondaryGuardianInformation = [
                    'first_name'    => $this->secondaryGuardianFields['first_name'],
                    'last_name'     => $this->secondaryGuardianFields['last_name'],
                    'email_address' => $this->secondaryGuardianFields['email_address'],
                    'home_address'  => $this->secondaryGuardianFields['home_address'],
                    'city'          => $this->secondaryGuardianFields['city'],
                    'state'         => $this->secondaryGuardianFields['state'],
                    'zip'           => $this->secondaryGuardianFields['zip'],
                    'phone_number_1'=> $this->secondaryGuardianFields['phone_number_1'],
                    'phone_type_1'  => $this->secondaryGuardianFields['phone_type_1'],
                    'child_id'      => $child_id,
                    'primary_guardian'=> $this->secondaryGuardianFields['isSecondaryGuardian'] == 'yes' ? 0 : 1,
                    'sameAsChildAddress' => $sameAsChildAddressSecondary  ? 1: 0
                ];

                $this->secondaryGuardianFields['id'] ?
                        ChildGuardian::where( 'child_id', $child_id)
                                    ->where( 'id', $this->secondaryGuardianFields['id'])
                                    ->update( $secondaryGuardianInformation ) :
                        ChildGuardian::create( $secondaryGuardianInformation );

                return true;
        }
    }

    public function populateAuthorizedAdults ( $child_id ) {
        // Delete
        ChildAuthorizedAdults::where( 'child_id', $child_id )
                            ->delete( );

        foreach ( $this->authAdultFields['authAdults'] as $key => $value) {
            $authorizedAdultInformation = [
                'first_name'             => $value['first_name'],
                'last_name'              => $value['last_name'],
                'phone_number'           => empty($value['phone_number']) ? 0 : $value['phone_number'],
                'absentee_first_name'    => $value['absentee_first_name'] ?? null,
                'absentee_last_name'     => $value['absentee_last_name'] ?? null,
                'absentee_phone_number'  => $value['absentee_phone_number'] ?? null,
                'absentee_address'       => $value['absentee_address'] ?? null,
                'child_id'      => $child_id ?? null,
            ];


            // Create
            ChildAuthorizedAdults::create( $authorizedAdultInformation );
        }
    }

    public function populateEnrollmentApplication () {
        // First Stage Save Parent as USER
        $parentId = $this->createUserForParent();

        if ($parentId) {
            // Second Stage is to populate Child information
            $child_id = $this->populateChildInformation($parentId);
            // Third Stage is to populate Parent Info
            $this->populateChildrenParents($child_id);
            // Last Stage is to populate Authorized Adults to pick-up
            // $this->populateAuthorizedAdults( $child_id );

            session()->flash('success', $this->childrenFields['id'] ? "Child Information has been updated.": "Child Information has been saved.");

            $this->childrenFields['id'] = $child_id;

            $this->getChildStepsInformation( $child_id );

            $childInfo = ChildInformation::where('id',$child_id)->first();
            ChildInformation::where('id', $child_id)->update(['completed_registration_steps' =>  1]);

            return redirect()->route('children.children-view', [
                'user' => Auth()->user()->id,
                'first_name' => $this->childrenFields['first_name'],
                'last_name' => $this->childrenFields['last_name'],
                'child_id' => $this->childrenFields['id']
            ]);
        }
    }

    public function getChildStepsInformation ( $child_id )
    {
        $enrollmentApplication = ChildInformation::with([
                'getChildGuardians', 'getChildMedicalInformation',
                'getPermissionSlips', 'getFeeAgreement', 'getRelativeInformations',
                'getFamilyQuestionaire', 'getParentSignedHandbook', 'getPhotographPermission',
                'getImmunization', 'getFathersInfo', 'getMothersInfo', 'getEmergencyContactPersons', 'getAuthorizePersons'
                ])->when( $child_id, fn($query) =>
                    $query->where('id', $child_id)
                )->when( !$child_id, fn($query) =>
                    $query->where('first_name', $this->childrenFields['first_name'])
                    ->where('last_name', $this->childrenFields['last_name'])
                )->first();

        if ( $enrollmentApplication ) {
             // Populate Child Information
            $this->childrenFields =  array_merge( $this->childrenFields, $enrollmentApplication->toArray());

            // Popualte Mothers Info
            $this->childs_mother = $enrollmentApplication->getMothersInfo ? array_merge( $this->childs_mother, $enrollmentApplication->getMothersInfo->toArray())  : $this->childs_mother;
            // Popualte Fathers Info
            $this->childs_father = $enrollmentApplication->getFathersInfo ?array_merge( $this->childs_father, $enrollmentApplication->getFathersInfo->toArray()) : $this->childs_father;

            $this->childs_mother['secondary_guardian'] = false;
             // This will populate the user_id to ensure that data would not cause relational db structure
             if ( empty( $this->childrenFields['user_id'] ) ) {
                $this->updatetUserID(  );
            }

            $this->newEmergencyContactFields['emergency_contact_opt'] = [
                [
                    'value' => $this->childs_mother['primary_guardian'] ? $this->childs_mother['id']: $this->childs_father['id'],
                    'label' => $this->childs_mother['primary_guardian'] ? ($this->childs_mother['first_name'].' '.$this->childs_mother['last_name']): ($this->childs_father['first_name'].' '.$this->childs_father['last_name'])
                ],
                [
                    'value' => $this->childs_mother['secondary_guardian'] ? $this->childs_mother['id']: $this->childs_father['id'],
                    'label' => $this->childs_mother['secondary_guardian'] ? ($this->childs_mother['first_name'].' '.$this->childs_mother['last_name']): ($this->childs_father['first_name'].' '.$this->childs_father['last_name'])
                ],
                [
                    'value' => -1,
                    'label' => 'Other'
                ]
            ];

            // Emergency Contact Persons
            $this->newEmergencyContactFields['list_of_emergency_contact_registered'] = $enrollmentApplication->getEmergencyContactPersons->count() > 0 ? $enrollmentApplication->getEmergencyContactPersons->toArray()  : $this->newEmergencyContactFields['list_of_emergency_contact_registered'];
            // Authorized Pickup Persons
            $this->newEmergencyContactFields['list_of_authorized'] = $enrollmentApplication->getAuthorizePersons->count() > 0 ?  $enrollmentApplication->getAuthorizePersons->toArray()  : $this->newEmergencyContactFields['list_of_authorized'];

            $this->newEmergencyContactFields['updated_at'] = $enrollmentApplication->getEmergencyContactPersons ? $enrollmentApplication->getEmergencyContactPersons[0]['updated_at'] ?? Carbon::now()->format('F d, Y'): '';
            // Populate Medical Information
            $this->medicalInformation = isset( $enrollmentApplication->getChildMedicalInformation ) ? array_merge( $this->medicalInformation, $enrollmentApplication->getChildMedicalInformation->toArray() ) : $this->medicalInformation;
            $this->medicalInformation['selected_option_allergy'] =  $this->medicalInformation['allergies'] ? 1: 0 ;
            $this->medicalInformation['selected_option_special_needs'] = $this->medicalInformation['special_needs'] ? 1: 0;
            $this->medicalInformation['selected_option_suffer'] = $this->medicalInformation['suffer_from'] ? 1: 0;
            $this->medicalInformation['selected_option_prescribe_medication'] = $this->medicalInformation['prescribe_medication'] ? 1: 0;
            $this->medicalInformation['suffer_from'] = $this->medicalInformation['suffer_from'] ?  explode(',', $this->medicalInformation['suffer_from']) : $this->medicalInformation['suffer_from'];

            // Populate Permission Slips
            $this->permissionSlip = isset( $enrollmentApplication->getPermissionSlips ) ? array_merge( $this->permissionSlip, $enrollmentApplication->getPermissionSlips->toArray() ): $this->permissionSlip;
            // Populate Fee Agreement Fields
            $this->feeAgreementFields = isset( $enrollmentApplication->getFeeAgreement ) ? array_merge( $this->feeAgreementFields, $enrollmentApplication->getFeeAgreement->toArray() ) : $this->feeAgreementFields;

            // Populate Primary and Secondary Guardian's Name
            if ( count( $this->feeAgreementFields['payee_options'] ) < 4 ) {
                $payee = [
                    [
                        'label' => $this->primaryGuardianFields['first_name'].' '.$this->primaryGuardianFields['last_name'],
                        'value' => 0
                    ],
                    [
                        'label' => $this->secondaryGuardianFields['first_name'].' '.$this->secondaryGuardianFields['last_name'],
                        'value' => 1
                    ]
                ];

                array_unshift( $this->feeAgreementFields['payee_options'], $payee[0], $payee[1] );
            }

            // Populate Relative Informations
            $this->familyQuestionaireFields['family_list'] = isset( $enrollmentApplication->getRelativeInformations ) ? $enrollmentApplication->getRelativeInformations->toArray() : $this->familyQuestionaireFields['family_list'];

            // Populate Family Questionaire
            $this->familyQuestionaireFields =  isset( $enrollmentApplication->getFamilyQuestionaire ) ? array_merge( $this->familyQuestionaireFields , $enrollmentApplication->getFamilyQuestionaire->toArray() ) : $this->familyQuestionaireFields;

            // Populate Parent Handbook
            $this->parentHandbook = isset( $enrollmentApplication->getParentSignedHandbook ) ? array_merge($this->parentHandbook , $enrollmentApplication->getParentSignedHandbook->toArray() ) : $this->parentHandbook;

            // Populate Required Documents
            if ( Storage::disk($this->disk)->has('users/A'.auth()->user()->id.'/healthAssessmentFile-'.$this->child_id) ) {
                $this->requiredDocuments[0]['file'] = Storage::disk($this->disk)->allFiles('users/A'.auth()->user()->id.'/healthAssessmentFile-'.$this->child_id)[0];
                $this->requiredDocuments[0]['date_uploaded'] = Carbon::parse( Storage::disk($this->disk)->lastModified(  $this->requiredDocuments[0]['file'] ) )->format('Y-m-d');
            }

            // Populate Fee Agreement File
            $this->feeAgreementFile =  Storage::disk($this->disk)->allFiles('users/A'.auth()->user()->id.'/children_fee_agreement-'.$this->child_id);
            // Photograph Permission Slip
            foreach ($enrollmentApplication->getPhotographPermission as $key => $value) {
                $this->photographPermissionSlipQuestions[$value['question_index']] = $value['question_answer'];
            }

            // Populate Child Immunization
            foreach ($enrollmentApplication->getImmunization as $key => $value) {
                $this->immunizationFields[$value['immunization_index']]['dosages'][$key]['date'] = $value['date'];
                $this->selectedImmunizationFields['selected_immunization_dosage'] = $value['selected_immunization_dosage'];
                $this->selectedImmunizationFields['immunization_index'] = $value['immunization_index'];
            }

            return [
                'childrenFields' => $this->childrenFields,
                'primaryGuardianFields' => $this->primaryGuardianFields,
                'secondaryGuardianFields' => $this->secondaryGuardianFields,
                'authAdultFields'       => $this->authAdultFields,
                'emergencyContactFields' => $this->emergencyContactFields,
                'medicalInformation' => $this->medicalInformation,
                'permissionSlip'      =>$this->permissionSlip,
                'familyQuestionaireFields' => $this->familyQuestionaireFields,
                'parentHandbook'    => $this->parentHandbook,
                'requiredDocuments'    =>  $this->requiredDocuments,
                'photographPermissionSlipQuestions' => $this->photographPermissionSlipQuestions
            ];

        } else {
            return [
                'childrenFields' => $this->childrenFields,
                'primaryGuardianFields' => $this->primaryGuardianFields,
                'secondaryGuardianFields' => $this->secondaryGuardianFields,
                'authAdultFields'       => $this->authAdultFields,
                'emergencyContactFields' => $this->emergencyContactFields,
                'medicalInformation' => $this->medicalInformation,
                'permissionSlip'      =>$this->permissionSlip,
                'familyQuestionaireFields' => $this->familyQuestionaireFields,
                'parentHandbook'    => $this->parentHandbook,
                'requiredDocuments'    =>  $this->requiredDocuments
            ];
        }

    }

    public function validatePrimaryDuplicateWithSecondary ( $first_name, $last_name  )
    {
        if ( $first_name == $this->secondaryGuardianFields['first_name'] &&
            $last_name == $this->secondaryGuardianFields['last_name'] ) {
                $this->addError('secondaryGuardianFields.first_name', 'Invalid.');
                $this->addError('secondaryGuardianFields.last_name', 'Invalid.');
                $this->addError('primaryGuardianFields.first_name', 'Invalid.');
                $this->addError('primaryGuardianFields.last_name', 'Invalid.');
                $this->alert('warning', 'Primary Name and Secondary Name must not the same.');
                return true;
        }
    }

    public function validateSecondaryDuplicateWithPrimary ( $first_name, $last_name  )
    {
        if ( $first_name == $this->primaryGuardianFields['first_name'] &&
            $last_name == $this->primaryGuardianFields['last_name'] ) {
                $this->addError('secondaryGuardianFields.first_name', 'Invalid.');
                $this->addError('secondaryGuardianFields.last_name', 'Invalid.');
                $this->addError('primaryGuardianFields.first_name', 'Invalid.');
                $this->addError('primaryGuardianFields.last_name', 'Invalid.');
                $this->alert('warning', 'Primary Name and Secondary Name must not the same.');
                return true;
        }
    }

    public function validateAuthorizeAdultsDuplicateWithGuardian ( $guardianFirstName, $guardianLastName )
    {
        $primaryFirstName = $this->primaryGuardianFields['isPrimaryGuardian'] == 'yes' ? $guardianFirstName : $this->primaryGuardianFields['first_name'];
        $primaryLastName = $this->primaryGuardianFields['isPrimaryGuardian'] == 'yes' ? $guardianLastName : $this->primaryGuardianFields['last_name'];
        $secondaryFirstName = $this->secondaryGuardianFields['isSecondaryGuardian'] == 'yes' ? $guardianFirstName : $this->secondaryGuardianFields['first_name'];
        $secondaryLastName = $this->secondaryGuardianFields['isSecondaryGuardian'] == 'yes' ? $guardianLastName : $this->secondaryGuardianFields['last_name'];

        if ( $this->authAdultFields['first_name'] === $primaryFirstName && $this->authAdultFields['last_name'] === $primaryLastName ) {
            $this->alert('warning', 'Authorized Name must not be the same with Primary Guardian.');
            return true;
        } else if ( $this->authAdultFields['first_name'] === $secondaryFirstName && $this->authAdultFields['last_name'] === $secondaryLastName ) {
            $this->alert('warning', 'Authorized Name must not be the same with Secondary Guardian.');
            return true;
        }
    }

    public function softChildrenInformation ( $id )
    {
        ChildInformation::where('id', $id)->delete();
        ChildGuardian::where('child_id', $id)->delete();
        ChildAuthorizedAdults::where('child_id', $id)->delete();
    }

    public function getRegisteredChildren ( $queryString = null, $onlyTrashed, $list_of_child_info_to_update, $parentId )
    {

        $child_ids = [];

        if ( $list_of_child_info_to_update ) {
            $child_ids = array_map(function (array $arr) {
                                return $arr['id'];
                            }, $this->checkChildInformationIsUpdated() );
        }

        if ( $onlyTrashed ) {
            if ( count( $child_ids ) > 0 ) {
                 // this is for displaying all user if the user login is an admin
                if (auth()->user()->role == 'admin') {
                    $list = ChildInformation::with(['getChildGuardians', 'getChildAuthorizedAdults'])
                                        ->withTrashed()
                                        ->whereIn('id', $child_ids)
                                        ->get();
                } else {
                    $list = ChildInformation::with(['getChildGuardians', 'getChildAuthorizedAdults'])
                                        ->withTrashed()
                                        ->where( 'user_id', $parentId ?? auth()->user()->id )
                                        ->whereIn('id', $child_ids)
                                        ->get();
                }

            } else {
                // this is for displaying all user if the user login is an admin
                if (auth()->user()->role == 'admin') {
                    $list = $queryString ? ChildInformation::with(['getChildGuardians', 'getChildAuthorizedAdults'])
                                                        ->withTrashed()
                                                        ->where( 'first_name', 'like', '%'.$queryString.'%')
                                                        ->orWhere( 'last_name', 'like', '%'.$queryString.'%')
                                                        ->get():
                                        ChildInformation::with(['getChildGuardians', 'getChildAuthorizedAdults'])
                                                        ->withTrashed()
                                                        ->get();
                } else {

                    // Get Parent Listens
                    $parentDetails = null;
                    $emergencyContact = ChildrenEmergencyContact::where([
                        'first_name' =>  Auth()->user()->first_name,
                        'last_name' =>  Auth()->user()->last_name,
                    ])->first();

                    if ($emergencyContact) {
                        $parentDetails = $emergencyContact;
                    } else {
                        $fatherDetails = ChildrensFather::where([
                                            'first_name' =>  Auth()->user()->first_name,
                                            'last_name' =>  Auth()->user()->last_name,
                                        ])->first();

                        if ($fatherDetails) {
                            $parentDetails = $fatherDetails;
                        } else {
                            $parentDetails = ChildrensMother::where([
                                'first_name' =>  Auth()->user()->first_name,
                                'last_name' =>  Auth()->user()->last_name,
                            ])->first();
                        }
                    }


                    // Populate Child List
                    $list = $queryString ?
                                            ChildInformation::with(['getChildGuardians', 'getChildAuthorizedAdults'])
                                            ->withTrashed()
                                            ->where( 'first_name', 'like', '%'.$queryString.'%')
                                            ->when($parentDetails, fn($query) =>
                                                $query->where( 'id', $parentDetails->child_id )
                                            )
                                            ->when(!$parentDetails, fn($query) =>
                                                $query->where( 'user_id', Auth()->user()->id )
                                            )
                                            ->orWhere( 'last_name', 'like', '%'.$queryString.'%')
                                            ->get()
                                        :
                                            ChildInformation::with(['getChildGuardians', 'getChildAuthorizedAdults'])
                                            ->withTrashed()
                                            ->when($parentDetails, fn($query) =>
                                                $query->where('id', $parentDetails->child_id)
                                            )
                                            ->when(!$parentDetails, fn($query) =>
                                                $query->where('user_id', Auth()->user()->id)
                                            )
                                            ->get();
                }

            }


            foreach ($list as $key => $value) {
                $list[ $key ]['primaryGuardian'] = count( array_filter($value->getChildGuardians->toArray(), function ( $item ) { return $item['primary_guardian'] == 1; }) ) > 0 ?
                                            array_values( array_filter($value->getChildGuardians->toArray(), function ( $item ) { return $item['primary_guardian'] == 1; }) )[0] :
                                            $this->primaryGuardianFields;
            }

            return [
                'registeredChildrenList' => count(  $list ) > 0 ? $list->toArray(): []
            ];
        } else {
            if ( count( $child_ids ) > 0 ) {
                // this is for displaying all user if the user login is an admin
                if (auth()->user()->role == 'admin') {
                    $list = ChildInformation::with(['getChildGuardians', 'getChildAuthorizedAdults'])
                                            ->whereIn('id', $child_ids)
                                            ->get();
                } else {
                    $list = ChildInformation::with(['getChildGuardians', 'getChildAuthorizedAdults'])
                                        ->where( 'user_id', $parentId ?? auth()->user()->id )
                                        ->whereIn('id', $child_ids)
                                        ->get();
                }

            } else {
                // this is for displaying all user if the user login is an admin
                if (auth()->user()->role == 'admin') {
                    $list = $queryString ? ChildInformation::with(['getChildGuardians', 'getChildAuthorizedAdults'])
                                            ->where( 'first_name', 'like', '%'.$queryString.'%')
                                            ->orWhere( 'last_name', 'like', '%'.$queryString.'%')
                                            ->get() :
                                            ChildInformation::with(['getChildGuardians', 'getChildAuthorizedAdults'])->get();
                } else {
                    // Get Parent Listens
                    $parentDetails = null;
                    $emergencyContact = ChildrenEmergencyContact::where([
                        'first_name' =>  Auth()->user()->first_name,
                        'last_name' =>  Auth()->user()->last_name,
                    ])->first();

                    if ($emergencyContact) {
                        $parentDetails = $emergencyContact;
                    } else {
                        $fatherDetails = ChildrensFather::where([
                                            'first_name' =>  Auth()->user()->first_name,
                                            'last_name' =>  Auth()->user()->last_name,
                                        ])->first();

                        if ($fatherDetails) {
                            $parentDetails = $fatherDetails;
                        } else {
                            $parentDetails = ChildrensMother::where([
                                'first_name' =>  Auth()->user()->first_name,
                                'last_name' =>  Auth()->user()->last_name,
                            ])->first();
                        }
                    }

                    // Populate Child List
                    $list = $queryString ?
                                            ChildInformation::with(['getChildGuardians', 'getChildAuthorizedAdults'])
                                            ->where( 'first_name', 'like', '%'.$queryString.'%')
                                            ->when($parentDetails, fn($query) =>
                                                $query->where( 'id', $parentDetails->child_id )
                                            )
                                            ->when(!$parentDetails, fn($query) =>
                                                $query->where( 'user_id', Auth()->user()->id )
                                            )
                                            ->orWhere( 'last_name', 'like', '%'.$queryString.'%')
                                            ->get()
                                        :
                                            ChildInformation::with(['getChildGuardians', 'getChildAuthorizedAdults'])
                                            ->when($parentDetails, fn($query) =>
                                                $query->where('id', $parentDetails->child_id)
                                            )
                                            ->when(!$parentDetails, fn($query) =>
                                                $query->where('user_id', Auth()->user()->id)
                                            )
                                            ->get();
                }

            }

            foreach ($list as $key => $value) {
                $list[ $key ]['primaryGuardian'] = count ( array_filter($value->getChildGuardians->toArray(), function ( $item ) { return $item['primary_guardian'] == 1; }) ) > 0?
                                            array_values(array_filter($value->getChildGuardians->toArray(), function ( $item ) { return $item['primary_guardian'] == 1; }))[0] :
                                            $this->primaryGuardianFields;
            }

            return [
                'registeredChildrenList' => count(  $list ) > 0 ? $list->toArray(): []
            ];
        }

    }

    public function populateEmergencyContact ( $child_id )
    {
        // Delete
        ChildrenEmergencyContact::where('child_id', $child_id )
                             ->delete( );
        // Create
        foreach ($this->emergencyContactFields['list_of_emergency_contact_registered'] as $key => $items) {
        ChildrenEmergencyContact::create( $items );
        }

        if (count($this->emergencyContactFields['list_of_emergency_contact_registered']) > 0) {
            $this->alert('success','Successfully Updated Emergency Contact.');
        }

        // Update Child Steps Done
        if ( $this->childrenFields['completed_registration_steps'] < 1 )
        ChildInformation::find( $child_id )->update( [ 'completed_registration_steps' => 1 ] );

        // Re-populate Steps Fields
        $this->getChildStepsInformation( $child_id );

        return true;

    }

    public function populateMedicalInformation ( $child_id )
    {

        $medicalInfo = [
            'child_id'                          => $child_id,
            'physician_name'                    => $this->medicalInformation['physician_name'],
            'physician_number'                  => $this->medicalInformation['physician_number'],
            'physician_address'                 => $this->medicalInformation['physician_address'],
            'physician_city'                    => $this->medicalInformation['physician_city'],
            'physician_state'                   => $this->medicalInformation['physician_state'],
            'physician_zip'                     => $this->medicalInformation['physician_zip'],
            'child_held_insurance_provider'     => $this->medicalInformation['child_held_insurance_provider'],
            'insurance_policy_number'           => $this->medicalInformation['insurance_policy_number'],
            'allergies'                         => $this->medicalInformation['allergies'],
            'prescribe_medication'              => $this->medicalInformation['prescribe_medication'],
            'special_needs'                     => $this->medicalInformation['special_needs'],
            'suffer_from'                       => $this->medicalInformation['suffer_from'] ? join(',', $this->medicalInformation['suffer_from']): null,
        ];

        $id = $this->medicalInformation['id'] ?
                    ChildrenMedicalInformation::where('child_id', $child_id)->update( $medicalInfo ):
                    ChildrenMedicalInformation::create( $medicalInfo )->id;

        $this->medicalInformation['id'] = $id ? $id : $this->medicalInformation['id'];

        session()->flash('success',$this->medicalInformation['id'] ? 'Successfully updated.': 'Successfully saved.');

         // Re-populate Steps Fields
         return $this->getChildStepsInformation( $child_id );
    }

    public function populatePermissionSlips ( $child_id )
    {

        $permissionSlips = [
            'child_id'  =>  $child_id,
            'allow_put_sunscreen' => $this->permissionSlip['allow_put_sunscreen'],
            'allow_use_hand_sanitizer' => $this->permissionSlip['allow_use_hand_sanitizer'],
            'allow_apply_diaper_cream' => $this->permissionSlip['allow_apply_diaper_cream'],
        ];

        $id = $this->permissionSlip['id'] ? ChildrenPermissionSlips::where( 'child_id', $child_id )->update( $permissionSlips ) :
                                        ChildrenPermissionSlips::create( $permissionSlips )->id;

        session()->flash('success', $this->permissionSlip['id'] ? 'Permission information has been updated.': 'Permission information has been saved.');

        self::populatePhotographPermission($child_id);

         // Re-populate Steps Fields
         $this->getChildStepsInformation( $child_id );

        return true;

    }

    public function populateFamilyQuestionaire ( $child_id )
    {
        /* Populate first the Family Questionaire */
        $familyQuestionaireInfo = [
            'nickname'  => $this->familyQuestionaireFields['nickname'] ?? null,
            'cultural_bg' => $this->familyQuestionaireFields['cultural_bg'],
            'language' => $this->familyQuestionaireFields['language'],
            'family_celebrate_occasions' => $this->familyQuestionaireFields['family_celebrate_occasions'] ?? null,
            'daycare_bg' => $this->familyQuestionaireFields['daycare_bg'] ?? null,
            'daycare_bg_name' => $this->familyQuestionaireFields['daycare_bg_name'] ?? null,
            'daycare_bg_phone_number' => $this->familyQuestionaireFields['daycare_bg_phone_number'] ?? null,
            'daycare_bg_address' => $this->familyQuestionaireFields['daycare_bg_address'] ?? null,
            'daycare_bg_start_date' => Carbon::parse(  $this->familyQuestionaireFields['daycare_bg_start_date']  )->format('Y-m-d') ?? null,
            'daycare_bg_end_date' => Carbon::parse(  $this->familyQuestionaireFields['daycare_bg_end_date']  )->format('Y-m-d') ?? null,
            'daycare_bg_reason_termination' => $this->familyQuestionaireFields['daycare_bg_reason_termination'] ?? null,
            'daycare_bg_contact_reference' => $this->familyQuestionaireFields['daycare_bg_contact_reference'] ?? null,
            'eating_habits' => $this->familyQuestionaireFields['eating_habits'] ?? null,
            'child_drink' => $this->familyQuestionaireFields['child_drink'] ?? null,
            'special_diet' => $this->familyQuestionaireFields['special_diet'] ?? null,
            'child_food_refrain' => $this->familyQuestionaireFields['child_food_refrain'] ?? null,
            'hours_of_sleep' => $this->familyQuestionaireFields['hours_of_sleep'] ?? null,
            'bed_time' => $this->familyQuestionaireFields['bed_time'] ?? null,
            'nap_days' => $this->familyQuestionaireFields['nap_days'] ?? null,
            'child_id' => $child_id
        ];

        if ($this->familyQuestionaireFields['id']) {
            ChildFamilyQuestionaire::where( 'child_id', $child_id)->update( $familyQuestionaireInfo );
        } else {
            $this->familyQuestionaireFields['id'] = ChildFamilyQuestionaire::create( $familyQuestionaireInfo )->id;
        }

        session()->flash('success', $this->familyQuestionaireFields['id'] ? 'Successfully updated.': 'Successfully saved.');

        // Re-populate Steps Fields
        $this->getChildStepsInformation( $child_id );

        return true;
    }

    public function populateSignedParentHandbook ( $child_id )
    {
        $parentHandbook = [
            'child_id' => $child_id,
            'signed_date' => Carbon::now()
        ];

        ChildParentHandbook::where( 'child_id', $child_id)->delete();
        ChildParentHandbook::create( $parentHandbook );

        // Update Child Steps Done
        if ( $this->childrenFields['completed_registration_steps'] < 4 )
            ChildInformation::find( $child_id )->update( [ 'completed_registration_steps' => 4 ] );

        // Re-populate Steps Fields
            $this->getChildStepsInformation( $child_id );
    }

    public function checkChildInformationIsUpdated () {
        // This will only be called every 6 months. This will get all those child information that needed to update after 6 month upon creation.
        $childDetails = ChildInformation::where( 'user_id', auth()->user()->id )->get();
        $childInformatioToUpdate = [];

        if ( $childDetails ) {
            foreach ($childDetails->toArray() as $key => $child) {
                $dateDiff = Carbon::parse( $child['updated_at'] )->diffInMonths( Carbon::now() );

                if ( $dateDiff >= 6 ) {
                    array_push($childInformatioToUpdate, $child);
                }
            }
        }

       return $childInformatioToUpdate;


    }

    public function updatetUserID ( ) {
        ChildInformation::find( $this->childrenFields['id'] )->update( [ 'user_id' => auth()->user()->id ] );
    }

    public function populatePhotographPermission ($child_id)
    {
        // Delete Child Previous Record
        ChildrenPhotographPermissionSlip::where('child_id', $child_id)->delete();

        // Create New Record
        foreach ($this->photographPermissionSlipQuestions as $key => $value) {
            $photographPermissionSlip = array(
                'child_id' => $child_id,
                'question_index' => $key,
                'question_answer' => $value
            );

            ChildrenPhotographPermissionSlip::create( $photographPermissionSlip );
        }
    }

    public function populateImmunization ($child_id)
    {
        foreach ($this->immunizationFields[$this->selectedImmunizationFields['immunization_index']]['dosages'] as $key => $immnunization) {
            if ($immnunization['date']) {
               $immunizationRecord = [
                  'immunization_index' => $this->selectedImmunizationFields['immunization_index'],
                  'selected_immunization_dosage' => $this->selectedImmunizationFields['selected_immunization_dosage'],
                  'date' => Carbon::parse($immnunization['date'])->format('Y-m-d'),
                  'child_id' => $child_id
               ];

               // Delete old records that
               ChildImmunizationInformations::where([
                  'immunization_index' => $this->selectedImmunizationFields['immunization_index'],
                  'selected_immunization_dosage' => $this->selectedImmunizationFields['selected_immunization_dosage'],
                  'child_id' => $child_id
               ])->delete();
               // Create Immunization Record
               ChildImmunizationInformations::create($immunizationRecord);
            }
         }

        self::getChildStepsInformation($child_id);

        $this->flash('success', 'Successfully Updated Child Immunization Record.');
        return true;
    }

    public function populateChildrenParents ($child_id)
    {
         // Create or Update
         $mothersInfo = [
            'first_name' => $this->childs_mother['first_name'],
            'last_name' => $this->childs_mother['last_name'],
            'email' => $this->childs_mother['email'],
            'phone' => $this->childs_mother['phone'],
            'phone_type' => $this->childs_mother['phone_type'],
            'home_address' => $this->childs_mother['home_address'],
            'home_city' => $this->childs_mother['home_city'],
            'home_state' => $this->childs_mother['home_state'],
            'home_zip' => $this->childs_mother['home_zip'],
            'businesss_employer' => $this->childs_mother['businesss_employer'],
            'work_phone' => $this->childs_mother['work_phone'],
            'work_address' => $this->childs_mother['work_address'],
            'work_city' => $this->childs_mother['work_city'],
            'work_state' => $this->childs_mother['work_state'],
            'work_zip' => $this->childs_mother['work_zip'],
            'primary_guardian' => $this->childs_mother['primary_guardian'] ?? false,
            'secondary_guardian' => $this->childs_mother['secondary_guardian'] ?? false,
            'sameAsChildAddress' => $this->childs_mother['sameAsChildAddress'] ?? false,
            'child_id' => $child_id
         ];
         ChildrensMother::updateOrCreate([
            'id' => $this->childs_mother['id']
        ],$mothersInfo );

         // Create or Update
         $fathersInfo = [
            'first_name' => $this->childs_father['first_name'],
            'last_name' => $this->childs_father['last_name'],
            'email' => $this->childs_father['email'],
            'phone' => $this->childs_father['phone'],
            'phone_type' => $this->childs_father['phone_type'],
            'home_address' => $this->childs_father['home_address'],
            'home_city' => $this->childs_father['home_city'],
            'home_state' => $this->childs_father['home_state'],
            'home_zip' => $this->childs_father['home_zip'],
            'businesss_employer' => $this->childs_father['businesss_employer'],
            'work_phone' => $this->childs_father['work_phone'],
            'work_address' => $this->childs_father['work_address'],
            'work_city' => $this->childs_father['work_city'],
            'work_state' => $this->childs_father['work_state'],
            'work_zip' => $this->childs_father['work_zip'],
            'primary_guardian' => $this->childs_father['primary_guardian'] ?? false,
            'secondary_guardian' => $this->childs_father['secondary_guardian'] ?? false,
            'sameAsChildAddress' => $this->childs_father['sameAsChildAddress'] ?? false,
            'child_id' => $child_id
         ];

         ChildrensFather::updateOrCreate([
            'id' => $this->childs_father['id']
        ],$fathersInfo );

    }

    public function createUserForParent ()
    {

        // Populate Parent Fields
        $Primaryparent = $this->childs_mother['primary_guardian'] ? $this->childs_mother :  $this->childs_father;


        if (is_null($Primaryparent['first_name']) || is_null($Primaryparent['last_name'])) {
            $this->alert('warning', "Primary Guardian's Name required.");
            return false;
        }

         $parent = [
            'first_name' => $Primaryparent['first_name'],
            'last_name' => $Primaryparent['last_name'],
            'email_address' => $Primaryparent['email'],
            'phone_number_1' => $Primaryparent['phone'],
            'phone_type_1' => $Primaryparent['phone_type'],
            'phone_number_2' => null,
            'phone_type_2' => null,
            'profile_type' => 0,
            'password' => Hash::make('Primaryparent123'),
            'address' => $Primaryparent['home_address'],
            'city' => $Primaryparent['home_city'],
            'state' => $Primaryparent['home_state'],
            'zip' => $Primaryparent['home_zip'],
            'id' => null,
         ];

        // Duplicate Checker
        $parentExist = ParentFormData::where('first_name', $parent['first_name'])
                                        ->where('last_name', $parent['last_name'])
                                        ->first();
        $userExistence = User::where('first_name', $parent['first_name'])
                            ->where('last_name', $parent['last_name'])
                            ->first();

        if ( $userExistence || $parentExist ) {
            return $userExistence->id;
        }

        // Check Email already Exists
        $parentFormEmailExistence = ParentFormData::where('email_address', $parent['email_address'])->first();
        $UserEmailExistence = User::where('email', $parent['email_address'])->first();

        if (  $parentFormEmailExistence || $UserEmailExistence  ) {
              $this->alert('warning', "Primary Guardian's email already exist.");
            return false;
        }

        // If required fields were all validated; Save to the DB

        // Create User Access
        $userAccessDetails = [
            'first_name' => $parent['first_name'],
            'last_name' => $parent['last_name'],
            'email' => $parent['email_address'],
            'email_verified_at' => now(),
            'role' => Role::PARENT
        ];

        $user_id = User::create( $userAccessDetails )->id;

        // Create Parent Details
        $parentData = [
            'first_name' => $parent['first_name'],
            'last_name' => $parent['last_name'],
            'phone_number_1' => $parent['phone_number_1'],
            'phone_type_1' => $parent['phone_type_1'],
            'phone_number_2' => $parent['phone_number_2'],
            'phone_type_2' => $parent['phone_type_2'],
            'email_address' => $parent['email_address'],
            'profile_type' => $parent['profile_type'],
            'user_id'       => $user_id
        ];

        $parent['id'] =  ParentFormData::create( $parentData )->id;

        // Push Email important keys
        $parentData['subject'] = 'Password Creation';
        $parentData['template'] = 'vendor.mail.html.parentcreatepasswordtemplate';

        $this->sendEmail( $parentData, $user_id );

        return $user_id;
    }

    public function sendEmail( $emailTemplateData, $id )
    {

        $emailData =  [
            'content'   => $emailTemplateData['template'],
            'subject'   => $emailTemplateData['subject'],
            'to'        => $emailTemplateData['email_address']
        ];

        $emailTemplateData['link'] = env('APP_URL'). $id.'/parent-password';

        Mail::send( $emailData['content'], $emailTemplateData ,function ( $message ) use ( $emailData ) {
            $message->to( $emailData['to'],  $emailData['subject'] )
                    ->subject( $emailData['subject'] );
        });
    }

    public function createEmergencyContact ($child_id)
    {
        /****************For Emeregency Contact Persons********************/
        $emergencyContactPersons = [];
        $noOfBlankRecordECP = 0;
        foreach ($this->newEmergencyContactFields['list_of_emergency_contact_registered'] as $key => $contanctPerson) {
            if($contanctPerson['selected_emergency_contact'] == -1 &&  $contanctPerson['first_name']
                &&  $contanctPerson['last_name'] &&  $contanctPerson['phone_number']) {
                array_push($emergencyContactPersons, [
                    'selected_emergency_contact' => $contanctPerson['selected_emergency_contact'],
                    'first_name' => $contanctPerson['first_name'],
                    'last_name'  => $contanctPerson['last_name'],
                    'phone_number' => $contanctPerson['phone_number'],
                    'phone_number_type' => $contanctPerson['phone_number_type'],
                    'child_id' => $child_id,
                ]);
            } else{
                if ($contanctPerson['selected_emergency_contact']) {
                    array_push($emergencyContactPersons, [
                        'selected_emergency_contact' => $contanctPerson['selected_emergency_contact'],
                        'first_name' => null,
                        'last_name'  => null,
                        'phone_number' => null,
                        'phone_number_type' => null,
                        'child_id' => $child_id,
                    ]);
                } else {
                    array_push($emergencyContactPersons, [
                        'selected_emergency_contact' => 0,
                        'first_name' => null,
                        'last_name'  => null,
                        'phone_number' => null,
                        'phone_number_type' => null,
                        'child_id' => $child_id,
                    ]);
                    $noOfBlankRecordECP += 1;
                }
            }
        }

        if ($noOfBlankRecordECP == count($emergencyContactPersons)) {
            $this->alert('warning', "There must be atleast one(1) Emergency Contact Person.");
            return false;
        } else {
            // Delete
            ChildEmergencyContactPersons::where('child_id', $child_id)->delete();
            // Create
            ChildEmergencyContactPersons::insert($emergencyContactPersons);
        }

        /****************For Authorized Pickup Person********************/
        $authorizedPersons = [];
        $noOfBlankRecordAPP = 0;
        foreach ($this->newEmergencyContactFields['list_of_authorized'] as $key => $authPerson) {
            if($authPerson['selected_emergency_contact'] == -1 &&  $authPerson['first_name']
                &&  $authPerson['last_name'] &&  $authPerson['phone_number']) {
                array_push($authorizedPersons, [
                    'selected_emergency_contact' => $authPerson['selected_emergency_contact'],
                    'first_name' => $authPerson['first_name'],
                    'last_name'  => $authPerson['last_name'],
                    'phone_number' => $authPerson['phone_number'],
                    'phone_number_type' => $authPerson['phone_number_type'],
                    'child_id' => $child_id,
                ]);
            } else{
                if ($authPerson['selected_emergency_contact']) {
                    array_push($authorizedPersons, [
                        'selected_emergency_contact' => $authPerson['selected_emergency_contact'],
                        'first_name' => null,
                        'last_name'  => null,
                        'phone_number' => null,
                        'phone_number_type' => null,
                        'child_id' => $child_id,
                    ]);
                } else {
                    array_push($authorizedPersons, [
                        'selected_emergency_contact' => 0,
                        'first_name' => null,
                        'last_name'  => null,
                        'phone_number' => null,
                        'phone_number_type' => null,
                        'child_id' => $child_id,
                    ]);
                    $noOfBlankRecordAPP += 1;
                }
            }
        }

        if ($noOfBlankRecordAPP == count($authorizedPersons)) {
            $this->alert('warning', "There must be atleast one(1) Authorized Pickup Person.");
            return false;
        } else {
            // Delete
            ChildAuthorizedPersons::where('child_id', $child_id)->delete();
            // Create
            ChildAuthorizedPersons::insert($authorizedPersons);
        }

        $this->alert('success', "Successfully added Emergency Contact Person(s) and Authorized Pickup Person(s).");

        self::getChildStepsInformation($child_id);

        return true;
    }

    public function setChildrenActive ($child_id)
    {
        return ChildInformation::find($child_id)->update(['status' => 1]);
    }
}
