<!DOCTYPE html>
<html lang="en">
@php
$profile = DB::table('tbl_profile_app')->first();
@endphp

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> {{ $profile->nama_aplikasi }} | Login</title>
    <link rel="stylesheet" href="{{ asset('assets/css/main/app.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/pages/auth.css') }}">
    @if ($profile->photo == '')
        <link rel="shortcut icon" href="{{ asset('assets/images/logo/logo_mazer.png') }}"
            type="image/x-icon">
    @else
        <link rel="shortcut icon" href="{{ asset('assets/images/logo') }}/{{ $profile->photo }}"
            type="image/x-icon">
    @endif
    <!--<link rel="shortcut icon" href="dist/assets/images/logo/favicon.png" type="image/png">-->
</head>

<body>
    <div id="auth">

        <div class="row h-100">
            <div class="col-lg-6 col-12">
                <div id="auth-left" style="padding-top:50px">
                    <!-- <div class="auth-logo">
                <a href="index.html"><img src="assets/images/logo/logo.svg" alt="Logo"></a>
            </div> -->
                    <h1 class="auth-title">Log in.</h1>
                    <p class="auth-subtitle fs-5 mb-4">
                        {{ $profile->nama_aplikasi }}
                    </p>
                    @if ($message = Session::get('gagal'))
                    <div class="alert alert-light-danger color-danger alert-dismissible show fade"><i class="bi bi-exclamation-circle"></i> {{ $message }} </div>
                    @endif
                    <form action="{{ url('/sign_in') }}" method="post" autocomplete="off">
                        @csrf
                        <div class="form-group position-relative has-icon-left mb-4">
                            <input type="text" name="username" required autofocus
                                class="form-control form-control-xl" placeholder="Username">
                            <div class="form-control-icon">
                                <i class="bi bi-person"></i>
                            </div>
                        </div>
                        <div class="form-group position-relative has-icon-left mb-4">
                            <input type="password" name="password" required class="form-control form-control-xl"
                                placeholder="Password">
                            <div class="form-control-icon">
                                <i class="bi bi-shield-lock"></i>
                            </div>
                        </div>
                        <button class="btn btn-primary btn-block btn-lg shadow-lg mt-3">Masuk</button>
                    </form>
                    <div class="text-center mt-5 text-lg fs-6">
                        <div class="text-gray-600">Copyright &copy; 2022<br /> <a href="#" class="font-bold">
                            {{ $profile->nama }}</a>.</div>
                        
                    </div>
                </div>
            </div>

            <div class="col-lg-5 d-none d-lg-block">
                <script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>
                <lottie-player src="https://assets5.lottiefiles.com/packages/lf20_9wpyhdzo.json"
                    background="transparent" speed="1" class="img-fluid mt-5" loop autoplay></lottie-player>
            </div>

        </div>

    </div>
</body>

</html>
