<?php

use App\Http\Livewire\Users\Staffs\Profile\{
    GeneralInformation,
    EmployeeAgreement,
    Education,
    Clearances,
    Training,
    EmploymentRequirements,
    Reviews,
    MediaFiles,
    ReviewForm,
    EmergencyContact,
};

use App\Http\Livewire\Users\Staffs\Profile\EmployeeDataSheet\EmployeeDataForm;
use App\Http\Livewire\Users\Staffs\Profile\EmergencyContact\EmergencyContactForm;

Route::middleware('auth')->group(function ($route) {
    $route->get('/{user}', GeneralInformation::class)
        ->name('staffs.profile.index');
    $route->get('/{user?}/general', GeneralInformation::class)
        ->name('staffs.profile.general');
    $route->get('/{user?}/employee-agreement', EmployeeAgreement::class)
        ->name('staffs.profile.employee-agreement');
    $route->get('/{user?}/education', Education::class)
        ->name('staffs.profile.education');
    $route->get('/{user?}/clearances', Clearances::class)
        ->name('staffs.profile.clearances');
    $route->get('/{user?}/emergency-contact', EmergencyContact::class)
        ->name('staffs.profile.emergency-contact');
    $route->get('/{user?}/emergency-contact-form', EmergencyContactForm::class)
        ->name('staffs.profile.emergency-contact.emergency-contact-form');
    $route->get('/{user?}/training', Training::class)
        ->name('staffs.profile.training');
    $route->get('/{user?}/employment-requirements', EmploymentRequirements::class)
        ->name('staffs.profile.employment-requirements');
    $route->get('/{user?}/reviews', Reviews::class)
        ->name('staffs.profile.reviews');
    $route->get('/{user?}/media', MediaFiles::class)
        ->name('staffs.profile.media');
    $route->get('/{user?}/reviews/create', ReviewForm::class)
        ->name('staffs.profile.reviews.create');
    $route->get('/{user?}/reviews/{review}/edit', ReviewForm::class)
        ->name('staffs.profile.reviews.edit');
    $route->get('/{user?}/employee-agreement/createEmployeeData', EmployeeDataForm::class)
        ->name('staffs.profile.employee-data-sheet.employee-data-form');
});
