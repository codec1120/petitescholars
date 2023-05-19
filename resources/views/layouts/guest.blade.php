<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        @include('includes.pwa')

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

        <!-- Styles -->
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">

        <!-- Scripts -->
        <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.2.1/dist/alpine.js" defer></script>

        @bukStyles(true)
        @livewireStyles
    </head>
    <body>
        <div class="font-sans text-gray-900 antialiased">
            {{ $slot }}
        </div>
        @stack('modals')
        @livewireScripts
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
        <x-livewire-alert::scripts />
        @bukScripts(true)

         <!-- Filepond -->
        <script src="https://unpkg.com/filepond-plugin-file-poster/dist/filepond-plugin-file-poster.js"></script>
        <script src="https://unpkg.com/filepond-plugin-file-validate-type/dist/filepond-plugin-file-validate-type.js"></script>
        <script src="https://unpkg.com/filepond-plugin-file-validate-size/dist/filepond-plugin-file-validate-size.js"></script>
        <script src="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.js"></script>
        <script src="https://unpkg.com/filepond-plugin-file-rename/dist/filepond-plugin-file-rename.js"></script>
        <script src="https://unpkg.com/filepond/dist/filepond.js"></script>

        <!-- app.js -->
        <script src="{{ mix('js/app.js') }}"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/slim-select/1.27.0/slimselect.min.js"></script>

        <script src="https://cdn.jsdelivr.net/npm/pace-js@latest/pace.min.js"></script>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/pace-js@latest/pace-theme-default.min.css">
        <link rel="stylesheet" href="{{ asset('css/pace.css') }}">
        
        <x-scripts.service-worker />
    </body>
</html>
