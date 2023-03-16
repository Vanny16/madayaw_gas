<!DOCTYPE html>
<html>
<head>
    <style>
        html {
        size: 57mm 50mm;
        font-size: 12px;
        }
    </style>
    @include('layouts.partials.admin.head')
</head>
    <body>
        @yield('content')
        @include('layouts.partials.admin.script')
    </body>
</html>
