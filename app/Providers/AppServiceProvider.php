<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;
use Livewire\Component;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Blade::directive('staff', fn () =>  "<?php if(auth()->user()->isStaff()): ?>");
        Blade::directive('endstaff', fn () =>  "<?php endif; ?>");

        Blade::directive('admin', fn () =>  "<?php if(auth()->user()->isAdmin()): ?>");
        Blade::directive('endadmin', fn () =>  "<?php endif; ?>");

        Component::macro('notify', function ($type, $message) {
            $this->dispatchBrowserEvent('notify', [
                'type' => $type,
                'message' => $message
            ]);
        });
    }
}
