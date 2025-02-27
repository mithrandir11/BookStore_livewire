<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="rtl">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="{{custom_asset('css/main.css')}}">
        <title>{{ $title ?? 'Page Title' }}</title>
      

        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css"/>
        <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

        @vite('resources/css/app.css')
       
        {{-- <link rel="stylesheet" href="{{asset('build/assets/app-CnbbZy3W.css')}}">
        <script src="{{asset('build/assets/app-z-Rg4TxU.js')}}"></script> --}}
    </head>
   
    <body class="container mx-auto px-1 lg:px-0">

      

        <livewire:header>
        {{ $slot }}
        <livewire:footer>
        
        

        
    </body>
</html>
