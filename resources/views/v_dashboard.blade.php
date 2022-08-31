@extends('app')

@section('title', 'Dashboard')

@section('content')
    <style>
        .scrollabel {
            overflow: scroll;
            overflow-x: hidden;
            overflow-y: visible;
            height: 350px;
        }
        .scrollabel::-webkit-scrollbar {
            width: 10px;
        }
    </style>
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
                                        <div class="col-3 col-md-3">
                                            <div class="stats-icon purple">
                                                <i class="fa fa-money"></i>
                                            </div>
                                        </div>
                                        <div class="col-9 col-md-9">
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
                            <ul class="list-group">
                                <div class="scrollabel mt-1">
                                    @foreach ($leadership as $row)
                                        <div class="row">
                                            <div class="col-8">
                                                <div class="d-flex">
                                                    @if ($row->foto == null)
                                                        <img src="https://ui-avatars.com/api?name={{ $row->nama_barang }}&color=FFF&background=6C757D"
                                                            alt="" width="70px" height="70px;"
                                                            style="border-radius:20px;">
                                                    @else
                                                        <img src="{{ asset('assets/images/product/') }}/{{ $row->foto }}"
                                                            width="70px" height="70px;" style="border-radius:20px;"
                                                            alt="">
                                                    @endif
                                                    <h6 style="margin-left: 10px;font-size: 14px" class="mt-3">
                                                        {{ $row->nama_barang }} <br> <span style="font-size: 13px;"> Terjual {{ $row->total_penjualan }} </span> </h6>
                                                </div>
                                            </div>
                                            <div class="col-4">
                                                @if ($row->number == 1)
                                                    <i class="bi bi-trophy text-warning mt-4" style="float: right"></i>
                                                @endif
                                                @if ($row->number == 2)
                                                    <i class="bi bi-trophy mt-4" style="color:silver;float: right"></i>
                                                @endif
                                                @if ($row->number == 3)
                                                    <i class="bi bi-trophy mt-4" style="color:#bf8970;float: right"></i>
                                                @endif
                                                @if ($row->number > 3)
                                                    {{ $row->number }}
                                                @endif
                                            </div>
                                        </div>
                                        <hr>
                                        {{-- <li class="list-group-item d-flex justify-content-between align-items-center">
                                        <span> {{ $row->nama_barang }} </span>
                                        <span> {{ $row->total_penjualan }} </span>
                                        @if ($row->number == 1)
                                            <i class="bi bi-trophy text-warning"></i>
                                        @endif
                                        @if ($row->number == 2)
                                            <i class="bi bi-trophy" style="color:silver"></i>
                                        @endif
                                        @if ($row->number == 3)
                                            <i class="bi bi-trophy" style="color:#bf8970"></i>
                                        @endif
                                    </li> --}}
                                    @endforeach
                                </div>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
