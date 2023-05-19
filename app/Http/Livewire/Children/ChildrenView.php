<?php

namespace App\Http\Livewire\Children;

use Livewire\{
    Component,
    WithFileUploads
};

use App\Traits\Fields\{
    ChilldrenFields,
    FileManagerFields
};

use App\Traits\{
    ChildrenViewData,
    DocuSign,
    ImmunizationData,
    FileManagerData
};

use Illuminate\Support\Carbon;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

use Illuminate\Support\Facades\{
    Storage,
    Auth,
    Mail,
    Validator
};

use \Illuminate\Session\SessionManager;

use Jenssegers\Agent\Agent;

use App\Models\{
    User,
    ChildInformation,
    ChildrensFather,
    ChildrensMother,
    ChildParentHandbook,
    FrequencyChildProfile
};

use PDF;

use Response;

class ChildrenView extends Component
{
    use WithFileUploads, AuthorizesRequests;
    use ChilldrenFields, ChildrenViewData;
    use DocuSign, ImmunizationData;
    use FileManagerData, FileManagerFields;

    public $user;
    public $sameAsChildAddress = false;
    public $sameAsChildAddressSecondary = false;
    public $guardianFirstName;
    public $guardianLastName;
    public $guardianEmail;
    public $authEdited = false;
    public $authEditedIndex = null;
    public $query_string_child_id;
    public $child_id;
    public $allowAdditionalEmergencyContact = false;
    public $multiple = true;
    public $selected = [];
    public $selectedValues = [];
    public $disableParentHandbookAcceptBtn = false;
    public $parentHandBookSigned = false;
    public $displayHandbookModal = false;
    public $parentHandbookPdfPath;
    public $confirmHandbookModal = false;
    public $removeStepText = false;
    public $feeAgreementFile;
    public $fileUploaderRedirectRoute;
    public $healthAssessmentFile;
    public $immunizationFile;
    public $healthAssessmentFileDateUploaded;
    public $immunizationFileDateUploaded;
    public $parentHandBookTempUrl;
    public $latestHandBook;
    public $desktopDevice;
    public $loading=true;
    public $enrollmentStep = 0;
    public $cancelPrimaryDetails = "no";
    public $cancelSecondaryDetails = "no";
    public $requestFeeAgreement = false;
    public $emergencyContactPopulated = false;
    public $createEmergencyContact = false;
    public $editImmunization = false;
    public $documentSigned =false;
    public $displayDocuSign = false;
    public $motherSameAsChildAddress = false;
    public $fatherSameAsChildAddress = false;
    public $query_string_first_name;
    public $query_string_last_name;
    public $first_name = '';
    public $last_name = '';
    public $childName = '';
    public $HealthAssesmentFileCnt = 0;
    public $feeAgreementFileCnt = 0;
    public $goToForm = '';
    public $childInfoCompleted = false;
    public $childInfoLastModifiedDate = '';
    public $childMedicalInfoCompleted = false;
    public $childMedicalInfoLastModifiedDate = '';
    public $childFamilyQuestionaierModifiedDate = '';
    public $childChildQuestoinaerCompleted = false;
    public $childEmergencyContactModifiedDate = '';
    public $childEmergencyContactCompleted = false;
    public $childPermissionCompleted = false;
    public $childPermissionDateModified = '';
    public $emergencyContactFormDownloadLink = 'https://drive.google.com/file/d/1E1kc2IDFvD6RfpdBtEiKbi-m0UeeB2dv/view?usp=sharing';
    public $childParentHandBookCreated = false;
    public $childParentHandBookModifiedDate = '';
    public $emergencyContacForm;
    public $fileUploaderRedirectRouteEmergencyContact = '';
    public $childAssesmentCompleted = false;
    public $healtAssementFile = 'assesment_form/CD 51_Child Health Report.pdf';
    public $healthAssesmentDateUploadedFile = '';
    public $immunizationCompleted = false;
    public $immunizationLastModified = '';
    public $childFeeAgreementCompleted = false;
    public $childFeeAgreementLastModified = '';
    public $childLastestFeeAgreementFile = '';
    public $displayNotifyParentModal = false;
    public $parentEmails = '';
    public $hasParentInfo = false;
    public $parentHandbookFile;
    public $childHealthAssessmentFile;
    public $emergencyContactDateReviewed;
    public $healthAssessmentDateReviewed;
    public $feeAgreementDateReviewed;
    public $status = '';
    public $emergencyContactExpirationDate;

    public $directory = 'children_permision_slips';
    protected $disk = 'spaces';

    public $file;
    public $uploads = [];

    protected $queryString = [
        'directory',
        'child_id',
        'user',
        'first_name',
        'last_name'
    ];

    protected $listeners = [
        'delete',
        'resetFile'
    ];

    public function mount (SessionManager $session)
    {
        // Get Chilid Data and Validate Important fields to verify if all required fields
        $this->child_id = $this->child_id ?? $this->childrenFields['id'];

        $this->getChildStepsInformation($this->child_id ?? $this->childrenFields['id']);

        if ($this->first_name && $this->last_name) {
            $this->childName = $this->first_name.' '.$this->last_name;
            $this->childrenFields['first_name'] = $this->first_name;
            $this->childrenFields['last_name'] = $this->last_name;
        } else {
            $this->childName = $this->childrenFields['first_name'].' '.$this->childrenFields['last_name'];
        }

        $childInformation = ChildInformation::find($this->child_id ?? $this->childrenFields['id']);

        $this->caculateAge();

        $this->validateChildInfoRequiredFields();

        if (isset($this->medicalInformation['updated_at'])) {
            $this->childMedicalInfoCompleted = true;
            $this->childMedicalInfoLastModifiedDate = Carbon::parse($this->medicalInformation['updated_at'])->format('F d, Y');
        }

        if (isset($this->permissionSlip['updated_at'])) {
            $this->childPermissionCompleted = true;
            $this->childPermissionDateModified = Carbon::parse($this->permissionSlip['updated_at'])->format('F d, Y');
        }

        $this->fileUploaderRedirectRoute = '/children/'.auth()->user()->id;

        $this->fileUploaderRedirectRouteEmergencyContact = '/children/'.auth()->user()->id.'/child-edit?child_id='.$this->child_id;

        // Create Temporary URL for Parent Handbook
        $this->latestHandBook = Storage::disk($this->disk)->allFiles('handbook')[ count( Storage::disk($this->disk)->allFiles('handbook') ) - 1 ];

        $latestHandbookDateUploadTimStamp = Carbon::parse( Storage::disk($this->disk)->lastModified( $this->latestHandBook ) )->settings([
            'toJsonFormat' => function ($date) {
                return $date->getTimestamp();
            },
        ]);

        if ($this->parentHandbook['signed_date']) {
            $this->childParentHandBookModifiedDate = Carbon::parse($this->parentHandbook['signed_date'])->format('F d, Y');
        }

        if (isset($this->familyQuestionaireFields['updated_at'])) {
            $this->childChildQuestoinaerCompleted = true;
            $this->childFamilyQuestionaierModifiedDate = Carbon::parse($this->familyQuestionaireFields['updated_at'])->format('F d, Y');
        }

        $this->user = User::find($this->user);

        if ($this->user->hasMedia(slug('Assement Form'.'-'.$this->child_id, '_'))) {
            $this->healthAssesmentDateUploadedFile = Carbon::parse($this->user->getMedia(slug('Assement Form'.'-'.$this->child_id, '_'))[0]['updated_at'])->format('F d, Y');
        }

        if ($this->user->hasMedia(slug('Emergency Contact Parental Consent Form'.'-'.$this->child_id, '_'))) {
            $this->childEmergencyContactModifiedDate = Carbon::parse($this->user->getMedia(slug('Emergency Contact Parental Consent Form'.'-'.$this->child_id, '_'))[0]['updated_at'])->format('F d, Y');
        }

        $this->getImmunizationData();

        if ($childInformation && $childInformation->getMeta('Child_immunization_record_date')) {
            $this->immunizationCompleted = true;
            $this->immunizationLastModified = $childInformation->getMeta('Child_immunization_record_date');
        }

        // Create Temporary URL for fee agreement data
        $feeAgreementLatestFileDirectory = 'users/'.strtoupper(substr($this->user->role, 0, 1)).$this->user->id.'/child_fee_agreement/child_fee_agreement_'.$this->child_id;
        $this->childLastestFeeAgreementFile =  Storage::disk($this->disk)->allFiles($feeAgreementLatestFileDirectory) ? Storage::disk($this->disk)->allFiles($feeAgreementLatestFileDirectory)[count(Storage::disk($this->disk)->allFiles($feeAgreementLatestFileDirectory)) - 1]: '';

        if ($this->user->hasMedia(slug('Signed Child Fee Agreement'.'-'.$this->child_id, '_'))) {
            $this->childFeeAgreementLastModified = Carbon::parse($this->user->getMedia(slug('Signed Child Fee Agreement'.'-'.$this->child_id, '_'))[0]['updated_at'])->format('F d, Y');
            $this->childFeeAgreementCompleted = true;
        }

       $this->NotifyParentEditor();

        if ($this->childInfoCompleted && $this->childMedicalInfoCompleted
        && $this->childChildQuestoinaerCompleted && $this->childEmergencyContactCompleted
        && $this->childPermissionCompleted && $this->childParentHandBookCreated
        && $this->childAssesmentCompleted && $this->immunizationCompleted
        && $this->childFeeAgreementCompleted) {
            $childInfo = ChildInformation::where('id', $this->child_id)->first();
            ChildInformation::where('id', $this->child_id)->update(['completed_registration_steps' => 9]);
        }

        $this->checkChildStepsCompletion();

        $fileFrequencies = FrequencyChildProfile::get();

         // Emergency Contact File
         $this->uploadFields['doc_owner_ident'] = 2;
         $this->uploadFields['doc_type'] = 'Emergency Contact Form';
         $emergencyContactFile =  $this->getFilemanagerDefaultFile();
         $this->disk = 'spaces';

         if (count($emergencyContactFile->uploadedDocuments) > 0) {
            $environment = strtoupper(env('APP_ENV'));
            $documents_folder_name = strtoupper($this->uploadFields['doc_type']);
            $this->emergencyContacForm = "FILE MANAGER/{$environment}/{$documents_folder_name}/{$emergencyContactFile->uploadedDocuments[0]->doc_file_title}";
         }

        $emergencyContactFormFrequency = $fileFrequencies->filter(function($frequency) {
            return $frequency->doc_type == 'Emergency Contact Form';
         });

        $emergencyContactFileToReset = $this->checkForResetFile();

        if (count($emergencyContactFileToReset->uploadedDocuments) > 0 &&
            $emergencyContactFileToReset->uploadedDocuments[0]['reset_file'] &&
            Carbon::parse($emergencyContactFileToReset->uploadedDocuments[0]['updated_at'])->gte(Carbon::parse($childInformation->getMeta('emergencyContactDateReviewed')))) {
            $childInformation->removeMeta('emergencyContactDateReviewed');
        } else {
            $this->emergencyContactDateReviewed = Carbon::parse($childInformation->getMeta('emergencyContactDateReviewed'))->format('m/d/Y');
            $this->emergencyContactExpirationDate = self::getFileExpirationDate($emergencyContactFormFrequency[0]['frequency'], $this->emergencyContactDateReviewed)->format('F d, Y');
        }

         // Parent Handbook File
         $this->uploadFields['doc_owner_ident'] = 2;
         $this->uploadFields['doc_type'] = 'Parent Handbook';
         $parentHandbookFile =  $this->getFilemanagerDefaultFile();
         $this->disk = 'spaces';

         if (count($parentHandbookFile->uploadedDocuments) > 0) {
            $environment = strtoupper(env('APP_ENV'));
            $documents_folder_name = strtoupper($this->uploadFields['doc_type']);
            $this->parentHandbookFile = "FILE MANAGER/{$environment}/{$documents_folder_name}/{$parentHandbookFile->uploadedDocuments[0]->doc_file_title}";

            $this->parentHandBookTempUrl = Storage::disk($this->disk)->temporaryUrl( $this->parentHandbookFile , now()->addMinutes(30) );
         }

        $parentHandbookFileToReset = $this->checkForResetFile();

        if (count($parentHandbookFileToReset->uploadedDocuments) > 0 &&
            $parentHandbookFileToReset->uploadedDocuments[0]['reset_file'] &&
            Carbon::parse($parentHandbookFileToReset->uploadedDocuments[0]['updated_at'])->gte(Carbon::parse($childInformation->getMeta('child_hanbook_signed_date')))) {
            $childInformation->removeMeta('child_hanbook_signed_date');
            $this->parentHandbook['signed_date'] = null;
        } else {
            $this->parentHandbook['signed_date'] = $childInformation->getMeta('child_hanbook_signed_date');
        }

         // Health/Child Assesment File
         $this->uploadFields['doc_owner_ident'] = 2;
         $this->uploadFields['doc_type'] = 'Child health assessment';
         $childHealthAssessment =  $this->getFilemanagerDefaultFile();
         $this->disk = 'spaces';

         if (count($childHealthAssessment->uploadedDocuments) > 0) {
            $environment = strtoupper(env('APP_ENV'));
            $documents_folder_name = strtoupper($this->uploadFields['doc_type']);
            $this->childHealthAssessmentFile = "FILE MANAGER/{$environment}/{$documents_folder_name}/{$childHealthAssessment->uploadedDocuments[0]->doc_file_title}";
         }

         $childHealthAssessmentToReset = $this->checkForResetFile();

        if (count($childHealthAssessmentToReset->uploadedDocuments) > 0 &&
            $childHealthAssessmentToReset->uploadedDocuments[0]['reset_file'] &&
            Carbon::parse($childHealthAssessmentToReset->uploadedDocuments[0]['updated_at'])->gte(Carbon::parse($childInformation->getMeta('healthAssessmentDateReviewed')))) {
            $childInformation->removeMeta('healthAssessmentDateReviewed');
            $this->healthAssessmentDateReviewed = null;
        } else {
            $this->healthAssessmentDateReviewed = $childInformation->getMeta('healthAssessmentDateReviewed') ? Carbon::parse($childInformation->getMeta('healthAssessmentDateReviewed'))->format('F d, Y'): null;
        }


         $this->feeAgreementDateReviewed = $childInformation->getMeta('feeAgreementDateReviewed');

         // Check Current Child Status
         self::childInformationStatus();
    }

    public function mergeDataToTraitFields () {

        $this->child_id = $this->child_id ? $this->child_id: $this->childrenFields['id'];

        return [
            'primaryGuardianFields'  => $this->primaryGuardianFields,
            'files' => $this->files,
            'directories' => $this->directories
        ];
    }

    public function setAsChildHomeAddressSecondaryGuardian ( ) {
        if ( $this->sameAsChildAddressSecondary ) {
            $this->secondaryGuardianFields['home_address'] = $this->childrenFields['home_address'];
            $this->secondaryGuardianFields['city'] = $this->childrenFields['city'];
            $this->secondaryGuardianFields['state'] = $this->childrenFields['state'];
            $this->secondaryGuardianFields['zip'] = $this->childrenFields['zip'];
        } else {
            $this->secondaryGuardianFields['home_address'] = null;
            $this->secondaryGuardianFields['city'] = null;
            $this->secondaryGuardianFields['state'] = null;
            $this->secondaryGuardianFields['zip'] = null;
        }
    }

    public function setAsChildHomeAddressPrimaryGuardian ( ) {
        if ( $this->sameAsChildAddress ) {
            $this->primaryGuardianFields['home_address'] = $this->childrenFields['home_address'];
            $this->primaryGuardianFields['city'] = $this->childrenFields['city'];
            $this->primaryGuardianFields['state'] = $this->childrenFields['state'];
            $this->primaryGuardianFields['zip'] = $this->childrenFields['zip'];
        } else {
            $this->primaryGuardianFields['home_address'] = null;
            $this->primaryGuardianFields['city'] = null;
            $this->primaryGuardianFields['state'] = null;
            $this->primaryGuardianFields['zip'] = null;
        }
    }

    public function caculateAge ( ) {
        $this->childrenFields['age'] = Carbon::now()->diffInYears( $this->childrenFields['birthdate'] );
    }

    public function addEmergencyContact () {
        // Fields is empty
        if (  empty( $this->emergencyContactFields['first_name'] ) &&  empty( $this->emergencyContactFields['last_name'] )
            && empty( $this->emergencyContactFields['phone_number'] ) &&  empty( $this->emergencyContactFields['relationship'] )) {
            $this->alert('warning', 'Please input all required fields.');
            return false;
        } else {
            // Validate for duplicate record
            $authAdultExist =  array_filter( $this->emergencyContactFields['list_of_emergency_contact_registered'], function ( $keyValue, $keyIndex ) {
                                        return !is_null(  $this->emergencyContactFields['emergencyEditId'] ) ? (
                                                ( $keyValue['first_name'] == $this->emergencyContactFields['first_name'] && $keyValue['last_name'] == $this->emergencyContactFields['last_name'] )
                                                && ( !is_null( $this->emergencyContactFields['first_name'] ) && !is_null( $this->emergencyContactFields['last_name'] ))
                                                && $this->emergencyContactFields['emergencyEditId'] != $keyIndex
                                            )
                                            :
                                            (
                                                ($keyValue['first_name'] == $this->emergencyContactFields['first_name'] && $keyValue['last_name'] == $this->emergencyContactFields['last_name'] )
                                                && ( !is_null( $this->emergencyContactFields['first_name'] ) && !is_null( $this->emergencyContactFields['last_name'] ))
                                            );
                                }, ARRAY_FILTER_USE_BOTH  );

            if ( $authAdultExist ) {
                return  $this->alert('warning', 'Name already been added.');
            } else {
                if ( !is_null( $this->emergencyContactFields['emergencyEditId'] ) ) {
                    $this->emergencyContactFields['list_of_emergency_contact_registered'][ $this->emergencyContactFields['emergencyEditId'] ] = [
                                            'first_name'                        =>  $this->emergencyContactFields['first_name'],
                                            'last_name'                         =>  $this->emergencyContactFields['last_name'],
                                            'phone_number'                      =>  $this->emergencyContactFields['phone_number'],
                                            'relationship'                      =>  $this->emergencyContactFields['relationship'],
                                            'child_id'                          =>  $this->child_id
                                        ];
                } else {
                    array_push( $this->emergencyContactFields['list_of_emergency_contact_registered'],
                        [
                            'first_name'                        =>  $this->emergencyContactFields['first_name'],
                            'last_name'                         =>  $this->emergencyContactFields['last_name'],
                            'phone_number'                      =>  $this->emergencyContactFields['phone_number'],
                            'relationship'                      =>  $this->emergencyContactFields['relationship'],
                            'child_id'                          =>  $this->child_id
                        ]
                    );
                }

                $this->resetEmergencyContactFormFields();
            }
        }
    }

    public function cancelAddtionalEmergency () {
        $this->emergencyContactFields['first_name'] = null;
        $this->emergencyContactFields['last_name'] = null;
        $this->emergencyContactFields['phone_number'] = null;
        $this->emergencyContactFields['relationship'] = null;
        $this->emergencyContactFields['selected_option'] = null;
    }

    public function resetEmergencyContactFormFields () {
        $this->emergencyContactFields['first_name'] = null;
        $this->emergencyContactFields['last_name'] = null;
        $this->emergencyContactFields['phone_number'] = null;
        $this->emergencyContactFields['relationship'] = null;
    }

    public function editEmergencyContact ( $index ) {
        $this->emergencyContactFields['first_name'] = $this->emergencyContactFields['list_of_emergency_contact_registered'][ $index]['first_name'];
        $this->emergencyContactFields['last_name'] = $this->emergencyContactFields['list_of_emergency_contact_registered'][ $index]['last_name'];
        $this->emergencyContactFields['phone_number'] = $this->emergencyContactFields['list_of_emergency_contact_registered'][ $index]['phone_number'];
        $this->emergencyContactFields['relationship'] = $this->emergencyContactFields['list_of_emergency_contact_registered'][ $index]['relationship'];
        $this->emergencyContactFields['selected_option'] = !is_null( $this->emergencyContactFields['list_of_emergency_contact_registered'][ $index]['first_name'] ) ? 1: 0;
        $this->emergencyContactFields['emergencyEditId'] = $index;
    }

    public function deleteEmergencyContact ( $index ) {
        array_splice( $this->emergencyContactFields['list_of_emergency_contact_registered'] , $index, 1);
    }

    public function getFilesProperty() {
        return Storage::disk($this->disk)->allFiles($this->directory);
    }

    public function upload() {

        foreach ($this->uploads as $upload) {
            $filename = $upload->getClientOriginalName();
            $upload->storeAs($this->directory, $filename, 'spaces');
        }

        $uploadCount = count($this->uploads);

        $this->alert('success', "Successfully uploaded.");

        $this->reset('uploads');

        return true;
    }

    public function downloadFile($file) {
        return Storage::disk($this->disk)->download($file);
    }

    public function onDelete($file) {
        $this->file = $file;
        $fileOnly = \Str::after($file, '/');

        $this->confirm("Delete file?", [
            'text' => "Are you sure do you want to delete {$fileOnly}?",
            'onConfirmed' => 'delete',
            'onCancelled' => 'resetFile'
        ]);

        return;
    }

    public function resetFile() {
        $this->reset('file');
    }

    public function delete() {
        Storage::disk($this->disk)->delete($this->file);

        $this->alert('success', "Deletion successful!");

        $this->resetFile();
    }

    public function acceptParentHandbook () {
        $childInfo = ChildInformation::find($this->child_id);

        $childInfo->setMeta('child_hanbook_signed_date', Carbon::now());

        $this->disableParentHandbookAcceptBtn = true;
        $this->confirmHandbookModal = false;
        $this->displayHandbookModal = false;

        $this->childFamilyQuestionaierModifiedDate = $childInfo->getMeta('child_hanbook_signed_date');
        $this->childParentHandBookModifiedDate = Carbon::now()->format('F d, Y');

        return redirect()->route('children.children-view', [
            'user' => Auth()->user()->id,
            'first_name' => $this->childrenFields['first_name'],
            'last_name' => $this->childrenFields['last_name'],
            'child_id' => $this->child_id
        ]);
    }

    public function downloadParentHandbook  ( ) {
         return Storage::disk($this->disk)->download( $this->parentHandbookFile );
    }

    public function childrenListTab () {
        return redirect()->route('children',['user' => Auth()->user()->id]);
    }
    /**
     * Selected directories only
     */
    public function getDirectoriesProperty() {
        return [
            'children_permision_slips'
        ];
    }

    public function cancelSecondaryDetails ()
    {
        $this->cancelSecondaryDetails = "no";
        $this->secondaryGuardianFields['isSecondaryGuardian'] = "no";

    }

    public function cancelPrimaryDetails ()
    {
        $this->cancelPrimaryDetails = "no";
        $this->primaryGuardianFields['isPrimaryGuardian'] = "yes";
    }

    public function requestFeeAgreement ()
    {
        $parentName = Auth()->user()->first_name.' '.Auth()->user()->last_name;

        $docuSignData = [
            'templateName' => 'Children Fee Agreement',
            'subject' => $parentName.'-Fee Agreement',
            'name' => $parentName,
            'email' => Auth()->user()->email,
            'role' => 'Signer 1'
        ];

        // Send Request Documents
        $docusign = $this->processTemplate($docuSignData);

        // Save Docusign envelop
        ChildInformation::find($this->child_id)->update(['docusign_envelop_id' => $docusign['envelopeId']]);

        $this->requestFeeAgreement = true;

        // Get all admin users
        $adminUsers = User::UserRole('admin')->get()->toArray();

        // Send notification to all Admin users
        foreach ($adminUsers as $key => $admin) {
            $emailTemplateData = [
                'subject' => $parentName.'-Fee Agreement Request Submitted',
                'template' => 'vendor.mail.html.adminnotify',
                'email' => $admin['email'],
                'parentName' => $parentName,
                'childName' => $this->childrenFields['first_name'].' '.$this->childrenFields['last_name']
             ];

             self::feeAgreementNotifyAdmin($emailTemplateData);
        }
    }

    public function feeAgreementNotifyAdmin ($emailTemplateData)
    {
        $emailData =  [
            'content'   => $emailTemplateData['template'],
            'subject'   => $emailTemplateData['subject'],
            'to'        => $emailTemplateData['email']
        ];

        Mail::send( $emailData['content'], $emailTemplateData ,function ( $message ) use ( $emailData ) {
            $message->to( $emailData['to'],  $emailData['subject'] )
                    ->subject( $emailData['subject'] );
        });
    }

    public function createEmergencyContactInfo ()
    {
        $success = $this->populateEmergencyContact( $this->child_id );

        $this->createEmergencyContact  = false;
        return $this->emergencyContactPopulated = count($this->emergencyContactFields['list_of_emergency_contact_registered']) ?? false;

    }

    public function printChildEmergencyContact ()
    {

        $childAddress = ($this->childrenFields['home_address'] ?$this->childrenFields['home_address'].',': '' ).' '.($this->childrenFields['city']?$this->childrenFields['city'].',': '').' '.($this->childrenFields['state'] ?$this->childrenFields['state'].',': '').' '.($this->childrenFields['zip']?$this->childrenFields['zip']: '');
        $physicianAddress = ($this->medicalInformation['physician_address']?$this->medicalInformation['physician_address'].',': '').' '.($this->medicalInformation['physician_city']?$this->medicalInformation['physician_city'].',': '').' '.($this->medicalInformation['physician_state']?$this->medicalInformation['physician_state'].',':'').' '.($this->medicalInformation['physician_zip']?$this->medicalInformation['physician_zip']:'');

        $data = [
            'child_name' => $this->childrenFields['first_name'].' '.$this->childrenFields['last_name'],
            'child_birthdate' => $this->childrenFields['birthdate'],
            'child_address' => $childAddress,
            'mothers_name' => null,
            'mothers_tel' => null,
            'mothers_address' => null,
            'mothers_business_name' => null,
            'mothers_business_tel' => null,
            'mothers_business_address' => null,
            'fathers_name' => null,
            'fathers_tel' => null,
            'fathers_address' => null,
            'fathers_business_name' => null,
            'fathers_business_tel' => null,
            'fathers_business_address' => null,
            'emergency_contacts' => $this->emergencyContactFields['list_of_emergency_contact_registered'],
            'auth_persons' => $this->authAdultFields['authAdults'],
            'physician_name' => $this->medicalInformation['physician_name'],
            'physician_tel' => $this->medicalInformation['physician_number'],
            'physician_address' => $physicianAddress,
            'disabilities' => null,
            'medication_reaction' => $this->medicalInformation['prescribe_medication'],
            'medical_dietary' => null,
            'medical_special_conditions' => $this->medicalInformation['allergies'],
            'additional_special_child_medication' => $this->medicalInformation['special_needs'],
            'health_insurance' => $this->medicalInformation['child_held_insurance_provider'],
            'policy_number' => $this->medicalInformation['insurance_policy_number'],
            'walk_trips' => null,
            'swimming' => null,
            'transportation' => null,
            'wading' => null
        ];

        $filename = "ChildEmergencyContact.pdf";

        if (Storage::disk('spaces')->has($filename)) {
            Storage::disk('spaces')->delete($filename);
        }

        $pdf = PDF::loadView(
            'printables.children.emergency-contact-print',
            $data
        )->output();

        Storage::disk('spaces')->put($filename, $pdf);

        return Storage::disk('spaces')->download($filename);
    }


    public function setAsChildHomeAddressForMother ( )
    {
        if ( $this->childs_mother['sameAsChildAddress'] ) {
            $this->childs_mother['home_address'] = $this->childrenFields['home_address'];
            $this->childs_mother['home_city'] = $this->childrenFields['city'];
            $this->childs_mother['home_state'] = $this->childrenFields['state'];
            $this->childs_mother['home_zip'] = $this->childrenFields['zip'];
            $this->motherSameAsChildAddress = true;
        } else {
            $this->childs_mother['home_address'] = null;
            $this->childs_mother['home_city'] = null;
            $this->childs_mother['home_state'] = null;
            $this->childs_mother['home_zip'] = null;
            $this->motherSameAsChildAddress = false;
        }
    }

    public function setAsChildHomeAddressForFather ( )
    {
        if ( $this->childs_father['sameAsChildAddress'] ) {
            $this->childs_father['home_address'] = $this->childrenFields['home_address'];
            $this->childs_father['home_city'] = $this->childrenFields['city'];
            $this->childs_father['home_state'] = $this->childrenFields['state'];
            $this->childs_father['home_zip'] = $this->childrenFields['zip'];
            $this->fatherSameAsChildAddress = true;
        } else {
            $this->childs_father['home_address'] = null;
            $this->childs_father['home_city'] = null;
            $this->childs_father['home_state'] = null;
            $this->childs_father['home_zip'] = null;
            $this->fatherSameAsChildAddress = false;
        }
    }

    public function setFatherPrimary ()
    {
        if ($this->childs_father['primary_guardian']) {
            $this->childs_father['secondary_guardian'] = false;
            $this->childs_father['primary_guardian'] = true;
            $this->childs_mother['primary_guardian'] = false;
            $this->childs_mother['secondary_guardian'] = true;
        } else {
            $this->childs_father['secondary_guardian'] = true;
            $this->childs_father['primary_guardian'] = false;
            $this->childs_mother['primary_guardian'] = true;
            $this->childs_mother['secondary_guardian'] = false;
        }
    }

    public function setFatherSecondary ()
    {
        if ($this->childs_father['secondary_guardian']) {
            $this->childs_father['primary_guardian'] = false;
            $this->childs_father['secondary_guardian'] = true;
            $this->childs_mother['primary_guardian'] = true;
            $this->childs_mother['secondary_guardian'] = false;
        } else {
            $this->childs_father['primary_guardian'] = true;
            $this->childs_father['secondary_guardian'] = false;
            $this->childs_mother['primary_guardian'] = false;
            $this->childs_mother['secondary_guardian'] = true;
        }

    }

    public function setMotherPrimary ()
    {
        if ($this->childs_mother['primary_guardian']) {
            $this->childs_father['primary_guardian'] = false;
            $this->childs_father['secondary_guardian'] = true;
            $this->childs_mother['primary_guardian'] = true;
            $this->childs_mother['secondary_guardian'] = false;
        } else {
            $this->childs_father['primary_guardian'] = true;
            $this->childs_father['secondary_guardian'] = false;
            $this->childs_mother['primary_guardian'] = false;
            $this->childs_mother['secondary_guardian'] = true;
        }
    }

    public function setMotherSecondary ()
    {
        if ($this->childs_mother['secondary_guardian']) {
            $this->childs_father['primary_guardian'] = true;
            $this->childs_father['secondary_guardian'] = false;
            $this->childs_mother['primary_guardian'] = false;
            $this->childs_mother['secondary_guardian'] = true;
        } else {
            $this->childs_father['primary_guardian'] = false;
            $this->childs_father['secondary_guardian'] = true;
            $this->childs_mother['primary_guardian'] = true;
            $this->childs_mother['secondary_guardian'] = false;
        }

    }

    public function saveChildrenInfo()
    {
        $validatedData = Validator::make(
                [
                    'first_name'    => $this->childrenFields['first_name'],
                    'last_name'     => $this->childrenFields['last_name'],
                    'age'           => $this->childrenFields['age'],
                    'sex'           => $this->childrenFields['sex'],
                    'home_address'  => $this->childrenFields['home_address'],
                    'city'          => $this->childrenFields['city'],
                    'state'         => $this->childrenFields['state'],
                    'zip'           => $this->childrenFields['zip'],
                    'birthdate'     => $this->childrenFields['birthdate'],
                ],
                [
                    'first_name'    => 'required',
                    'last_name'     => 'required',
                    'age'           => 'required',
                    'sex'           => 'required',
                    'home_address'  => 'required',
                    'city'          => 'required',
                    'state'         => 'required',
                    'zip'           => 'required',
                    'birthdate'     => 'required',
                ],
                [
                    'required' => 'The :attribute field is required',
                    'required' => 'The :attribute field is required',
                    'required' => 'The :attribute field is required',
                    'required' => 'The :attribute field is required',
                    'required' => 'The :attribute field is required',
                    'required' => 'The :attribute field is required',
                    'required' => 'The :attribute field is required',
                    'required' => 'The :attribute field is required',
                    'required' => 'The :attribute field is required',
                ],
        )->validate();

        $this->validateChildInfoRequiredFields();

        $this->populateEnrollmentApplication();
    }

    public function validateChildInfoRequiredFields()
    {
        $childInforImportantFields = [
            'first_name',
            'last_name',
            'age',
            'sex',
            'home_address',
            'city',
            'state',
            'zip',
            'birthdate',
        ];

        for ($i=0; $i < count($childInforImportantFields); $i++) {
            if (!isset($this->childrenFields[$childInforImportantFields[$i]])) {
                return $this->childInfoCompleted = false;
            }
        }

        $this->childInfoCompleted = true;
        if (isset($this->childrenFields['updated_at'])) {
            $this->childInfoLastModifiedDate = Carbon::parse($this->childrenFields['updated_at'])->format('F d, Y');
        }
    }

    public function saveMedicalInfo()
    {
        $this->validateMedicalInforForm();

        $this->populateMedicalInformation($this->child_id);

        $this->childMedicalInfoLastModifiedDate = Carbon::parse($this->medicalInformation['updated_at'])->format('F d, Y');

        return redirect()->route('children.children-view', [
            'user' => Auth()->user()->id,
            'first_name' => $this->childrenFields['first_name'],
            'last_name' => $this->childrenFields['last_name'],
            'child_id' => $this->child_id
        ]);
    }

    public function validateMedicalInforForm()
    {
        $validatedData = Validator::make(
                    [
                        'physician_name' => $this->medicalInformation['physician_name'],
                        'physician_number' => $this->medicalInformation['physician_number'],
                        'child_held_insurance_provider' => $this->medicalInformation['child_held_insurance_provider'],
                        'insurance_policy_number' => $this->medicalInformation['insurance_policy_number'],
                    ],
                    [
                        'physician_name' => 'required',
                        'physician_number' => 'required',
                        'child_held_insurance_provider' => 'required',
                        'insurance_policy_number' => 'required',
                    ],
                    [
                        'required' => 'The :attribute field is required',
                        'required' => 'The :attribute field is required',
                        'required' => 'The :attribute field is required',
                        'required' => 'The :attribute field is required',
                    ],
            )->validate();

            $this->childMedicalInfoCompleted = true;

            if (isset($this->medicalInformation['updated_at'])) {
                $this->childMedicalInfoLastModifiedDate = Carbon::parse($this->medicalInformation['updated_at'])->format('F d, Y');;
            }

            return $validatedData;
    }

    public function saveFamilyQuestionaire() {
        // Validate important Fields
        $this->validateFamilyQuestionaire();

        $this->populateFamilyQuestionaire($this->child_id);

        $this->childFamilyQuestionaierModifiedDate = Carbon::parse($this->familyQuestionaireFields['updated_at'])->format('F d, Y');

        $this->childChildQuestoinaerCompleted = true;

        return redirect()->route('children.children-view', [
            'user' => Auth()->user()->id,
            'first_name' => $this->childrenFields['first_name'],
            'last_name' => $this->childrenFields['last_name'],
            'child_id' => $this->child_id
        ]);
    }

    public function validateFamilyQuestionaire()
    {
        $validatedData = Validator::make(
            [
                'cultural_bg' => $this->familyQuestionaireFields['cultural_bg'],
                'language' => $this->familyQuestionaireFields['language'],
            ],
            [
                'cultural_bg' => 'required',
                'language' => 'required',
            ],
            [
                'required' => 'The :attribute field is required',
                'required' => 'The :attribute field is required',
            ],
        )->validate();

        $this->childChildQuestoinaerCompleted = true;

        if (isset($this->familyQuestionaireFields['updated_at'])) {
            $this->childFamilyQuestionaierModifiedDate = Carbon::parse($this->familyQuestionaireFields['updated_at'])->format('F d, Y');;
        }

        return $validatedData;
    }

    public function savePermissionSlip()
    {
        $this->validatePermissionSlip();

        $this->populatePermissionSlips($this->child_id);

        return redirect()->route('children.children-view', [
            'user' => Auth()->user()->id,
            'first_name' => $this->childrenFields['first_name'],
            'last_name' => $this->childrenFields['last_name'],
            'child_id' => $this->child_id
        ]);
    }

    public function validatePermissionSlip()
    {
        $validatedData = Validator::make(
            [
                'allow_put_sunscreen' => $this->permissionSlip['allow_put_sunscreen'],
                'allow_use_hand_sanitizer' => $this->permissionSlip['allow_use_hand_sanitizer'],
                'allow_apply_diaper_cream' => $this->permissionSlip['allow_apply_diaper_cream'],
            ],
            [
                'allow_put_sunscreen' => 'required',
                'allow_use_hand_sanitizer' => 'required',
                'allow_apply_diaper_cream' => 'required',
            ],
            [
                'required' => 'The :attribute field is required',
                'required' => 'The :attribute field is required',
                'required' => 'The :attribute field is required',
            ],
        )->validate();

        $this->childPermissionCompleted = true;

        if (isset($this->permissionSlip['updated_at'])) {
            $this->childPermissionDateModified = Carbon::parse($this->permissionSlip['updated_at'])->format('F d, Y');
        }

        return $validatedData;
    }

    public function downloadEmergencyContactForm ()
    {
        return Storage::disk($this->disk)->download($this->emergencyContacForm);
    }

    public function downloadAssesmentForm ()
    {
        return Storage::disk($this->disk)->download($this->childHealthAssessmentFile);
    }

    public function saveImmunization()
    {
        $this->populateImmunization($this->child_id);

        $childInfo = ChildInformation::find($this->child_id);
        $childInfo->setMeta('Child_immunization_record_date', Carbon::now()->format('F d, Y'));
        $this->childFeeAgreementCompleted = true;
        $this->childFeeAgreementLastModified = Carbon::now()->format('F d, Y');

        return redirect()->route('children.children-view', [
            'user' => Auth()->user()->id,
            'first_name' => $this->childrenFields['first_name'],
            'last_name' => $this->childrenFields['last_name'],
            'child_id' => $this->child_id
        ]);
    }

    public function downloadFeeAgreement ()
    {
        return Storage::disk($this->disk)->download($this->childLastestFeeAgreementFile);
    }

    public function sendParentNotification()
    {
        $emailData =  [
            'template'   => 'vendor.mail.html.parentnotification',
            'subject'   => 'Fee Agreement',
            'to'        => explode(',', $this->parentEmails)
        ];

        Mail::send( $emailData['template'], $this->feeAgreementFields ,function ( $message ) use ( $emailData ) {
            $message->to( $emailData['to'],  $emailData['subject'] )
                    ->subject( $emailData['subject'] );
        });
        $this->alert('success', "Your message has been sent.");

        return $this->displayNotifyParentModal = false;
    }

    public function NotifyParentEditor()
    {
        $emails = [];
        $primaryGuardianName = '[Parent Name]';
        $childParentContacts = ChildInformation::with(['getChildEmergencyContact', 'getFathersInfo', 'getMothersInfo'])
                                                ->where('id', $this->child_id)
                                                ->first();
        if ($childParentContacts) {

            if ($childParentContacts->getChildEmergencyContact) {
                foreach ($childParentContacts->getChildEmergencyContact as $key => $emergencyContact) {
                    array_push($emails, $emergencyContact['email']);
                }
            }

            if ($childParentContacts->getFathersInfo) {
                array_push($emails, $childParentContacts->getFathersInfo->email);

                if ($childParentContacts->getFathersInfo->primary_guardian) {
                    $primaryGuardianName = $childParentContacts->getFathersInfo->first_name.' '.$childParentContacts->getFathersInfo->last_name;
                    $this->hasParentInfo = true;
                }
            }

            if ($childParentContacts->getMothersInfo) {
                array_push($emails, $childParentContacts->getMothersInfo->email);

                if ($childParentContacts->getMothersInfo->primary_guardian) {
                    $primaryGuardianName = $childParentContacts->getMothersInfo->first_name.' '.$childParentContacts->getMothersInfo->last_name;
                    $this->hasParentInfo = true;
                }
            }
            $this->parentEmails = join(',',$emails);
            $this->feeAgreementFields['parent_notification_email_content'] = "Hello {$primaryGuardianName},
            The Fee Agreement for {$this->childrenFields['first_name']} {$this->childrenFields['last_name']} is ready to be donwloaded and printed. Please log in to your child’s account, scroll down to the Fee Agreement section and print the agreement. Once the file is signed, upload the file to our system.";
        } else {
            $this->feeAgreementFields['parent_notification_email_content'] = "Hello [Parent Name],
            The Fee Agreement for {$this->childrenFields['first_name']} {$this->childrenFields['last_name']} is ready to be donwloaded and printed. Please log in to your child’s account, scroll down to the Fee Agreement section and print the agreement. Once the file is signed, upload the file to our system.";
        }
    }

    public function checkChildStepsCompletion()
    {
        if ($this->childInfoCompleted && $this->childMedicalInfoCompleted
        && $this->childChildQuestoinaerCompleted && $this->user->hasMedia(slug('Emergency Contact Parental Consent Form'.'-'.$this->child_id, '_'))
        && $this->childPermissionCompleted && $this->parentHandbook['signed_date']
        && $this->immunizationCompleted && $this->childFeeAgreementCompleted) {
            ChildInformation::where('id', $this->child_id)->update(['status' => 1]);
        }
    }

    public function updatedEmergencyContactDateReviewed()
    {
        $childInfo = ChildInformation::find($this->child_id);
        $childInfo->setMeta('emergencyContactDateReviewed', Carbon::now());
        self::childInformationStatus();
    }

    public function updatedHealthAssessmentDateReviewed()
    {
        $childInfo = ChildInformation::find($this->child_id);
        $childInfo->setMeta('healthAssessmentDateReviewed', Carbon::now());
        self::childInformationStatus();
    }

    public function updatedFeeAgreementDateReviewed()
    {
        $childInfo = ChildInformation::find($this->child_id);
        $childInfo->setMeta('feeAgreementDateReviewed', Carbon::now());
        self::childInformationStatus();
    }

    public function childInformationStatus()
    {
        if ($this->childInfoCompleted &&
        $this->childMedicalInfoCompleted &&
        $this->childChildQuestoinaerCompleted &&
        ($this->emergencyContactDateReviewed && $this->user->hasMedia(slug('Emergency Contact Parental Consent Form'.'-'.$this->child_id, '_'))) &&
        $this->childPermissionCompleted &&
        ($this->parentHandbook['signed_date'] && $this->parentHandbookFile) &&
        ($this->childHealthAssessmentFile
        && $this->healthAssessmentDateReviewed
        && $this->user->hasMedia(slug('Assement Form'.'-'.$this->child_id, '_'))) &&
        $this->immunizationCompleted &&
        ($this->childFeeAgreementCompleted
        && $this->feeAgreementDateReviewed
        && $this->user->hasMedia(slug('Signed Child Fee Agreement'.'-'.$this->child_id, '_')))
        ) {
            $this->setChildrenActive($this->child_id);
            $this->status = 'Registration Status: Registration Complete﻿';
        } else {
            ChildInformation::find($this->child_id)->update(['status' => 0]);
            $this->status = 'Registration Status: Updates Needed﻿﻿';
        }
    }
    /**
     * Converts Date base on file frequency
    */
    public function getFileExpirationDate($frequency, $date)
    {
        if (str_contains($frequency, 'Years') || str_contains($frequency, 'Year')) {
            return Carbon::parse($date)->addYears((integer)$frequency);
        } elseif (str_contains($frequency, 'Months') || str_contains($frequency, 'Month')) {
            return Carbon::parse($date)->addMonths((integer)$frequency);
        } else {
            return Carbon::parse($date)->addDays((integer)$frequency);
        }
    }

    public function render()
    {
        return view('livewire.children.children-view', $this->mergeDataToTraitFields() );
    }
}
