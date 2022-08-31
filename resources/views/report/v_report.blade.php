@extends('app')

@section('title', 'Laporan Transaksi')

@section('content')

    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-12 order-md-1 order-last">
                    <h5> @yield('title') </h5>
                    <h6 class="text-subtitle text-muted">
                        Silahkan pilih laporan transaksi berdasarkan jenis - jenis dibawah yang ingin Anda lihat.
                    </h6>
                </div>
            </div>
        </div>
        <section class="section mt-5">
            <div class="row">
                <div class="col-md-4">
                    <a href="{{ url('report/pos') }}">
                        <div class="card" style="margin-bottom: 20px;">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center items">
                                    <div class="d-flex flex-row">
                                        <div style="margin-left:10px;">
                                            <span class="h5"> <b> Penjualan </b> </span>
                                        </div>
                                    </div>
                                    <div class="d-flex flex-row align-items-center">
                                        <i class="fa fa-caret-right fa-2x" style="color: #708c98;opacity:0.5"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-md-4">
                    <a href="{{ url('report/FastSlow') }}">
                        <div class="card" style="margin-bottom: 20px;">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center items">
                                    <div class="d-flex flex-row">
                                        <div style="margin-left:10px;">
                                            <span class="h5"> <b> Fast and Slow Moving </b> </span>
                                        </div>
                                    </div>
                                    <div class="d-flex flex-row align-items-center">
                                        <i class="fa fa-caret-right fa-2x" style="color: #708c98;opacity:0.5"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-md-4">
                    <a href="{{ url('report/edc') }}">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center items">
                                    <div class="d-flex flex-row">
                                        <div style="margin-left:10px;">
                                            <span class="h5"> <b> Mesin EDC </b> </span>
                                        </div>
                                    </div>
                                    <div class="d-flex flex-row align-items-center">
                                        <i class="fa fa-caret-right fa-2x" style="color: #708c98;opacity:0.5"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                </div>
                </a>
            </div>
        </section>
    </div>
@endsection
