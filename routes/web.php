<?php

use App\Http\Livewire\Dashboard;
use App\Http\Livewire\FileManager;
use App\Http\Livewire\Guest\{
    CreateUser,
    UpdatePassword
};

use Illuminate\Support\Facades\Route;
use App\Http\Livewire\Users\{Index, Show};


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::middleware('auth')->group(function ($route) {
    // $route->get('/', Dashboard::class);
    $route->get('/', Index::class)->name('users.list');
    $route->get('/dashboard', Dashboard::class)->name('dashboard');
    // $route->get('/file-manager', FileManager::class)->name('file-manager');
});

Route::get('/create-user', CreateUser::class)
        ->name('create-user');

Route::get('/update-password/{token}', UpdatePassword::class)
        ->name('update-password');

Route::get('/offline', function () {
    return view('offline');
})->name('offline');

Route::get('phpmyinfo', function () {
    phpinfo();
})->name('phpmyinfo');
