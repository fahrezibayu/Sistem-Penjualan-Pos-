@php
$profile = DB::table('tbl_profile_app')->first();
@endphp
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title> @yield('title') | {{ $profile->nama_aplikasi }} </title>

    @include('layout.head')
</head>

<body>
    <div id="app">
        <!-- Aside -->
        @include('layout.aside')
        <!-- End Aside -->
        <div id="main" class='layout-navbar'>
            @include('layout.header')
            <div id="main-content">
                @yield('content')
                <!-- Footer -->
                @include('layout.footer')
                <!-- End Footer -->
            </div>
        </div>
    </div>

</body>

</html>
