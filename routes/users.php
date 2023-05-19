<?php

use App\Http\Livewire\Users\{Index, Show};

Route::middleware('auth')->group(function ($route) {
    $route->prefix('users')->group(function ($route) {
        $route->get('/list', Index::class)->name('users.index');
        $route->get('/{user}', Show::class)->name('users.show');
    });
});
