@extends('app')

@section('title', 'Tambah Promo Paket')

@section('content')

    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-12 order-md-1 order-last">
                    <a href="{{ url('promo/paket') }}">
                        <h5> <i class="fa fa-arrow-left"></i> Kembali </h5>
                    </a>
                </div>
            </div>
        </div>
        <center>
            <h3> Paket </h3>
            <h4 class="text-subtitle text-muted">
                Buatlah paket promo menarik untuk memikat <br> pelanggan Anda
            </h4>
        </center>
        <section class="section">
            <div class="row" style="margin-top: 15px;">
                <div class="col-md-3"></div>
                <div class="col-md-6">
                    <a href="{{ url('promo/paket/getY') }}">
                        <div class="card" style="margin-bottom: 15px;">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center items">
                                    <div class="d-flex flex-row">
                                        <div style="margin-left:10px;">
                                            <span class="h5"> <b> Buy X Get Y </b> </span>
                                            <p class="text-subtitle text-muted" style="font-size: 18px;"> <b> Beri diskon/harga coret pada menu dan <br> tingkatkan volume transaksi. </b>
                                            </p>
                                        </div>
                                    </div>
                                    <div class="d-flex flex-row align-items-center">
                                        <i class="fa fa-caret-right fa-2x" style="color: #708c98;opacity:0.5"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                    <a href="{{ url('promo/paket/discY') }}">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center items">
                                    <div class="d-flex flex-row">
                                        <div style="margin-left:10px;">
                                            <span class="h5"> <b> Buy X DISC Y </b> </span>
                                            <p class="text-subtitle text-muted" style="font-size: 18px;"> <b> Beri diskon
                                                    nominal dalam nominal untuk <br> tingkatkan pembelian pelanggan. </b>
                                            </p>
                                        </div>
                                    </div>
                                    <div class="d-flex flex-row align-items-center">
                                        <i class="fa fa-caret-right fa-2x" style="color: #708c98;opacity:0.5"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                    <div class="col-md-3"></div>
                </div>
        </section>
    </div>
@endsection
