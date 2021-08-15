<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

        <!-- Styles -->
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">

        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}" defer></script>
        @livewireStyles
    </head>
    <body class=" font-sans antialiased ">
        <div>
             @include('layouts.navigation')
        </div>

        {{--Please use the same breakpoint  in the primary navigation menu--}}
        <div class=" w-full  xl:w-10/12 2xl:w-8/12 3xl:w-6/12 mx-auto  ">
           
              
            @include('layouts.banner')
            @include('layouts.slogan')
             @include('layouts.sub-navigation') 

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
        </div>
        @livewireScripts
        @livewire('livewire-ui-modal')
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10">
    </script>
        <x-livewire-alert::scripts />
    </body>
</html>
