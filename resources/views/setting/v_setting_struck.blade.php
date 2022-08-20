@extends('app')

@section('title', 'Sistem Aplikasi')

@section('content')
    <style type="text/css">
        @page {
            size: auto;
            margin: 5mm;
        }

        #text-resize {
            font-size: small;
        }

        .w-30 {
            max-width: 110%;
        }

        .img-resize {
            width: 25%;
            border-radius: 50%;
        }
    </style>
    <div class="page-heading">
        <section class="section">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3> Pengaturan Struck </h3>
                    <p class="text-subtitle text-muted"> Disini Anda dapat merubah tampilan struck. </p>
                    <div class="card">
                        <div class="card-body">
                            <form action="{{ url('setting/struck/update') }}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-md-12 mb-3">
                                        <h6> Nama Outlet </h6>
                                        <input type="text" name="nama_outlet" id="nama_outlet"
                                            value="{{ $struck->nama_outlet }}" required class="form-control">
                                    </div>
                                    <div class="col-md-12 mb-3">
                                        <h6> Alamat </h6>
                                        <input type="text" name="alamat" id="alamat" value="{{ $struck->alamat }}"
                                            required class="form-control">
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <h6> Kota </h6>
                                        <input type="text" name="kota" id="kota" value="{{ $struck->kota }}"
                                            required class="form-control">
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <h6> Kodepos </h6>
                                        <input type="number" name="kodepos" id="kodepos" value="{{ $struck->kodepos }}"
                                            required class="form-control">
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <h6> Telp </h6>
                                        <input type="text" name="telp" id="telp" value="{{ $struck->telp }}"
                                            class="form-control">
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <h6> Telp </h6>
                                        <input type="text" name="nohp" id="nohp" value="{{ $struck->nohp }}"
                                            class="form-control">
                                    </div>
                                    <div class="col-md-12 mb-3">
                                        <h6> Catatan </h6>
                                        <input type="text" name="catatan" id="catatan" value="{{ $struck->catatan }}"
                                            class="form-control">
                                    </div>
                                    <div class="col-md-16 mb-3">
                                        <h6> Footer </h6>
                                        <input type="text" name="footer" id="footer" value="{{ $struck->footer }}"
                                            required class="form-control">
                                    </div>
                                    <div class="col-md-16 mb-3">
                                        <h6> Upload Foto </h6>
                                        <input type="hidden" name="file_l" id="file_l" value="{{ $struck->logo }}" required class="form-control">
                                        <input type="file" name="file" id="file" class="form-control">
                                    </div>
                                </div>
                        </div>
                        <div class="card-footer">
                            <div class="hstack gap-1">
                                <button class="btn btn-success ms-auto" type="submit"> Terapkan </button>
                            </div>
                        </div>
                        </form>
                    </div>
                </div>
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <div class="card">
                        <div class="card-body">
                            <div id="text-resize" class="container w-30 mt-5 mb-5">
                                <div class="d-flex flex-column align-items-center">
                                    @if ($struck->logo == '')
                                        <img src="https://ui-avatars.com/api?name={{ $struck->nama_outlet }}&color=7FCF5&background=EBF4FF"
                                            class="img-resize" alt="logo-toko">
                                    @else
                                        <img src="{{ asset('assets/images/logo/struck') }}/{{ $struck->logo }}"
                                            class="img-resize" alt="logo-toko">
                                    @endif
                                    <h5 class="mt-3"> {{ $struck->nama_outlet }} </h5>
                                    <span class="text-center mb-4"> {{ $struck->alamat }} <br />
                                        {{ $struck->kota . ', ' . $struck->kodepos }} </span>
                                </div>
                                <br>
                                <div class="hstack gap-2">
                                    <div>
                                        <i class="bi bi-phone"> {{ $struck->nohp }} </i>
                                    </div>
                                    <div class="ms-auto">
                                        <i class="bi bi-telephone"> {{ $struck->telp }} </i>
                                    </div>
                                </div>
                                <hr />

                                <!-- Sub Head -->
                                <div class="row row-cols-2 g-1">
                                    <div class="col">Sen, 11 Aug 2022</div>
                                    <div class="col text-end">15:30</div>

                                    <div class="col">Nomor Bill</div>
                                    <div class="col text-end">AWE239</div>

                                    <div class="col">Kasir</div>
                                    <div class="col text-end">Nama Kasir</div>

                                    <div class="col">Pelanggan</div>
                                    <div class="col text-end">Fahrezi Bayu</div>
                                </div>

                                <hr />

                                <!-- Body -->
                                <!-- Body -->
                                <div class="row">
                                    <div class="col-12 h6">
                                        Milk Tea
                                    </div>
                                    <div class="col-8 text-end">
                                        1x25.000
                                    </div>
                                    <div class="col-4 text-end fs-6">
                                        Rp25.000
                                    </div>

                                    <!-- Modifier/Penambahan  -->
                                    {{-- <div class="d-flex flex-column mb-3">
                                        <em>Hot</em>
                                        <em>
                                            <div class="d-flex">
                                                <div class="flex-fill">+Sugar </div>
                                                (Rp2.000)
                                            </div>
                                        </em>
                                    </div> --}}
                                    <!-- Modifier/Penambahan -->

                                    <div class="col-12 h6">
                                        Nasi Goreng
                                    </div>
                                    <div class="col-8 text-end">
                                        3x12.000
                                    </div>
                                    <div class="col-4 text-end fs-6">
                                        Rp36.000
                                    </div>
                                </div>

                                <hr />

                                <!-- Body 2 -->
                                <div class="row row-cols-2 g-1">
                                    <div class="col">Sub Total</div>
                                    <div class="col text-end">Rp63.000</div>

                                    <div class="col">Pajak(10%)</div>
                                    <div class="col text-end">Rp10.000</div>
                                </div>

                                <hr />

                                <!-- Body 2 -->
                                <div class="row row-cols-2 g-1">
                                    <div class="col">Bayar(cash)</div>
                                    <div class="col text-end">Rp75.000</div>

                                    <div class="col fs-6 fw-bold">Total</div>
                                    <div class="col text-end fs-6 fw-bold">Rp73.000</div>


                                    <div class="col">Kembalian</div>
                                    <div class="col text-end">Rp2.000</div>
                                </div>

                                <hr />

                                <!-- Footer -->
                                <div class="d-flex flex-column">
                                    <div>Catatan:</div>
                                    <div class="ms-2"> {{ $struck->catatan }} </div>

                                    <div class="mt-4 text-center">
                                        {{ $struck->footer }}
                                    </div>

                                    <div class="mt-4 text-center text-muted">
                                        &copy; {{ $profile->nama }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
