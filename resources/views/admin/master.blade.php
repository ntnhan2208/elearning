<!DOCTYPE html>
<html lang="en">
    @include('admin/layouts/header')
    <body>
        @include('admin/layouts/topbar')
        <div class="page-wrapper">
            @include('admin/layouts/sidebar')
            <div class="container-fluid">
                @include('admin/layouts/notification')
                @yield('content')
            </div>
        </div>
    </body>
    @include('admin/layouts/script')
</html>