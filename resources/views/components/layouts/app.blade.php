<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="rtl">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="{{asset('css/main.css')}}">
        <title>{{ $title ?? 'Page Title' }}</title>
        @vite('resources/css/app.css')
    </head>
   
    <body class="container mx-auto px-1 lg:px-0">

      

        <livewire:header>
        {{ $slot }}
        <livewire:footer>

        
    </body>
</html>
