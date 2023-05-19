<?php

use App\Http\Livewire\Children\{ChildrenView,ChildreMainView};
use App\Http\Livewire\Children\ChildrenEditChild\{
    EmergencyContact,
    EnrollmentApplication,
    FamilyQuestionaire,
    ImmunizationRecord,
    MedicalInformation,
    PermissionSlip
};
use App\Http\Livewire\Children\Contacts\Contacts;

use App\Http\Livewire\Children\Notes\Notes;

Route::middleware('auth')->group(function ($route) {
        $route->get('/{user}', ChildreMainView::class)
            ->name('children');
        $route->get('{user}/child-edit', ChildrenView::class)
            ->name('children.children-view');
        $route->get('{child_id}/child-edit/childInfo', EnrollmentApplication::class)
            ->name('children.children-edit-child.enrollment-application');
        $route->get('{child_id}/child-edit/medicalInfo', MedicalInformation::class)
            ->name('children.children-edit-child.medical-information');
        $route->get('{child_id}/child-edit/familyQuestionaire', FamilyQuestionaire::class)
            ->name('children.children-edit-child.family-questionaire');
        $route->get('{child_id}/child-edit/emergencyContact', EmergencyContact::class)
            ->name('children.children-edit-child.emergency-contact');
        $route->get('{child_id}/child-edit/permissionSlip', PermissionSlip::class)
            ->name('children.children-edit-child.permission-slip');
        $route->get('{child_id}/child-edit/immunizationRecord', ImmunizationRecord::class)
            ->name('children.children-edit-child.immunization-record');
        $route->get('{child_id?}/child-edit/contacts', Contacts::class)
            ->name('children.contacts.contacts');
        $route->get('{child_id?}/child-edit/notes', Notes::class)
            ->name('children.notes.notes');
});