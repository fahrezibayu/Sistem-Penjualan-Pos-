<link rel="stylesheet" href="{{ asset('assets/css/main/app.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/main/app-dark.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/shared/iconly.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/pages/datatables.css') }}">
{{-- <link rel="stylesheet" href="{{ asset('assets/css/pages/fontawesome.css') }}"> --}}
<link rel="stylesheet" href="{{ asset('assets/css/pages/form-element-select.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/pages/filepond.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/widgets/bootstrap-material-datetimepicker.css') }}" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link href="https://fonts.googleapis.com/css2?family=Nunito:wght@200&display=swap" rel="stylesheet">
<link href='http://fonts.googleapis.com/css?family=Roboto:400,500' rel='stylesheet' type='text/css'>
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
{{-- Token --}}
<meta name="csrf-token" content="{{ csrf_token() }}">

@if ($profile->photo == '')
    <link rel="shortcut icon" href="{{ asset('/assets/images/logo/logo_mazer.png') }}" type="image/x-icon">
@else
    <link rel="shortcut icon" href="{{ asset('/assets/images/logo') }}/{{ $profile->photo }}" type="image/x-icon">
@endif
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>