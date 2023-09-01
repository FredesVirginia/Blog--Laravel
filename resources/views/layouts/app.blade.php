<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="@yield('meta-description' , 'Default meta Description')">

        <title> Jonh Clein @yield('title')</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

        <!-- Styles -->
        @vite(['resources/css/app.scss'  , 'resources/js/app.js'])
    </head>
    <body class="antialiased bg-slate-100 dark:bg-slate-900">
        @include('partials.navigation')
        <!-- El nombre content, se utiliza por convecion jiji -->
            
        @if(session('status'))
            {{session('status')}}
        @endif
        @yield('content')
    </body>
</html>