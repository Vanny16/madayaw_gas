<!DOCTYPE html>
<html>
<head>
    @include('layouts.partials.admin.head')
</head>
    <body class="hold-transition sidebar-mini layout-fixed">
        <div class="wrapper">
            @include('layouts.partials.admin.navbar')
            @include('layouts.partials.admin.sidebar')
            @yield('content')
            @include('layouts.partials.admin.footer')
            @include('layouts.partials.admin.controlsidebar')
        </div>
        @include('layouts.partials.admin.script')
    </body>
</html>
