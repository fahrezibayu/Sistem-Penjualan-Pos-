@extends('app')

@section('title', ' Profile Anda ')

@section('content')
    <div class="row">
        <div class="col-12 col-lg-12">

            <div class="page-heading">
                <h3> @yield('title') </h3> <span class="text-muted"> Anda dapat merubah profil anda. </h5>
            </div>
        </div>
    </div>
    <div class="page-content">
        <section class="row">

            <div class="col-12 col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h4>Informasi</h4>
                    </div>
                    <div class="card-body">
                        <div class="d-flex justify-content-center mb-4">
                            @if (Auth::user()->foto == '')
                                <img src='https://ui-avatars.com/api?name={{ Auth::user()->name }}&color=7FCF5&background=EBF4FF''
                                    alt='Foto Profile' class='rounded-pill img-thumbnail'>
                            @else
                                <img src='{{ asset('assets/images/profile') }}/{{ Auth::user()->foto }}' alt='Foto Profile'
                                    style="border-radius:10%;width:50%;">
                            @endif
                            {{-- <img src="" class="rounded-pill img-thumbnail" /> --}}
                        </div>
                        <form action="{{ url('setting/profile/update') }}" method="post" enctype="multipart/form-data"
                            autocomplete="off">
                            @csrf
                            <div class="col-12">
                                <div class="form-group">
                                    <label>Nama Pengguna</label>
                                    <input type="hidden" name="id" id="id" value="{{ Auth::user()->id }}">
                                    <input type="text" value="{{ Auth::user()->name }}" name="nama"
                                        class="form-control" placeholder="Input with icon left">
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label>Username</label>
                                    <input type="text" value="{{ Auth::user()->username }}" name="username"
                                        class="form-control" placeholder="Input with icon left">
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label>Logo</label>
                                    <input type="file" class="form-control" name="foto">
                                    <input type="hidden" class="form-control" name="foto_l"
                                        value="{{ Auth::user()->foto }}">
                                </div>
                            </div>

                    </div>
                    <div class="card-footer">
                        <div class="hstack gap-1">
                            <div class="ms-auto">
                                <a href="{{ url('setting/profile/delete_photo', Auth::user()->id) }}">
                                    <button type="button" class="btn btn-danger me-1 mb-1"> Hapus Foto Profile</button>
                                </a>
                                <button class="btn btn-primary" type="submit"> Update Profile </button>
                            </div>
                        </div>
                    </div>
                    </form>
                </div>
            </div>

            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12">
                                <div class="alert alert-success show fade" id="alert_password">
                                    <div class="alert-body">
                                        <center>
                                            Yey! Password berhasil di perbarui.
                                        </center>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 col-12">
                                <h6> Password <code> * Max 12 Digit </code> </h6>
                                <div class="form-group">
                                    <input type="password" required name="password" id="password" maxlength="12"
                                        class="form-control" placeholder="Masukkan password...">
                                </div>
                            </div>
                            <div class="col-md-12 col-12">
                                <h6> Ulangi Password </h6>
                                <div class="form-group">
                                    <input type="password" oninput="checkPassword()" required name="password2"
                                        id="password2" maxlength="12" class="form-control" placeholder="Ulangi password...">
                                </div>
                            </div>
                            <div class="col-12 d-flex justify-content-end">
                                <button type="button" onclick="_password()" id="simpan"
                                    class="btn btn-primary me-1 mb-1">
                                    Update Password </button>
                                <!-- <button type="reset" class="btn btn-light-secondary me-1 mb-1">Reset</button> -->
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
