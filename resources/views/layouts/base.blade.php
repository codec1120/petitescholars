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
        <link
            rel="shortcut icon"
            href="{{ asset('static/brand/favicon.ico') }}"
            type="image/x-icon"
        >
        <link
            rel="icon"
            href="{{ asset('static/brand/favicon.ico') }}"
            type="image/x-icon"
        >

         <!-- FilePond -->
        <link href="https://unpkg.com/filepond/dist/filepond.css" rel="stylesheet">
        <link href="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.css" rel="stylesheet">
        <link href="https://unpkg.com/filepond-plugin-file-poster/dist/filepond-plugin-file-poster.css" rel="stylesheet">

        @bukStyles(true)
        @livewireStyles
        @livewireChartsScripts
        <!-- Scripts -->
        <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.6.0/dist/alpine.js" defer></script>

       
        <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/slim-select/1.27.0/slimselect.min.css">

        <script src="https://cdn.jsdelivr.net/npm/pace-js@latest/pace.min.js"></script>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/pace-js@latest/pace-theme-default.min.css">
        <link rel="stylesheet" href="{{ asset('css/pace.css') }}">

        <link rel="stylesheet" href="https://pagecdn.io/lib/font-awesome/5.10.0-11/css/all.min.css" integrity="sha256-p9TTWD+813MlLaxMXMbTA7wN/ArzGyW/L7c5+KkjOkM=" crossorigin="anonymous">
    </head>
    <body class="font-sans antialiased">
        <!-- Desktop -->
        <div class="hidden md:block min-h-screen bg-gray-100">
            <div class="block w-full border shadow bg-white">
            <x-notification />
                <x-navbar-content/>
                <div class="block md:flex">
                    <div>
                        <x-side-bar-menu/>
                    </div>
                    <div class="w-full">
                        <div class="w-full">
                            {{ $slot }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- mobile -->
        <div class="block md:hidden w-full border shadow bg-white">
            <x-notification />
            <x-mobile-nav-bar>
                {{ $slot }}
            </x-mobile-nav-bar>
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

        <x-scripts.service-worker />
    </body>
</html>