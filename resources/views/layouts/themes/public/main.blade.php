<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
    <head>
        @include('layouts.partials.public.head')
    </head>
    <body class="hold-transition">
        <div id="wrapper">
            @include('layouts.partials.public.navbar')
            @yield('content')
        </div>
        @include('layouts.partials.public.script')
    </body>
</html>