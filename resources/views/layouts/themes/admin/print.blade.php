<!DOCTYPE html>
<html>
<head>
    <style>
        @page {
        size: 57mm 50mm;
        }
    </style>
    @include('layouts.partials.admin.head')
</head>
    <body>
        @yield('content')
        @include('layouts.partials.admin.script')
    </body>
</html>
