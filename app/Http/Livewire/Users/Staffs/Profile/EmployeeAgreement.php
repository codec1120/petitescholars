<?php

namespace App\Http\Livewire\Users\Staffs\Profile;

use Livewire\Component;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

use App\Traits\Fields\{
    WithEmployeeDataFields,
    FileManagerFields
};

use App\Traits\{
    EmployeeData,
    FileManagerData
};

use App\Models\{
    User,
    EmployeeEducation,
    EmployeeEmploymentExperience,
    EmployeeInfo,
    EmployeePresentPosition,
    DisclosureAgreement,
    HandbookAgreement
};

use Illuminate\Support\Facades\Storage;

use PDF;

use Illuminate\Support\Carbon;

class EmployeeAgreement extends Component
{
    use AuthorizesRequests, WithEmployeeDataFields, EmployeeData;
    use FileManagerData, FileManagerFields;

    public $route = 'staffs.profile.employee-agreement';
    public $user;
    public $eds;
    public $date_completed;
    public $modified_date;
    public $status;
    public $view = false;
    public $signed = false;
    public $displayModalDislosureAgreement = false;
    public $viewModalDislosureAgreement = false;
    public $displayModalHandbookAgreement = false;
    public $viewModalHandbookAgreement = false;
    public $showAcceptBtnForDisclosureAgreement = false;
    public $showAcceptBtnForHandbook = false;
    public $disclosureAgreementChecker = false;
    public $staffAgreementChecker = false;
    public $employeeAgreementRedirectAfterUpload = '';
    public $employeeAgreementFile;
    public $empAggreementDwnloaded = false;
    public $disk;
    public $handbookfile;
    public $disclosurefile;
    public $empAgreementFileExist = false;
    public $handbookFileExist = false;
    public $disclosureFileExist = false;
    public $dataSheetToReset = false;
    public $uploaded_docx_id_staffhandbook;
    public $uploaded_docx_id_diclosure;
    public $uploaded_docx_id_employeedata;
    public $employeeDataSheet;
    public $staffDisclosureAgreementTempUrl;
    public $staffHandbookTempUrl;
    public $viewModal = false;
    public $view_modal_title;
    public $view_modal_description;
    public $view_modal_tempURL;


    public function mount(User $user)
    {
        $this->authorize('viewStaffProfile', $user);
        $this->user = $user;
        $this->eds = isset($this->getEmployeeDataSheetRecord()['employee']['created_at'] ) ?? null;

        $this->modified_date = isset($this->getEmployeeDataSheetRecord()['employee']['updated_at'] ) ? carbon( $this->getEmployeeDataSheetRecord()['employee']['updated_at'] )->format('Y-m-d') : null;
        $this->status = isset($this->getEmployeeDataSheetRecord()['employee']['created_at'] ) ? (!$this->getEmployeeDataSheetRecord()['employee']['status'] ? "Incomplete": "Submitted & Acknowledged") : null;
        $this->employeeAgreementRedirectAfterUpload = '/staffs/'.$this->user->id.'/employee-agreement';
        $this->date_completed = $this->user->hasMedia(slug('Employee Data Sheet'.'-'.$user->id, '_')) ?
                         Carbon::parse($this->user->getMedia(slug('Employee Data Sheet'.'-'.$user->id, '_'))[0]['updated_at']):
                        null;

        // Employee Data Sheet File
        $this->uploadFields['doc_owner_ident'] = 1;
        $this->uploadFields['doc_type'] = 'Employee Data Sheet';
        $employeeDataSheetFile =  $this->getFilemanagerDefaultFile();
        $this->disk = 'spaces';

        $this->employeeAgreementFile = $this->user->hasMedia(slug('Employee Data Sheet'.'-'.$user->id, '_')) ?
                                $this->user->getMedia(slug('Employee Data Sheet'.'-'.$user->id, '_'))[0]['directory']."/".$this->user->getMedia(slug('Employee Data Sheet'.'-'.$user->id, '_'))[0]['filename'].".".$this->user->getMedia(slug('Employee Data Sheet'.'-'.$user->id, '_'))[0]['extension']:
                                null;

        if (count($employeeDataSheetFile->uploadedDocuments) > 0) {
            $environment = strtoupper(env('APP_ENV'));
            $documents_folder_name = strtoupper($this->uploadFields['doc_type']);

            $this->employeeDataSheet = "FILE MANAGER/{$environment}/{$documents_folder_name}/{$employeeDataSheetFile->uploadedDocuments[0]->doc_file_title}";
            $this->empAgreementFileExist = true;
        }

        $employeeDataSheetToReset = $this->checkForResetFile();

        if (count($employeeDataSheetToReset->uploadedDocuments) > 0 &&
            $employeeDataSheetToReset->uploadedDocuments[0]['reset_file'] &&
            Carbon::parse($employeeDataSheetToReset->uploadedDocuments[0]['updated_at'])->gt(Carbon::parse($this->date_completed))) {
            $this->date_completed = null;
        }

        // Staff handbook
        $this->uploadFields['doc_owner_ident'] = 1;
        $this->uploadFields['doc_type'] = 'Staff Handbook';
        $staffHandbookfile =  $this->getFilemanagerDefaultFile();
        $this->disk = 'spaces';

        if (count($staffHandbookfile->uploadedDocuments) > 0) {
            $environment = strtoupper(env('APP_ENV'));
            $documents_folder_name = strtoupper($this->uploadFields['doc_type']);

            $this->handbookfile = "FILE MANAGER/{$environment}/{$documents_folder_name}/{$staffHandbookfile->uploadedDocuments[0]->doc_file_title}";

            $this->handbookFileExist = true;

            $this->staffHandbookTempUrl = Storage::disk($this->disk)->temporaryUrl( $this->handbookfile , now()->addMinutes(30) );
        }

        $staffHanbookToReset = $this->checkForResetFile();

        $this->getEmployeeDataSheetRecord();

        if (count($staffHanbookToReset->uploadedDocuments) > 0 &&
            $staffHanbookToReset->uploadedDocuments[0]['reset_file'] &&
            Carbon::parse($staffHanbookToReset->uploadedDocuments[0]['updated_at'])->gte(Carbon::parse($this->user->getMeta('date_signed_handbook_agreement')))) {
            $this->user->removeMeta('date_signed_handbook_agreement');
        } else {
            $this->handbookAgreement['date_signed_disclosure_agreement'] = $this->user->getMeta('date_signed_handbook_agreement');
        }

        // Disclosure Statement
        $this->uploadFields['doc_owner_ident'] = 1;
        $this->uploadFields['doc_type'] = 'Disclosure Statement';
        $disclosureStatementFile =  $this->getFilemanagerDefaultFile();
        $this->disk = 'spaces';

        if (count($disclosureStatementFile->uploadedDocuments) > 0) {
            $this->disclosureFileExist = true;

            $documents_folder_name = strtoupper($this->uploadFields['doc_type']);

            $this->disclosurefile = "FILE MANAGER/{$environment}/{$documents_folder_name}/{$disclosureStatementFile->uploadedDocuments[0]->doc_file_title}";

            $this->staffDisclosureAgreementTempUrl = Storage::disk($this->disk)->temporaryUrl( $this->disclosurefile , now()->addMinutes(30) );
        }

        $disclosureToReset = $this->checkForResetFile();

        if (count($disclosureToReset->uploadedDocuments) > 0 &&
            $disclosureToReset->uploadedDocuments[0]['reset_file'] &&
            Carbon::parse($disclosureToReset->uploadedDocuments[0]['updated_at'])->gte(Carbon::parse($this->user->getMeta('date_signed_disclosure_agreement')))) {
            $this->user->removeMeta('date_signed_disclosure_agreement');
        } else {
            $this->disclosureAgreement['date_signed_disclosure_agreement'] = $this->user->getMeta('date_signed_disclosure_agreement');
        }
    }

    public function createEmployeeData() {
        return redirect()->route('staffs.profile.employee-data-sheet.employee-data-form', $this->user);
    }

    public function editEmployeeData () {
        return redirect()->route('staffs.profile.employee-data-sheet.employee-data-form', $this->user);
    }

    public function printEdsPDF() {
        return Storage::disk('spaces')->download($this->employeeDataSheet);
    }

    //  Accept Disclosure Agreement
    public function acceptDisclosureAgreement () {
       // Populate Agreement Signed Date
        $this->user->setMeta('date_signed_disclosure_agreement', Carbon::now());
        // Set modal pop out
        $this->displayModalDislosureAgreement = false;

        return redirect()->route('staffs.profile.employee-agreement', $this->user);
    }

    // Download Disclosure Agreement
    public function downloadDisclosureAgreement () {
        return Storage::disk($this->disk)->download($this->disclosurefile);
    }

    // Download Staff handbook
    public function downloadHandbookAgreement() {
        return Storage::disk($this->disk)->download($this->handbookfile);
    }

    //  Accept Staff handbook
    public function acceptHandbookAgreement ()
    {
        // Set modal pop out
        $this->displayModalHandbookAgreement = false;

        $this->user->setMeta('date_signed_handbook_agreement', Carbon::now());

        return redirect()->route('staffs.profile.employee-agreement', $this->user);
    }

    public function  disclosureAgreement () {
        if ( $this->disclosureAgreementChecker ) {
            $this->showAcceptBtnForDisclosureAgreement = true;
        } else {
            $this->showAcceptBtnForDisclosureAgreement = false;
        }
    }

    public function  staffAgreement () {
        if ( $this->staffAgreementChecker ) {
            $this->showAcceptBtnForHandbook = true;
        } else {
            $this->showAcceptBtnForHandbook = false;
        }
    }

    public function viewHandbooModal () {
        $this->viewModalHandbookAgreement = true;
        $this->displayModalHandbookAgreement = true;
    }

    public function closeModalHandbook () {
        $this->displayModalHandbookAgreement = false;
    }

    public function downloadEmpDataSheet()
    {
        return Storage::disk('spaces')->download($this->employeeDataSheet);
    }

    public function setEmpDataSheetModal()
    {
        $this->viewModal = true;
        $this->view_modal_title = 'Employee Data Sheet';
        $this->view_modal_tempURL = Storage::disk($this->disk)->temporaryUrl($this->employeeAgreementFile, now()->addMinutes(30));
    }

    public function render()
    {
        return view('livewire.users.staffs.profile.employee-agreement', $this->getEmployeeDataSheetRecord());
    }
}
