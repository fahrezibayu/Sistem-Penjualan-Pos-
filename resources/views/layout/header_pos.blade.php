<header class="mb-5">
    <div class="header-top">
        <div class="container">
            <div class="logo">
                <a href="index.html">
                    @if ($profile->photo == '')
                        <img src='{{ asset('assets/images/logo/logo_mazer.png') }}' alt='Logo'
                            style="width:35%; height:35%;">
                    @else
                        <img src='{{ asset('assets/images/logo') }}/{{ $profile->photo }}' alt='Logo'
                            style="width:35%; height:35%;">
                    @endif
                </a>
            </div>
            <div class="header-top-right">

                <div class="dropdown">
                    <a href="#" id="topbarUserDropdown"
                        class="user-dropdown d-flex align-items-center dropend dropdown-toggle "
                        data-bs-toggle="dropdown" aria-expanded="false">
                        <div class="avatar avatar-md2">
                            @if (Auth::user()->foto == null)
                                <img src='https://ui-avatars.com/api?name={{ Auth::user()->name }}&color=7FCF5&background=EBF4FF'
                                    alt='avtar img holder'>
                            @else
                                <img src='{{ asset('assets/images/profile') }}/{{ Auth::user()->foto }}'
                                    alt='avtar img holder'>
                            @endif
                        </div>
                        <div class="text">
                            <h6 class="user-dropdown-name"> {{ Auth::user()->name }} </h6>
                            <p class="user-dropdown-status text-sm text-muted"> {{ Auth::user()->role }} </p>
                        </div>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end shadow-lg" aria-labelledby="topbarUserDropdown">
                        <li><a class="dropdown-item" href="#"> Profile </a></li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li><a class="dropdown-item" href="{{ url('/sign_out') }}"> Keluar </a></li>
                    </ul>
                </div>

                <!-- Burger button responsive -->
                <a href="#" class="burger-btn d-block d-xl-none">
                    <i class="bi bi-justify fs-3"></i>
                </a>
            </div>
        </div>
    </div>
    <nav class="main-navbar">
        <div class="container">
            <ul class="justify-content-center">
                <li class="menu-item">
                    <a href="{{ url('/pos') }}" class='menu-link'>
                        <i class="fa fa-shopping-cart"></i>
                        <span> POS Penjualan </span>
                    </a>
                </li>
                <li class="menu-item  ">
                    <a href="{{ url('/pos/report') }}" class='menu-link'>
                        <i class="fa fa-book"></i>
                        <span> Laporan Penjualan </span>
                    </a>
                </li>
                <li class="menu-item  ">
                    <a href="{{ url('/pos/profile') }}" class='menu-link'>
                        <i class="fa fa-user"></i>
                        <span> Profile </span>
                    </a>
                </li>
                <li class="menu-item  ">
                    <a href="{{ url('/sign_out') }}" class='menu-link'>
                        <i class="fa fa-door-closed"></i>
                        <span> Keluar </span>
                    </a>
                </li>
            </ul>
        </div>
    </nav>

</header>
