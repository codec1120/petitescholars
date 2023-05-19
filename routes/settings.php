<?php

use App\Http\Livewire\Settings\{
    Settings,
    Immunization,
    Frequency,
    Notifications
};

use App\Http\Livewire\FileManager\{
    Index,
    Settings as FileMAnagerSettings,
};

Route::middleware('auth')->group(function ($route) {
    $route->get('/immunization', Immunization::class)
        ->name('immunization');
    $route->get('/settings', Settings::class)
        ->name('settings');
    $route->get('/frequency', Frequency::class)
        ->name('frequency');
    $route->get('/file-manager', Index::class)
        ->name('file-manager');
    $route->get('/file-manager-settings/{documents}', FileMAnagerSettings::class)
        ->name('file-manager.settings');
    $route->get('/notifications', Notifications::class)
        ->name('notifications');
});
