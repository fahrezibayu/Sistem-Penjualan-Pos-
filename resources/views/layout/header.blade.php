<header class='mb-3'>
    <!--<div class="alert alert-success " style = "padding-top:5px;padding-bottom:5px"><center>Sistem masih dalam tahap pengembangan v.1</center></div>-->
    <nav class="navbar navbar-expand navbar-light ">
        <div class="container-fluid">
            <a href="#" class="burger-btn d-block">
                <i class="bi bi-justify fs-3"></i>
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    {{-- <li class="nav-item dropdown me-3">
                        <a class="nav-link active dropdown-toggle text-gray-600" href="#"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            <i class='bi bi-bell bi-sub fs-4'></i>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton">
                            <li>
                                <h6 class="dropdown-header">Notifications Tugas Masuk</h6>
                            </li>
                            <span class="notif_header"></span>
                        </ul>
                    </li> --}}
                </ul>
                <div class="dropdown">
                    <a href="#" data-bs-toggle="dropdown" aria-expanded="false">
                        <div class="user-menu d-flex">
                            <div class="user-name text-end me-3">
                                <h6 class="mb-0 text-gray-600"> {{ Auth::user()->name }} </h6>
                                <p class="mb-0 text-sm text-gray-600"> {{ Auth::user()->role }} </p>
                            </div>
                            <div class="user-img d-flex align-items-center">
                                <div class="avatar avatar-lg">
                                    @if (Auth::user()->foto == null)
                                        <img src='https://ui-avatars.com/api?name={{ Auth::user()->name }}&color=7FCF5&background=EBF4FF'
                                            alt='avtar img holder'>
                                    @else
                                        <img src='{{ asset('assets/images/profile') }}/{{ Auth::user()->foto }}'
                                            alt='avtar img holder'>
                                    @endif
                                    <span class="avatar-status bg-success"></span>
                                </div>
                            </div>
                        </div>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton"
                        style="min-width: 11rem;">
                        <li>
                            <h6 class="dropdown-header">Hello, {{ Auth::user()->name }}!</h6>
                        </li>
                        <li><a class="dropdown-item" href="{{ url('setting/profile') }}"><i class="icon-mid bi bi-person me-2"></i>
                                Profil</a></li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li><a class="dropdown-item" href="{{ url('/sign_out') }}"><i
                                    class="icon-mid bi bi-box-arrow-left me-2"></i> Logout</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>
</header>
