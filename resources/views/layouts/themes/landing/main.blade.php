<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
    <head>
        @include('layouts.partials.landing.head')
    </head>
    <body>
        @yield('content')
        @include('layouts.partials.landing.script')
    </body>
</html>


