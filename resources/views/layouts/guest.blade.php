<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

@include('admin.partials.head')

<body>
<div class="main-wrapper main-wrapper-1" id="app">
    <!-- Main Content -->
    <div>
        <!-- Page Content -->
        @yield('content')
    </div>
</div>

@include('admin.partials.script')
@include('admin.partials.notif')
</body>

</html>
