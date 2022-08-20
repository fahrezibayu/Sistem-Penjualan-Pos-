@extends('app')

@section('title', 'Pos Penjualan')

@section('content')
    <style>
        .category.aktif,
        .category:hover {
            background-color: #435EBE;
            color: white;
        }

        .category {
            background-color: #6C757D;
            color: white;
        }

        .product {
            cursor: pointer;
            transition: transform .2s;
        }

        .product:hover {
            transform: scale(1.1);
        }

        .category {
            cursor: pointer;
        }

        .garis_verikal {
            border-left: 3px white solid;
            margin-left: 40px;
            margin-top: -20px;
            height: 50px;
        }

        .save_temp {
            cursor: pointer;
        }

        :root {
            --first-color: #fff;
            --second-color: #fff;
            --third-color: #FFE8DF;
            --accent-color: #FF5151;
            --dark-color: #161616;
        }

        /*Tipografia responsive*/
        :root {
            --body-font: 'Open Sans';
            --h1-font-size: 1.5rem;
            --h3-font-size: 1rem;
            --normal-font-size: 0.938rem;
            --smaller-font-size: 0.75rem;
        }

        @media screen and (min-width: 768px) {
            :root {
                --h1-font-size: 2rem;
                --normal-font-size: 1rem;
                --smaller-font-size: 0.813rem;
            }

        }

        .name_product {
            font-family: Nunito;
            font-size: 16px;
        }

        .price_product {
            font-family: Nunito;
            font-size: 13px;
        }

        .price_akhir {
            font-family: Nunito;
            font-size: 15px;
            margin-left: 5px;
            color: #25396f;
            font-weight: bold;
        }

        .coret_harga {
            font-family: Nunito;
            text-decoration: line-through;
        }

        /*-- BASE --*/
        *,
        ::after,
        ::before {
            box-sizing: border-box;
        }

        h1 {
            font-size: var(--h1-font-size);
        }

        img {
            max-width: 100%;
            height: auto;
        }

        a {
            text-decoration: none;
        }

        .cash.aktif,
        .cash:hover {
            background-color: #435EBE;
            color: white;
        }

        .edc.aktif_edc,
        .edc:hover {
            background-color: #435EBE;
            color: white;
        }


        .links span:hover,
        .links span.active {
            color: #435EBE;
        }



        .product {
            cursor: pointer;
            transition: transform .2s;
            display: none;
        }

        .product:hover {
            transform: scale(1.1);
        }

        .category {
            cursor: pointer;
        }

        .update_qty {
            cursor: pointer;
        }

        .delete_item {
            color: gray;
        }

        .delete_item:hover {
            color: red;
        }

        .delete_all {
            cursor: pointer;
            font-weight: bold;
            text-align: center;
        }

        .delete_all:hover {
            color: red;
        }

        .product-details {
            padding: 10px;
        }

        .cart {
            background: #fff;
        }

        .p-about {
            font-size: 12px;
        }

        .table-shadow {
            -webkit-box-shadow: 5px 5px 15px -2px rgba(0, 0, 0, 0.42);
            box-shadow: 5px 5px 15px -2px rgba(0, 0, 0, 0.42);
        }

        .type {
            font-weight: 400;
            font-size: 10px;
        }


        .items {
            /* box-shadow: 5px 5px 4px -1px rgba(0, 0, 0, 0.08); */
            border-radius: 10px;
            transition: transform .2s;
        }

        .items:hover {
            /* -webkit-box-shadow: 5px 5px 4px -1px rgba(0, 0, 0, 0.25); */
            /* transform: scale(1.1);
                                            cursor: pointer; */
        }

        .show {
            display: block;
        }
    </style>
    <div class="page-content">
        <section class="row">
            <div class="col-md-12 col-xs-12 col-lg-6" id="menu">
                <div class="row">
                    <div class="col-md-12 col-xs 12 col-lg-12 mb-1">
                        <div class="form-group position-relative has-icon-right">
                            <input type="text" class="form-control" placeholder="Search" name="search_menu"
                                id="search_menu">
                            <div class="form-control-icon">
                                <i class="bi bi-search"></i>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 col-xs 12 col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <div id="myDIV">
                                    <span class="badge bg-primary category" onclick="filter_menu('all')"> All </span>
                                    @foreach ($category as $row)
                                        <span class="badge category" onclick="filter_menu('{{ $row->id_kategori }}')">
                                            {{ $row->nama_kategori }} </span>
                                    @endforeach
                                    {{-- <span style="float: right; font-size: 20px;" class="links">
                                        <span class="grid btn-view active" data-view="grid-view"> <i class="fa fa-th-large"></i>
                                        </span>
                                        <span class="list btn-view" data-view="list-view"> <i class="fa fa-th-list"></i> </span>
                                    </span> --}}
                                </div>

                                <h6 class="text-center mt-3" id="text_nothing" style="display: none"> Pencarian menu tidak
                                    ditemukan <i class="fa fa-search"></i> </h6>
                                <div class="view_wrap grid-view" id="grid_menu">
                                    <div class="row mt-3" id="list">
                                        @foreach ($merchandise as $row2)
                                            <div class="col-md-3 col-lg-3 col-6 product {{ $row2->id_kategori }}"
                                                onclick='addtocart("{{ $row2->id_barang }}","{{ $row2->nama_barang }}", "1","{{ $row2->harga_barang }}","{{ $row2->foto }}")'>
                                                @if ($row2->foto == '')
                                                    <img src="https://ui-avatars.com/api?name={{ $row2->nama_barang }}&color=FFF&background=6C757D"
                                                        style="border-radius: 20px" height="200px" width="200px">
                                                @else
                                                    <img src="{{ asset('assets/images/product') }}/{{ $row2->foto }}"
                                                        style="border-radius: 20px" height="130px" width="130px">
                                                @endif
                                                <h6 style="font-size: 13px;" class="text-center nama_brg">
                                                    {{ $row2->nama_barang }} </h6>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                                {{-- <div class="menu_kategori"></div> --}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12 col-xs-12 col-lg-6">
                <div class="mt-3 mb-3">
                    <div class="hstack gap-1">
                        <div class="ms-auto">
                            <span class="badge bg-primary save_temp" style="margin-left:10px;margin-right:5px; display:none"
                                id="btn_park" onclick="park()"> Simpan Billing <i class="fa fa-save"></i> </span>
                            <span class="badge bg-success save_temp" data-bs-toggle="modal" data-bs-target="#retrive_modal">
                                Daftar Billing <i class="fa fa-list-ol"></i> </span>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <form class="transaksi" autocomplete="off">
                        <div class="card-header">
                            <h6 class="text-center"> Keranjang <i class="bi bi-cart-fill"></i> </h6>
                        </div>
                        <div class="card-body">
                            <div id="root"></div>
                            <!--scrolling content Modal -->
                            <div class="modal fade" id="exampleModalScrollable" tabindex="-1" role="dialog"
                                aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-scrollable modal-lg" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <i class="fa fa-arrow-left" data-bs-dismiss="modal"
                                                style="cursor: pointer;font-size:20px;"></i>
                                            <center>
                                                <h5 class="mt-3"> Total Bayar : <span class="grandtotal"></span> </h5>
                                            </center>
                                            <button class="btn btn-primary" type="button" onclick="transaksi()"> Bayar <i class="bi bi-cash"></i>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="row">
                                                <center>
                                                    <div class="row">
                                                        <div class="col-md-2 mt-2">
                                                            <h6 class="text-center"> Cash </h6>
                                                        </div>
                                                        <div class="col-md-7">
                                                            <div class="row" style="margin-left: 30px;">
                                                                <div class="col-md-12 mb-2">
                                                                    <div class="row" id="harganya">
                                                                        <div class="col-md-4">
                                                                            <button
                                                                                class="btn btn-outline-primary btn-block cash type1"
                                                                                onclick="change_tunai('1')" type="button">
                                                                                <span class="harga1"></span> </button>
                                                                        </div>
                                                                        <div class="col-md-4">
                                                                            <button
                                                                                class="btn btn-outline-primary btn-block cash type2"
                                                                                onclick="change_tunai('2')" type="button">
                                                                                <span class="harga2"></span> </button>
                                                                        </div>
                                                                        <div class="col-md-4">
                                                                            <button
                                                                                class="btn btn-outline-primary btn-block cash type3"
                                                                                onclick="change_tunai('3')"
                                                                                type="button">
                                                                                Rp
                                                                                50.000 </button>
                                                                        </div>
                                                                        <input type="hidden" class="harga_1">
                                                                        <input type="hidden" class="harga_2">
                                                                        <input type="hidden" class="harga_3"
                                                                            value="50000">
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-12">
                                                                    <input type="text" placeholder="Rp 19.000"
                                                                        name="option_cash" style="margin-right: 40px"
                                                                        id="option_cash" class="form-control">
                                                                    <input type="hidden" name="total" id="total"
                                                                        class="form-control">
                                                                    <input type="hidden" name="kembalian" id="kembalian"
                                                                        value="0" class="form-control">
                                                                    <input type="hidden" name="bayar" id="bayar"
                                                                        class="form-control">
                                                                    <input type="hidden" name="id_penjualan"
                                                                        id="id_penjualan" value="{{ $code }}">
                                                                    <input type="hidden" name="jenis_pembayaran"
                                                                        id="jenis_pembayaran">
                                                                    <input type="hidden" name="id_edc" id="id_edc">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-2">
                                                        </div>
                                                    </div>
                                                </center>
                                            </div>
                                            <center>
                                                <hr style="width: 83%;">

                                            </center>
                                            <div class="row">
                                                <center>
                                                    <div class="row">
                                                        <div class="col-md-2 mt-2">
                                                            <h6 class="text-center"> EDC </h6>
                                                        </div>
                                                        <div class="col-md-7">
                                                            <div class="row" style="margin-left: 30px;">
                                                                <div class="col-md-12 mb-2">
                                                                    <div class="row" id="kartu">
                                                                        @foreach ($edc as $key)
                                                                            <div class="col-md-4 mb-2">
                                                                                <button
                                                                                    class="btn btn-outline-primary btn-block edc"
                                                                                    type="button"
                                                                                    onclick="change_card('{{ $key->id_edc }}')">
                                                                                    {{ $key->nama_edc }} </button>
                                                                            </div>
                                                                        @endforeach
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-2">
                                                        </div>
                                                    </div>
                                                </center>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <span id="hapus_semua"></span>
                        </div>
                    </div>
                    <span id="btn_pembayaran"></span>
            </div>
            </form>
    </div>
    </section>
    <!--scrolling content Modal -->
    <div class="modal fade" id="retrive_modal" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modal-lg" role="document">
            <div class="modal-content" style="background-color: #f8f9fa;">
                <div class="modal-header">
                    <i class="fa fa-arrow-left" data-bs-dismiss="modal" style="cursor: pointer;font-size:20px;"></i>
                    <center>
                        <h5 class="mt-3"> Billing List </h5>
                    </center>
                    <div></div>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <span id="data_park"></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- <i class="fa fa-plus-circle update_qty" onclick="plus_qty('${parsedObj[i].productid}')" style="color:green;margin-right:15px;"></i>    
                                <b style="margin-right:10px;">                                     ${parsedObj[i].productqty} </b> 
                                <i class="fa fa-minus-circle update_qty" onclick="minus_qty('${parsedObj[i].productid}')" style="color:red;"></i>  --}}
@endsection
