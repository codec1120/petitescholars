<?php

use App\Http\Livewire\Parents\{ParentsView, ParentLandingPage};
use App\Http\Livewire\Parents\ParentsForm\{ ParentsForm };
use App\Http\Livewire\Parents\ParentsPassword\ParentPassword;

Route::middleware('auth')->group(function ($route) {
    $route->get('/', ParentsView::class)
        ->name('parents');
    $route->get('parents-form', ParentsForm::class)
        ->name('parents.parents-form.parents-form');
    $route->get('/{parentId}/parent-password', ParentPassword::class)
        ->name('parents.parents-password.parent-password');
    $route->get('/{user}/parent-landing-page', ParentLandingPage::class)
        ->name('parents.parent-landing-page');
});