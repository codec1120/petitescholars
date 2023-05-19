<?php

use App\Http\Livewire\Reports\Index;

Route::middleware('auth')->group(function ($route) {
    $route->get('/', Index::class)
        ->name('reports');
});