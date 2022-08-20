@extends('app')

@section('title', ' Setting Aplikasi ')

@section('content')
    <div class="row">
        <div class="col-12 col-lg-12">

            <div class="page-heading">
                <h3> @yield('title') </h3> <span class="text-muted"> Anda dapat merubah profil aplikasi. </h5>
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
                            @if ($profile->photo == '')
                                <img src='{{ asset('assets/images/logo/logo_mazer.png') }}' alt='Logo'
                                    class='rounded-pill img-thumbnail'>
                            @else
                                <img src='{{ asset('assets/images/logo') }}/{{ $profile->photo }}' alt='Logo'
                                    class='rounded-pill img-thumbnail'>
                            @endif
                            {{-- <img src="" class="rounded-pill img-thumbnail" /> --}}
                        </div>
                        <form action="{{ url('setting/apps/update') }}" method="post" enctype="multipart/form-data" autocomplete="off">
                            @csrf
                            <div class="col-12">
                                <div class="form-group">
                                    <label>Nama Aplikasi</label>
                                    <input type="text" value="{{ $profile->nama_aplikasi }}" name="nama_aplikasi"
                                        class="form-control" placeholder="Nama Aplikasi">
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label>Nama Pembuat</label>
                                    <input type="text" value="{{ $profile->nama }}" name="nama" class="form-control"
                                        placeholder="Nama Pemilik">
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label>Logo</label>
                                    <input type="file" class="form-control" name="file">
                                    <input type="hidden" class="form-control" name="file_l" value="{{ $profile->photo }}">
                                </div>
                            </div>

                    </div>
                    <div class="card-footer">
                        <div class="hstack gap-1">
                            <button class="btn btn-primary ms-auto" type="submit"> Terapkan </button>
                        </div>
                    </div>
                    </form>
                </div>
            </div>

            <div class="col-md-6">
                <div class="row">
                    <div class="col-6 col-lg-6 col-md-6">
                        <div class="card">
                            <div class="card-body px-3 py-4-5">
                                <div class="row">
                                    <div class="col-4 col-md-3">
                                        <div class="stats-icon green">
                                            <i class="fa fa-smile-o"></i>
                                        </div>
                                    </div>
                                    <div class="col-8 col-md-8">
                                        <h6 class="text-muted font-semibold"> Kinerja </h6>
                                        <h6 class="font-extrabold mb-0"> Sangat Bagus </h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-6 col-lg-6 col-md-6">
                        <div class="card">
                            <div class="card-body px-3 py-4-5">
                                <div class="row">
                                    <div class="col-4 col-md-3">
                                        <div class="stats-icon purple">
                                            <i class="fa fa-star text-warning"></i>
                                        </div>
                                    </div>
                                    <div class="col-8 col-md-8">
                                        <h6 class="text-muted font-semibold"> Status </h6>
                                        <h6 class="font-extrabold mb-0"> Berjalan </h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- VISI --}}
                    <div class="col-md-12 mb-4">
                        <h4>Visi</h4>
                        <span> Menjadi sistem aplikasi backoffice dan point of sale untuk keperluan kerja praktek </span>
                    </div>

                    {{-- MISI --}}
                    <div class="col-md-12">
                        <h4>Misi</h4>
                        <ol>
                            <li> Menyelesaikan tugas kerja praktek </li>
                            <li> Agar bisa langsung lanjut ke tugas akhir </li>
                        </ol>
                    </div>
                </div>
            </div>

        </section>
    </div>
@endsection
