@extends('app')

@section('title', 'Dashboard')

@section('content')
    <div class="row">
        <div class="col-12 col-lg-6">

            <div class="page-heading text-center">
                <h4>Hello, {{ Auth::user()->name }} <br> Selamat Beraktivitas <span
                        class="fa fa-heart text-danger pt-2"></span> </h4>
            </div>
        </div>
        @php
            function singkat_angka($n, $presisi = 1)
            {
                if ($n < 900) {
                    $format_angka = number_format($n, $presisi);
                    $simbol = '';
                } elseif ($n < 900000) {
                    $format_angka = number_format($n / 1000, $presisi);
                    $simbol = ' RB';
                } elseif ($n < 900000000) {
                    $format_angka = number_format($n / 1000000, $presisi);
                    $simbol = ' JT';
                } elseif ($n < 900000000000) {
                    $format_angka = number_format($n / 1000000000, $presisi);
                    $simbol = ' M';
                } else {
                    $format_angka = number_format($n / 1000000000000, $presisi);
                    $simbol = ' T';
                }
            
                if ($presisi > 0) {
                    $pisah = '.' . str_repeat('0', $presisi);
                    $format_angka = str_replace($pisah, '', $format_angka);
                }
            
                return $format_angka . $simbol;
            }
        @endphp

        <div class="col-12 col-lg-6">
            <br>
            <form action="{{ url('dashboard/search') }}" method="post">
                @csrf
                <div class="row">
                    <div class="col-md-6 mb-4">
                        <input type="month" name="month" id="month" class="form-control" placeholder="Date Range">
                    </div>
                    <div class="col-md-6 mb-4">
                        <button class="btn btn-primary btn-block" type="submit"> Tampilkan </button>
                    </div>
                </div>
            </form>
        </div>

    </div>
    <div class="page-content">
        <section class="row">
            <div class="col-md-12 col-lg-12 col-12">
                <div class="d-flex justify-content-center mt-4">
                    <div class="row">
                        <div class="col-12 col-lg-4">
                            <div class="card">
                                <div class="card-body px-3 py-4-5">
                                    <div class="row">
                                        <div class="col-4 col-md-3">
                                            <div class="stats-icon red">
                                                <i class="fa fa-tags"></i>
                                            </div>
                                        </div>
                                        <div class="col-8 col-md-8">
                                            <h6 class="text-muted font-semibold"> Kategori </h6>
                                            <h6 class="font-extrabold mb-0"> {{ $category }} </h6>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-12 col-lg-4">
                            <div class="card">
                                <div class="card-body px-3 py-4-5">
                                    <div class="row">
                                        <div class="col-4 col-md-3">
                                            <div class="stats-icon blue">
                                                <i class="fa fa-cutlery "></i>
                                            </div>
                                        </div>
                                        <div class="col-8 col-md-8">
                                            <h6 class="text-muted font-semibold"> Menu </h6>
                                            <h6 class="font-extrabold mb-0"> {{ $merchandise }} </h6>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-12 col-lg-4">
                            <div class="card">
                                <div class="card-body px-3 py-4-5">
                                    <div class="row">
                                        <div class="col-4 col-md-3">
                                            <div class="stats-icon purple">
                                                <i class="fa fa-money"></i>
                                            </div>
                                        </div>
                                        <div class="col-8 col-md-8">
                                            <h6 class="text-muted font-semibold"> Penjualan </h6>
                                            <h6 class="font-extrabold mb-0"> Rp{{ singkat_angka($pos->pendapatan) }} </h6>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-7 col-12">
                <div class="card">
                    <div class="card-header">
                        <h4> Pendapatan Periode </h4>
                    </div>
                    <div class="card-body">
                        <div id="chart"></div>
                    </div>
                </div>
            </div>
            <div class="col-md-5 col-12">
                <div class="card">
                    <div class="card-header">
                        <h4> Menu Favorite <span class="bi bi-star-fill text-warning"></span> </h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover table-lg">
                                <thead>
                                    <tr>
                                        <th>Rank</th>
                                        <th>Nama Menu</th>
                                        <th>Terjual</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <tr>
                                        <td class="col-auto">
                                            <p class=" mb-0">
                                                1
                                            </p>
                                        </td>
                                        <td class="col-4">
                                            <div class="d-flex align-items-center">
                                                <div class="avatar avatar-lg">
                                                    <img src='{{ asset('assets/images/product/BRG001.jpg') }}'
                                                        alt='avtar img holder'>
                                                </div>
                                                <p class=" ms-3 mb-0">
                                                    <b> Ayam Geprek Kremes </b>
                                                </p>
                                            </div>
                                        </td>
                                        <td class="col-auto">
                                            <p class=" mb-0"> 100 Terjual </p>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

    </div>
    </section>
    </div>
@endsection
