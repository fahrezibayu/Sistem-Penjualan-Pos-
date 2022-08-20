@php
$profile = DB::table('tbl_profile_app')->first();
@endphp
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> @yield('title') | {{ $profile->nama_aplikasi }} </title>

    @include('layout.head')
</head>

<body>
    <div id="app">
        <div id="main" class="layout-horizontal">
            @include('layout.header_pos')
            <div class="content-wrapper container">
                @yield('content')
            </div>
            @include('layout.footer_pos')
        </div>
    </div>
</body>

</html>
