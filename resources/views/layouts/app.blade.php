<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    
    <!-- ckeditor script -->
    <script src="https://cdn.ckeditor.com/ckeditor5/23.0.0/classic/ckeditor.js"></script>
    
    {{-- Tags --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/bootstrap.tagsinput/0.4.2/bootstrap-tagsinput.css">
    
    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/css/app.css'])
</head>
<body>
    <div id="app">
        {{-- header file include --}}
        @include('partials.header')

        <main class="py-4">
            @yield('content')
        </main>
    </div>
    {{-- Jquery library --}}
    <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <!-- <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script> -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    
    {{-- CKEditor --}}
    <!-- <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" crossorigin="anonymous"></script> -->
    

    {{-- Tags --}}
    <script src="https://cdn.jsdelivr.net/bootstrap.tagsinput/0.4.2/bootstrap-tagsinput.min.js"></script>

    @yield('page-script')
    <script>
        $(document).ready(function(){
            $('.alert').fadeOut(3000);
        });
    </script>

</body>
</html>
