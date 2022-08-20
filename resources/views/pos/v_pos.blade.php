<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Pos</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    {{-- Token --}}
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;700&display=swap');
        @import url("https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css");

        body {
            font-family: 'Poppins';
            background-color: #F6F8FD;
        }

        .product {
            cursor: pointer;
        }

        .category {
            cursor: pointer;
        }

        .category:hover {
            background-color: #435EBE;
            color: white;
        }

        .show {
            display: block;
        }

        .hide {
            display: none;
        }

        .hapus_all {
            cursor: pointer;
            color: #6c757d;
        }

        .hapus_all:hover {
            color: red;
        }

        .text-resize {
            font-size: 15.5px;
        }

        .text-resize-2 {
            font-size: 14px;
        }

        .text-resize-3 {
            font-size: 12px;
        }


        .bg-light-primary {
            background-color: #ebf3ff;
        }

        .bg-light-success {
            background-color: #d2ffe8;
        }

        .bg-light-warning {
            background-color: #fffdd8;
        }

        .bg-light-danger {
            background-color: #ffdede;
        }

        .scrollabel {
            overflow: scroll;
            overflow-x: hidden;
            overflow-y: visible;
            height: 450px;
        }

        .scroll_transaksi {
            overflow: scroll;
            height: 210px;

        }

        .scroll_category {
            overflow-x: auto;
        }

        .scroll_category::-webkit-scrollbar {
            width: 10px;
        }

        .scroll_transaksi::-webkit-scrollbar {
            width: 10px;
        }

        .scrollabel::-webkit-scrollbar {
            width: 10px;
        }

        .f1-steps {
            overflow: hidden;
            position: relative;
            margin-top: 20px;
            /* margin-left: 53px; */
        }


        .f1-step {
            position: relative;
            float: left;
            width: 50%;
            padding: 0 5px;
        }

        .f1 fieldset {
            display: none;
            text-align: left;
        }

        #calculator {
            width: 100%;
            height: 510px;
            margin: 0 auto;
            top: -15px;
            position: relative;
        }

        #result {
            height: 120px;
        }

        #history {
            text-align: right;
            height: 20px;
            margin: 0 20px;
            padding-top: 20px;
            font-size: 15px;
            color: #919191;
        }

        #output {
            text-align: right;
            height: 60px;
            margin: 10px 20px;
            font-size: 30px;
        }

        #keyboard {
            height: 400px;
        }

        .operator,
        .number,
        .empty {
            width: 50px;
            height: 50px;
            margin: 15px;
            float: left;
            border-radius: 50%;
            border-width: 0;
            font-weight: bold;
            font-size: 15px;
        }

        .number,
        .empty {
            background-color: #eaedef;
        }

        .number,
        .operator {
            cursor: pointer;
        }

        .operator:active,
        .number:active {
            font-size: 13px;
        }

        .operator:focus,
        .number:focus,
        .empty:focus {
            outline: 0;
        }

        .operator_bagi {
            font-size: 20px;
            background-color: #20b2aa;
        }

        .operator_kali {
            font-size: 20px;
            background-color: #ffa500;
        }

        .operator_minus {
            font-size: 20px;
            background-color: #f08080;
        }

        .operator_plus {
            font-size: 20px;
            background-color: #7d93e0;
        }

        .operator_sama {
            font-size: 20px;
            background-color: #9477af;
        }

        .nav {
            position: fixed;
            bottom: 0;
            width: 100%;
            height: 55px;
            box-shadow: 0 0 3px rgba(0, 0, 0, 0.2);
            background-color: #0d6efd;
            display: flex;
        }

        .nav__link {
            display: flex;
            flex-direction: column;
            flex-grow: 1;
            overflow: hidden;
            white-space: nowrap;
            font-family: sans-serif;
            font-size: 17px;
            color: #fff;
            text-decoration: none;
            -webkit-tap-highlight-color: transparent;
            transition: background-color 0.1s ease-in-out;
            justify-content: center;
        }

        .nav__link:hover {
            background-color: #084197;
            color: #fff;
        }

        .link_active {
            background-color: #084197;
            color: #fff;
        }

        .delete {
            cursor: pointer;
        }

        #menu {
            cursor: pointer;
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
    </style>
</head>

<body>
    <div class="home">
        <div class="container-fluid mt-4">
            <div class="row">
                {{-- <nav class="nav" id="menu">
                    <a href="#" class="nav__link">
                        <center>
                            <i class="bi bi-list-nested fs-4" style="float: left;margin-left:10px;"></i> <br>
                        </center>
                    </a>
                    <a href="#" class="nav__link link_active mode" id="grid_mode" data-page="page1">
                        <center>
                            <i class="bi bi-grid fs-4"></i>
                            <div class="text-resize"> Grid Mode </div>
                        </center>
                    </a>
                    <a href="#" class="nav__link mode" id="list_mode" data-page="page2">
                        <center>
                            <i class="bi bi-list-ul fs-4"></i>
                            <div class="text-resize"> List Mode </div>
                        </center>
                    </a>
                    <a href="#" class="nav__link mode" id="calculator_mode" data-page="page3">
                        <center>
                            <i class="bi bi-calculator fs-4"></i>
                            <div class="text-resize"> Kalkulator </div>
                        </center>
                    </a>
                </nav> --}}
                <div class="col-md-7">
                    <div class="card border-0 text-center nav2">
                        <div class="card-body">
                            <div class="row" id="menu">
                                <div class="col-1">
                                    <div class="bi bi-list-nested fs-3 mt-2"></div>
                                </div>
                                <div class="col-4">
                                    <div class="card border-0 bg-light-primary mode" id="grid_mode" data-page="page1">
                                        <div class="card-body p-2">
                                            <div class="bi bi-grid"></div> Grid Mode
                                        </div>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="card border-0 mode" id="list_mode" data-page="page2">
                                        <div class="card-body p-2">
                                            <div class="bi bi-list-ul"></div> List Mode
                                        </div>
                                    </div>
                                </div>
                                <div class="col-3">
                                    <div class="card border-0 mode" id="calculator_mode" data-page="page3">
                                        <div class="card-body p-1">
                                            <div class="bi bi-calculator"></div> Kalkulator
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-3 search">
                        <div class="col-md-7 col-7">
                            <input type="text" class="form-control form-control-lg border-0 rounded-pill"
                                name="search_menu" id="search_menu" oninput="search_menu(this.value)">
                        </div>
                        <div class="col-md-5 col-5">
                            <div class="d-flex mt-3 scroll_category" id="myDIV">
                                <span class="badge bg-primary p-2 category" style="margin-left: 10px;"
                                    onclick="filter_menu('all')">All</span>
                                @foreach ($category as $row)
                                    <span class="badge category p-2 bg-secondary" style="margin-left: 10px;"
                                        onclick="filter_menu('{{ $row->id_kategori }}')">
                                        {{ $row->nama_kategori }} </span>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="f1">
                        <fieldset class="page1">
                            <div class="row">

                                <!-- MENU -->
                                <div id="" class="scrollabel mt-3">
                                    <div class="row row-cols-1 row-cols-md-4 g-2 mt-0 text-resize" id="list">
                                        @foreach ($merchandise as $row2)
                                            <div class="col product {{ $row2->id_kategori }}"
                                                onclick='addtocart("{{ $row2->id_barang }}","{{ $row2->nama_barang }}", "1","{{ $row2->harga_barang }}","{{ $row2->foto }}")'>
                                                <div class="card h-100 border-0">
                                                    @if ($row2->foto == '')
                                                        <img src="https://ui-avatars.com/api?name={{ $row2->nama_barang }}&color=FFF&background=6C757D"
                                                            class="card-img-top">
                                                    @else
                                                        <img src="{{ asset('assets/images/product') }}/{{ $row2->foto }}"
                                                            class="card-img-top">
                                                    @endif
                                                    <div class="card-body">
                                                        <h6 class="nama_brg">{{ $row2->nama_barang }}</h6>
                                                        <p class="card-text">
                                                            Rp{{ number_format($row2->harga_barang, 0, ',', '.') }}</p>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div> <!-- end row -->
                                </div>

                            </div>
                        </fieldset>
                        <fieldset class="page2">
                            <div class="row mt-3">
                                <!-- MENU -->
                                <div class="scrollabel mt-3">
                                    @foreach ($merchandise as $row2)
                                        <div class="product {{ $row2->id_kategori }}" id="list"
                                            onclick='addtocart("{{ $row2->id_barang }}","{{ $row2->nama_barang }}", "1","{{ $row2->harga_barang }}","{{ $row2->foto }}")'>
                                            <div class="row">
                                                <div class="col-8">
                                                    <div class="d-flex">
                                                        @if ($row2->foto == null)
                                                            <img src="https://ui-avatars.com/api?name={{ $row2->nama_barang }}&color=FFF&background=6C757D"
                                                                alt="" width="70px" height="70px;"
                                                                style="border-radius:20px;">
                                                        @else
                                                            <img src="{{ asset('assets/images/product/') }}/{{ $row2->foto }}"
                                                                width="70px" height="70px;"
                                                                style="border-radius:20px;" alt="">
                                                        @endif
                                                        <h6 style="margin-left: 10px;" class="mt-2 nama_brg">
                                                            {{ $row2->nama_barang }} </h6>
                                                    </div>
                                                </div>
                                                <div class="col-4">
                                                    <h6 style="float: right" class="mt-2"> Rp.
                                                        {{ number_format($row2->harga_barang, 0, ',', '.') }} </h6>
                                                </div>
                                            </div>
                                            <hr>
                                        </div>
                                    @endforeach
                                </div>

                            </div>
                        </fieldset>
                        <fieldset class="page3">
                            <div class="mt-3" id="calculator">
                                <div id="result">
                                    <div id="history">
                                        <p id="history-value"></p>
                                    </div>
                                    <div id="output">
                                        <p id="output-value"></p>
                                    </div>
                                </div>
                                <div id="keyboard">
                                    <div class="row">
                                        <div class="col-3">
                                            <button class="operator" id="clear">C</button>
                                        </div>
                                        <div class="col-3">
                                            <button class="operator" id="backspace">CE</button>
                                        </div>
                                        <div class="col-3">
                                            <button class="operator" id="%">%</button>
                                        </div>
                                        <div class="col-3">
                                            <button class="operator operator_bagi" id="÷">&#247;</button>
                                        </div>
                                        <div class="col-3">
                                            <button class="number" id="7">7</button>
                                        </div>
                                        <div class="col-3">
                                            <button class="number" id="8">8</button>
                                        </div>
                                        <div class="col-3">
                                            <button class="number" id="9">9</button>
                                        </div>
                                        <div class="col-3">
                                            <button class="operator operator_kali" id="×">&times;</button>
                                        </div>
                                        <div class="col-3">
                                            <button class="number" id="4">4</button>
                                        </div>
                                        <div class="col-3">
                                            <button class="number" id="5">5</button>
                                        </div>
                                        <div class="col-3">
                                            <button class="number" id="6">6</button>
                                        </div>
                                        <div class="col-3">
                                            <button class="operator operator_minus" id="-">-</button>
                                        </div>
                                        <div class="col-3">
                                            <button class="number" id="1">1</button>
                                        </div>
                                        <div class="col-3">
                                            <button class="number" id="2">2</button>
                                        </div>
                                        <div class="col-3">
                                            <button class="number" id="3">3</button>
                                        </div>
                                        <div class="col-3">
                                            <button class="operator operator_plus" id="+">+</button>
                                        </div>
                                        <div class="col-md-3"></div>
                                        <div class="col-3">
                                            <button class="number" id="0">0</button>
                                        </div>
                                        <div class="col-md-3"></div>
                                        <div class="col-3">
                                            <button class="operator operator_sama" id="=">=</button>
                                        </div>
                                    </div>
                                    {{-- <button class="empty" id="empty"></button>
                                    <button class="empty" id="empty"></button> --}}
                                </div>
                            </div>
                        </fieldset>
                    </div>
                </div>

                <div class="col-md-5">
                    <div class="row">

                        <!-- Right Content -->
                        <div class="col-md-12 mb-3">
                            <div class="card border-0">
                                <div class="card-body">
                                    <!-- Head -->
                                    <section id="head">
                                        <div class="d-flex fs-4 align-items-center">
                                            <button type="button" class="btn btn-primary"><span
                                                    class="bi bi-person-lines-fill h4"></span></button>
                                            <span class="ms-auto fs-6">+Tambah Customer</span>
                                            <span class="ms-auto">
                                                <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                                    data-bs-target="#retrive_modal"><span
                                                        class="bi bi-list-task h4"></span></button>
                                            </span>
                                        </div>
                                    </section>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="card border-0 ">
                                <div class="card-body">
                                    <!-- Head -->
                                    <section id="body">
                                        <div
                                            class="d-flex justify-content-center bg-light p-1 rounded mb-4 text-resize-2">
                                            Transaksi
                                            <!--<span class = "bi bi-caret-down-fill text-primary ms-1"></span>-->
                                        </div>

                                        <!-- Items -->
                                        <div id="cart"></div>

                                        <hr class="mb-1" />
                                        <span class="d-flex justify-content-center text-resize-2 hapus_all"
                                            onclick="hapus_all()">Hapus
                                            Semua</span>
                                        <hr class="mt-1" />

                                        <div class="row text-resize mx-1 mt-3">
                                            <div class="col-6">Sub Total</div>
                                            <div class="col-6 text-end"> <span id="subtotal_text"></span> </div>

                                            <div class="col-6 text-muted">PPN(10%)</div>
                                            <div class="col-6 text-muted text-end"> <span id="ppn_text"></span>
                                            </div>

                                            <div class="col-6">Total</div>
                                            <div class="col-6 text-end"> <span id="total_text"></span> </div>
                                        </div>
                                    </section>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-5">
                            <button type="button" class="btn btn-lg form-control btn-primary py-3" disabled
                                id="btn_park" onclick="park()"><span class="bi bi-archive me-1"></span>
                                Simpan</button>
                        </div>
                        <div class="col-md-7 mb-3">
                            <button type="button" class="btn btn-lg form-control btn-primary shadow-lg p-3" disabled
                                id="btn_bayar" data-bs-toggle="modal" data-bs-target="#exampleModalScrollable">
                                <div class="d-flex fs-5 justify-content-center">
                                    Bayar <span id="bayar_text" style="margin-left: 10px;"></span>
                                </div>
                            </button>
                        </div>

                    </div>
                </div>



            </div>
            <footer>
                <div class="footer clearfix mb-0 text-muted">
                    <div class="float-start">
                        <p>2021 &copy; {{ $profile->nama_aplikasi }}</p>
                    </div>
                    <div class="float-end">
                        <p> Made with <span class="text-danger"><i class="bi bi-heart-fill"></i></span> by
                            {{ $profile->nama }} </p>
                    </div>
                </div>
            </footer>
        </div>
    </div>
    <!--scrolling content Modal -->
    <div class="modal fade" id="exampleModalScrollable" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <i class="bi bi-arrow-left" data-bs-dismiss="modal" style="cursor: pointer;font-size:20px;"></i>
                    <center>
                        <h5 class="mt-3"> Total Bayar : <span class="grandtotal"></span> </h5>
                    </center>
                    <button class="btn btn-primary" type="button" onclick="transaksi()"> Bayar <i
                            class="bi bi-cash"></i>
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
                                                    <button class="btn btn-outline-primary btn-block cash type1"
                                                        onclick="change_tunai('1')" type="button">
                                                        <span class="harga1"></span> </button>
                                                </div>
                                                <div class="col-md-4">
                                                    <button class="btn btn-outline-primary btn-block cash type2"
                                                        onclick="change_tunai('2')" type="button">
                                                        <span class="harga2"></span> </button>
                                                </div>
                                                <div class="col-md-4">
                                                    <button class="btn btn-outline-primary btn-block cash type3"
                                                        onclick="change_tunai('3')" type="button">
                                                        Rp
                                                        50.000 </button>
                                                </div>
                                                <input type="hidden" class="harga_1">
                                                <input type="hidden" class="harga_2">
                                                <input type="hidden" class="harga_3" value="50000">
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <input type="text" placeholder="Rp 19.000" name="option_cash"
                                                style="width: 97%" id="option_cash" class="form-control">
                                            <input type="hidden" name="subtotal" id="subtotal"
                                                class="form-control">
                                            <input type="hidden" name="ppn" id="ppn"
                                                class="form-control">
                                            <input type="hidden" name="total" id="total"
                                                class="form-control">
                                            <input type="hidden" name="kembalian" id="kembalian" value="0"
                                                class="form-control">
                                            <input type="hidden" name="bayar" id="bayar"
                                                class="form-control">
                                            <input type="hidden" name="id_penjualan" id="id_penjualan"
                                                value="{{ $code }}">
                                            <input type="hidden" name="jenis_pembayaran" id="jenis_pembayaran">
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
                                                        <button class="btn btn-outline-primary btn-block edc"
                                                            type="button" style="width: 100%"
                                                            onclick="change_card('{{ $key->id_edc }}')">
                                                            <span style="font-size:15px;"> {{ $key->nama_edc }}
                                                            </span> </button>
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
</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"
    integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous">
</script>
<script src="{{ asset('assets/js/apps.js') }}"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });

    function getHistory() {
        return document.getElementById("history-value").innerText.replace("÷", "/").replace("×", "*");
    }

    function printHistory(num) {
        document.getElementById("history-value").innerText = num;
    }

    function getOutput() {
        return document.getElementById("output-value").innerText;
    }

    function printOutput(num) {
        if (num == "") {
            document.getElementById("output-value").innerText = num;
        } else {
            document.getElementById("output-value").innerText = getFormattedNumber(num);
        }
    }

    function getFormattedNumber(num) {
        if (num == "-") {
            return "";
        }
        var n = Number(num);
        var value = n.toLocaleString("en");
        return value;
    }

    function reverseNumberFormat(num) {
        return Number(num.replace(/,/g, ''));
    }
    var operator = document.getElementsByClassName("operator");
    for (var i = 0; i < operator.length; i++) {
        operator[i].addEventListener('click', function() {
            if (this.id == "clear") {
                printHistory("");
                printOutput("");
            } else if (this.id == "backspace") {
                var output = reverseNumberFormat(getOutput()).toString();
                if (output) { //if output has a value
                    output = output.substr(0, output.length - 1);
                    printOutput(output);
                }
            } else {
                var output = getOutput();
                var history = getHistory();
                if (output == "" && history != "") {
                    if (isNaN(history[history.length - 1])) {
                        history = history.substr(0, history.length - 1);
                    }
                }
                if (output != "" || history != "") {
                    output = output == "" ? output : reverseNumberFormat(output);
                    history = history + output;
                    if (this.id == "=") {
                        var result = eval(history);
                        printOutput(result);
                        printHistory("");
                    } else {
                        history = history + this.id;
                        printHistory(history);
                        printOutput("");
                    }
                }
            }

        });
    }
    var number = document.getElementsByClassName("number");
    for (var i = 0; i < number.length; i++) {
        number[i].addEventListener('click', function() {
            var output = reverseNumberFormat(getOutput());
            if (output != NaN) { //if output is a number
                output = output + this.id;
                printOutput(output);
            }
        });
    }
    $(function() {
        $('.page1').fadeIn('slow');
        $('#grid_mode').on('click', function() {
            $(".page3").hide()
            $('.page2').hide();
            $('.page1').fadeIn("slow");
        });
        $('#list_mode').on('click', function() {
            $(".page3").hide()
            $(".page1").hide()
            $('.page2').fadeIn("slow");
        });
        $('#calculator_mode').on('click', function() {
            $(".page1").hide()
            $(".page2").hide()
            $(".search").hide()
            $('.page3').fadeIn("slow");
        });
    })

    localStorage.setItem('cart', '[]');
    // localStorage.setItem('data_promo', '[]');
    cartData();
    var menu = document.getElementById("menu");
    var btns_menu = menu.getElementsByClassName("mode");
    for (var i = 0; i < btns_menu.length; i++) {
        btns_menu[i].addEventListener("click", function() {
            var current_menu = document.getElementsByClassName("bg-light-primary");
            current_menu[0].className = current_menu[0].className.replace(" bg-light-primary", " ");
            this.className = "card border-0 bg-light-primary mode";
        });
    }
    var kategori = document.getElementById("myDIV");
    var btns_kategori = kategori.getElementsByClassName("category");
    for (var i = 0; i < btns_kategori.length; i++) {
        btns_kategori[i].addEventListener("click", function() {
            var current_kategori = document.getElementsByClassName("bg-primary");
            current_kategori[0].className = current_kategori[0].className.replace(" bg-primary",
                " bg-secondary");
            this.className = "badge bg-primary p-2 category";
        });
    }
    localStorage.setItem("cart", "[]");
    var promo_diskon = localStorage.getItem("promo_diskon");
    var cek_stroage_promo = JSON.parse(promo_diskon) != null ? JSON.parse(promo_diskon) : [];
    const url_promo = 'http://localhost/kp_penjualan/public/promo/diskon/data_detail_promo';
    filter_menu("all")

    function filter_menu(c) {
        var x, i;
        x = document.getElementsByClassName("product");
        if (c == "all") c = "";
        // Add the "show" class (display:block) to the filtered elements, and remove the "show" class from the elements that are not selected
        for (i = 0; i < x.length; i++) {
            w3RemoveClass(x[i], "show");
            w3AddClass(x[i], "hide");
            if (x[i].className.indexOf(c) > -1) {
                w3AddClass(x[i], "show");
                w3RemoveClass(x[i], "hide");
            }
        }
    }

    // Show filtered elements
    function w3AddClass(element, name) {
        var i, arr1, arr2;
        arr1 = element.className.split(" ");
        arr2 = name.split(" ");
        for (i = 0; i < arr2.length; i++) {
            if (arr1.indexOf(arr2[i]) == -1) {
                element.className += " " + arr2[i];
            }
        }
    }

    // Hide elements that are not selected
    function w3RemoveClass(element, name) {
        var i, arr1, arr2;
        arr1 = element.className.split(" ");
        arr2 = name.split(" ");
        for (i = 0; i < arr2.length; i++) {
            while (arr1.indexOf(arr2[i]) > -1) {
                arr1.splice(arr1.indexOf(arr2[i]), 1);
            }
        }
        element.className = arr1.join(" ");
    }

    function search_menu(isi) {
        var filter = isi.toUpperCase();
        var list = document.getElementById("list");
        var divs = list.getElementsByClassName("product");
        for (var i = 0; i < divs.length; i++) {
            var a = divs[i].getElementsByClassName("nama_brg")[0];
            if (a) {
                if (a.innerHTML.toUpperCase().indexOf(filter) > -1) {
                    divs[i].style.display = "";
                } else {
                    divs[i].style.display = "none";
                }
            }
        }
    }
    fetch(url_promo)
        .then((response) => {
            return response.json();
        })
        .then((result) => {
            let promo = result.data;
            for (let i = 0; i < promo.length; i++) {
                var cek_id_promo = cek_stroage_promo.findIndex(item => item.id_promo == promo[i].id_promo);
                var cek_id_barang = cek_stroage_promo.findIndex(item => item.id_barang == promo[i].id_barang);
                if (cek_id_promo < 0 || cek_id_barang < 0) {
                    var data = {
                        id_promo: promo[i].id_promo,
                        nama_promo: promo[i].nama_promo,
                        tipe_promo: promo[i].tipe_promo,
                        id_barang: promo[i].id_barang,
                        nominal: promo[i].nominal,
                        persen: promo[i].persen,
                    };
                    cek_stroage_promo.push(data);
                    localStorage.setItem("promo_diskon", JSON.stringify(cek_stroage_promo));
                }
            }

        })
        .catch(function(error) {
            console.log(error);
        });

    function select_park() {
        const obj_park = JSON.parse(localStorage.getItem("park"));

        if (obj_park != null) {
            let html_park = '';
            html_park = html_park +
                `
                <div class="row">
            `;
            for (let i = 0; i < obj_park.length; i++) {
                html_park = html_park +
                    `
                <div class="col-md-4" onclick="retrive('${obj_park[i].customer}')">
                    <div class="card">
                        <div class="card-body">
                            <center> <h5> Customer ${obj_park[i].customer} </h5> </center>
                        </div>
                    </div>
                </div>
                `;
            }
            html_park = html_park +
                `
                    </div>
                `;
            document.getElementById('data_park').innerHTML = html_park;
        }
    }
    select_park();
    // localStorage.setItem("id_kategori", 'all');

    function retrive(value) {

        const park_detail = JSON.parse(localStorage.getItem("park_detail"));
        const park = JSON.parse(localStorage.getItem("park"));
        let hitung = 0;
        let hitung2 = 0;
        var detail_customer = park_detail.findIndex(item => item.customer == value);
        var customer = park.findIndex(item => item.customer == value);
        const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal
                    .stopTimer)
                toast.addEventListener('mouseleave', Swal
                    .resumeTimer)
            }
        })
        const cart = [];
        for (let c = 0; c < park_detail.length; c++) {
            if (park_detail[c].customer == value) {
                var product = {
                    productid: park_detail[c].productid,
                    productname: park_detail[c].productname,
                    productprice: park_detail[c].productprice,
                    productqty: park_detail[c].productqty,
                    productphoto: park_detail[c].productphoto,
                    harga_asli: park_detail[c].harga_asli,
                    harga_akhir: park_detail[c].harga_akhir,
                    potongan: park_detail[c].potongan,
                    id_promo: park_detail[c].id_promo,
                    nama_promo: park_detail[c].nama_promo,
                    jml_potongan: park_detail[c].jml_potongan
                };
                cart.push(product);
                localStorage.setItem("cart", JSON.stringify(cart));
            }
        }
        cartData();
        $("#retrive_modal").modal('hide');
        Toast.fire({
            icon: 'success',
            title: 'Retrive data berhasil !'
        })

        for (let i = 0; i < park_detail.length; i++) {
            if (park_detail[i].customer == value) {
                hitung += [i].length;
            }
        }
        for (let a = 0; a < park.length; a++) {
            if (park[a].customer == value) {
                hitung2 += [a].length;
            }
        }
        park_detail.splice(detail_customer, hitung);
        localStorage.setItem('park_detail', JSON.stringify(park_detail));
        park.splice(customer, hitung2);
        localStorage.setItem('park', JSON.stringify(park));
        select_park();

    }

    function park() {
        Swal.fire({
            title: 'Save as',
            input: 'text',
            inputAttributes: {
                autocapitalize: 'off',
                autocomplete: 'off'

            },
            showCancelButton: true,
            cancelButtonText: 'Batal',
            confirmButtonText: 'Save',
            showLoaderOnConfirm: true,
            inputValidator: (value) => {
                if (!value) {
                    return 'Input jangan sampai kosong!'
                }
            },
            preConfirm: (customer) => {
                const Toast = Swal.mixin({
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 3000,
                    timerProgressBar: true,
                    didOpen: (toast) => {
                        toast.addEventListener('mouseenter', Swal
                            .stopTimer)
                        toast.addEventListener('mouseleave', Swal
                            .resumeTimer)
                    }
                })
                const obj = JSON.parse(localStorage.getItem("cart"));
                const park_detail = localStorage.getItem("park_detail");
                const park = localStorage.getItem("park");
                var ppark_detail = JSON.parse(park_detail) != null ? JSON.parse(park_detail) : [];
                var ppark = JSON.parse(park) != null ? JSON.parse(park) : [];
                var cek_cust = ppark.findIndex(item => item.customer == customer);
                if (cek_cust == null || cek_cust == -1) {
                    var data = {
                        customer: customer
                    }
                    ppark.push(data);
                    localStorage.setItem("park", JSON.stringify(ppark));

                    for (let i = 0; i < obj.length; i++) {
                        var product = {
                            customer: customer,
                            productid: obj[i].productid,
                            productname: obj[i].productname,
                            productprice: obj[i].productprice,
                            productqty: obj[i].productqty,
                            productphoto: obj[i].productphoto,
                            harga_asli: obj[i].harga_asli,
                            harga_akhir: obj[i].harga_akhir,
                            potongan: obj[i].potongan,
                            id_promo: obj[i].id_promo,
                            nama_promo: obj[i].nama_promo,
                            jml_potongan: obj[i].jml_potongan
                        };
                        ppark_detail.push(product);
                        localStorage.setItem("park_detail", JSON.stringify(ppark_detail));
                    }
                    localStorage.setItem("cart", '[]');
                    cartData();
                    select_park();
                    Toast.fire({
                        icon: 'success',
                        title: 'Simpan bill berhasil !'
                    })
                } else {
                    Toast.fire({
                        icon: 'error',
                        title: "simpan sebagai <b>" + customer + '</b> sudah ada !'
                    })
                }
            },
            allowOutsideClick: () => !Swal.isLoading()
        })

    }

    function change_tunai(value) {
        if (value == 1) {
            $(".type1").addClass("active");
            let harga = $(".harga_1").val();
            let bayar = $("#bayar").val(harga);
            let kembalian = parseInt(harga) - parseInt($("#total").val());
            $("#kembalian").val(kembalian);
        } else if (value == 2) {
            $(".type2").addClass("active");
            let harga = $(".harga_2").val();
            $("#bayar").val(harga);
            let kembalian = parseInt(harga) - parseInt($("#total").val());
            $("#kembalian").val(kembalian);
        } else if (value == 3) {
            $(".type3").addClass("active");
            let harga = $(".harga_3").val();
            $("#bayar").val(harga);
            let kembalian = parseInt(harga) - parseInt($("#total").val());
            $("#kembalian").val(kembalian);
        }
        $(".edc").removeClass("active");
        $("#option_cash").val('');
        $("#jenis_pembayaran").val("Tunai");
        $("#id_edc").val("");
    }

    function change_card(card) {
        $("#option_cash").val('');
        $(".cash").removeClass("active");
        $("#bayar").val($(".harga_1").val());
        let kembalian = parseInt($(".harga_1").val()) - parseInt($("#total").val());
        $("#kembalian").val(kembalian);
        $("#jenis_pembayaran").val("Non Tunai");
        $("#id_edc").val(card);
    }
    var row_kartu = document.getElementById("kartu");
    var list_edc = row_kartu.getElementsByClassName("edc");
    for (var a = 0; a < list_edc.length; a++) {
        list_edc[a].addEventListener("click", function() {
            $(".edc").removeClass("active");
            this.className += " active";
        });
    }
    var header = document.getElementById("harganya");
    var btns = header.getElementsByClassName("cash");
    for (var i = 0; i < btns.length; i++) {
        btns[i].addEventListener("click", function() {
            $(".cash").removeClass("active");
            this.className += " active";

        });
    }
    $("body").on("focus", "#option_cash", function() {
        $("#bayar").val('');
        $("#kembalian").val('0');
        $('.cash').removeClass('active');
        $(".edc").removeClass("active");
        $("#jenis_pembayaran").val("Tunai");
        $("#id_edc").val("");
    })
    $("body").on("input", "#option_cash", function() {
        $("#bayar").val(this.value);
        if (this.value == "") {
            $("#kembalian").val("0");
        } else {
            let kembalian = parseInt(this.value) - parseInt($("#total").val());
            $("#kembalian").val(kembalian);
        }
    })

    function transaksi() {
        const str = localStorage.getItem("cart");

        const parsedObj = JSON.parse(str);

        let total = $("#total").val();
        let bayar = $("#bayar").val();
        let kembalian = $("#kembalian").val();
        let jenis_pembayaran = $("#jenis_pembayaran").val();
        let id_edc = $("#id_edc").val();
        let id_penjualan = $("#id_penjualan").val();
        let subtotal = $("#subtotal").val();
        let ppn = $("#ppn").val();

        const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal
                    .stopTimer)
                toast.addEventListener('mouseleave', Swal
                    .resumeTimer)
            }
        })

        if (bayar == "" || bayar == 0 || kembalian < 0 || total > bayar) {
            Toast.fire({
                icon: 'error',
                title: "Tolong teliti lagi transaksi !"
            })
        } else {

            $.ajax({
                url: 'pos/save',
                data: {
                    detail_penjualan: parsedObj,
                    total: total,
                    bayar: bayar,
                    kembalian: kembalian,
                    jenis_pembayaran: jenis_pembayaran,
                    id_edc: id_edc,
                    id_penjualan: id_penjualan,
                    subtotal: subtotal,
                    ppn: ppn
                },
                type: 'post',
                success: function(result) {
                window.location = "{{ url('/print/receipt/')}}/" + id_penjualan;

                    // window.location = '{{url("/print/receipt/",'+id_penjualan+')}}';
                }
            })
        }
    }

    function addtocart(id, name, qty, harga, photo) {
        var quantity = $("#productqty").val() != "" ? parseInt($("#productqty").val()) : 0;
        var price = $("#productprice").text();
        var pprice = price.replace(/[^\x00-\x7F]/g, "");
        var cart = localStorage.getItem("cart");
        var data_promo_diskon = JSON.parse(localStorage.getItem("promo_diskon"));
        var pcart = JSON.parse(cart) != null ? JSON.parse(cart) : [];
        //get index of the json array where the productid is there ...
        var present_or_not = pcart.findIndex(item => item.productid == id);
        //if the item not presnt , is null
        if (cart == null || present_or_not == null || present_or_not == -1) {
            var present_or_not = data_promo_diskon.findIndex(item => item.id_barang == id);
            var actual_stored_product = data_promo_diskon[present_or_not];
            data_promo_diskon.splice(present_or_not, 1);
            if (present_or_not == -1 || present_or_not == null || data_promo_diskon.length == 0) {
                var actual_potongan = 0;
                var harga_akhir = parseInt(harga);
                var promo = "";
                var nm_promo = "";
                var jml_potongan = "";
                var promo_type = "";
            } else {
                if (actual_stored_product.tipe_promo == "Diskon Nominal") {
                    var actual_potongan = actual_stored_product.nominal == null || actual_stored_product
                        .nominal == "" ? 0 : actual_stored_product.nominal;
                    var harga_akhir = parseInt(harga) - parseInt(actual_potongan);
                    var promo = actual_stored_product.id_promo;
                    var nm_promo = actual_stored_product.nama_promo;
                    var jml_potongan = formatRupiah(`${actual_potongan}`, "Rp. ");
                } else if (actual_stored_product.tipe_promo == "Diskon Menu" || actual_stored_product.tipe_promo ==
                    "Diskon Persen") {
                    var actual_potongan = actual_stored_product.persen == null || actual_stored_product
                        .persen == "" ? 0 : actual_stored_product.persen;
                    var harga_akhir = parseInt(harga) - (parseInt(harga) * parseInt(actual_potongan) /
                        100);
                    var promo = actual_stored_product.id_promo;
                    var nm_promo = actual_stored_product.nama_promo;
                    var jml_potongan = actual_potongan + "%";
                    var promo_type = actual_stored_product.tipe_promo;
                }
            }

            var product = {
                productid: id,
                productname: name,
                harga_asli: harga,
                harga_akhir: harga_akhir,
                potongan: actual_potongan,
                productqty: qty,
                productphoto: photo,
                id_promo: promo,
                nama_promo: nm_promo,
                jml_potongan: jml_potongan,
                promo_type: promo_type
            };
            pcart.push(product);
            localStorage.setItem("cart", JSON.stringify(pcart));
            cartData();

        } else {
            //get the the json from index...
            var actual_stored_product = pcart[present_or_not];
            pcart.splice(present_or_not, 1); //remove the json array 
            //get the qty which was already prsnt
            var actual_qty = actual_stored_product.productqty == null || actual_stored_product.productqty == "" ? 0 :
                actual_stored_product.productqty;
            //update the value
            actual_stored_product.productqty = parseInt(actual_qty) + parseInt(qty);
            //now..we have updated value..push obj again..
            pcart.push(actual_stored_product);
            //store the json in local Storage
            localStorage.setItem("cart", JSON.stringify(pcart));
        }
        // console.log(JSON.stringify(pcart));
        cartData();
    }

    function cartData() {
        const str = localStorage.getItem("cart");

        const parsedObj = JSON.parse(str);
        // console.log(parsedObj);

        const total_pesanan = parsedObj.length;

        if (total_pesanan > 0) {
            document.getElementById('btn_bayar').disabled = false;
            document.getElementById('btn_park').disabled = false;
        } else {
            document.getElementById('btn_bayar').disabled = true;
            document.getElementById('btn_park').disabled = true;
        }



        if (parsedObj != null) {
            let html = '';
            let html2 = '';
            let html3 = '';
            let sno = 1;
            let subtotal = 0;
            let harga2 = 2000;
            let ppn = 0;
            let total = 0;
            html = html +
                `
        <div class="row g-3 text-resize mx-2 scroll_transaksi">
        
        
        `;
            for (let i = 0; i < parsedObj.length; i++) {
                let harga_barang = formatRupiah(parsedObj[i].harga_asli, "Rp. ");
                subtotal += parseInt(parsedObj[i].productqty) * parseInt(parsedObj[i].harga_akhir);
                ppn += parseInt(parsedObj[i].productqty) * parseInt(parsedObj[i].harga_akhir) * 10 / 100;
                total += (parseInt(parsedObj[i].productqty) * parseInt(parsedObj[i].harga_akhir)) + (parseInt(parsedObj[
                    i].productqty) * parseInt(parsedObj[i].harga_akhir) * 10 / 100);

                harga2 += (parseInt(parsedObj[i].productqty) * parseInt(parsedObj[i].harga_akhir)) + (parseInt(
                    parsedObj[i].productqty) * parseInt(parsedObj[i].harga_akhir) * 10 / 100);
                harga_per_barang = parsedObj[i].productqty * parsedObj[i].harga_asli;
                let total_harga = parseInt(parsedObj[i].productqty) * parseInt(parsedObj[i].harga_akhir);
                if (parsedObj[i].productphoto == "") {
                    foto_gambar = "https://ui-avatars.com/api?name=" + `${parsedObj[i].productname}` +
                        "&color=FFF&background=6C757D";
                } else {
                    foto_gambar = "assets/images/product/" + parsedObj[i].productphoto;
                }
                html = html +
                    `
                    <div class="col-5">
                        ${parsedObj[i].productname} <br />
                        <span class="text-resize-3 text-muted">${parsedObj[i].potongan == "" || parsedObj[i].potongan == 0 ? '' : parsedObj[i].nama_promo+'('+parsedObj[i].jml_potongan+')'}</span>
                    </div>

                    <div class="col-1 p-0 text-end"><button type="button" onclick="minus_qty('${parsedObj[i].productid}')"
                            class="btn btn-sm btn-outline-primary border-0 bg-light-primary pb-0 pt-0"><span
                                class="bi bi-dash"></span></button></div>
                    <div class="col-1 p-0 text-center text-resize-2">
                        <span class="text-resize-3">x</span>${parsedObj[i].productqty}
                    </div>
                    <div class="col-1 p-0 "><button type="button"  onclick="plus_qty('${parsedObj[i].productid}')"
                            class="btn btn-sm btn-outline-primary border-0 bg-light-primary pb-0 pt-0"><span
                                class="bi bi-plus"></span></button></div>

                        
                    <div class="col-3 p-0 text-end">${formatRupiah(`${parsedObj[i].productqty * parsedObj[i].harga_asli}`,"Rp. ")} <br> <span class="text-resize-3 text-muted fst-italic">${parsedObj[i].promo_type == "" ? '' : parsedObj[i].promo_type == "Diskon Persen" || parsedObj[i].promo_type == "Diskon Menu" ? '( - '+formatRupiah(`${parsedObj[i].productqty * (parsedObj[i].harga_asli * parsedObj[i].potongan / 100) * (-1)}`, "Rp. ")+' )' : '( '+formatRupiah(`${parsedObj[i].productqty * parsedObj[i].potongan}`, "Rp. ")+' )' }</span> </div>
                    <div class="col-1 p-0 text-end"><span
                            class="bi bi-trash text-danger delete" onclick="deleteData(${i})"></span></div>


                    `;
                sno++;
            }
            html = html +
                `
        </div>
        
        `;



            // element.classList.add("mystyle");
            document.getElementById('cart').innerHTML = html;
            document.getElementById('subtotal_text').innerHTML = formatRupiah(`${subtotal}`, "Rp");
            document.getElementById('ppn_text').innerHTML = formatRupiah(`${ppn}`, "Rp");
            document.getElementById('total_text').innerHTML = formatRupiah(`${total}`, "Rp");
            document.getElementById('bayar_text').innerHTML = formatRupiah(`${total}`, "Rp");
            // document.getElementById('hapus_semua').innerHTML = html2;
            // document.getElementById('btn_pembayaran').innerHTML = html3;
            $(".harga1").html(formatRupiah(`${total}`, "Rp "));
            $(".harga2").html(formatRupiah(`${harga2}`, "Rp "));
            $(".harga_1").val(`${total}`);
            $("#subtotal").val(`${subtotal}`);
            $("#ppn").val(`${ppn}`);
            $("#total").val(`${total}`);
            $(".harga_2").val(`${harga2}`);
            $(".grandtotal").html(formatRupiah(`${total}`, "Rp "));
            document.getElementsByName('option_cash')[0].placeholder = formatRupiah(`${total}`, "RP ");

        }
    }

    function deleteData(rid) {
        let arr = getCrudData();
        arr.splice(rid, 1);
        setCrudData(arr);
        cartData();
    }

    function getCrudData() {
        let arr = JSON.parse(localStorage.getItem('cart'));
        return arr;
    }

    function setCrudData(arr) {
        localStorage.setItem('cart', JSON.stringify(arr));
    }

    function plus_qty(value) {
        var cart = localStorage.getItem("cart");
        var pcart = JSON.parse(cart) != null ? JSON.parse(cart) : [];
        var present_or_not = pcart.findIndex(item => item.productid == value);
        var actual_stored_product = pcart[present_or_not];
        pcart.splice(present_or_not, 1);
        var actual_qty = actual_stored_product.productqty == null || actual_stored_product.productqty == "" ? 0 :
            actual_stored_product.productqty;
        actual_stored_product.productqty = parseInt(actual_qty) + parseInt('1');
        pcart.push(actual_stored_product);
        localStorage.setItem("cart", JSON.stringify(pcart));

        // console.log(JSON.stringify(pcart));
        cartData();
    }

    function minus_qty(value) {
        var cart = localStorage.getItem("cart");
        var pcart = JSON.parse(cart) != null ? JSON.parse(cart) : [];
        var present_or_not = pcart.findIndex(item => item.productid == value);
        var actual_stored_product = pcart[present_or_not];
        pcart.splice(present_or_not, 1);
        var actual_qty = actual_stored_product.productqty == null || actual_stored_product.productqty == "" ? 0 :
            actual_stored_product.productqty;
        actual_stored_product.productqty = parseInt(actual_qty) - parseInt('1');
        pcart.push(actual_stored_product);
        localStorage.setItem("cart", JSON.stringify(pcart));

        // console.log(JSON.stringify(pcart));
        const str1 = localStorage.getItem("cart");

        const parsedObj1 = JSON.parse(str1);

        for (let i = 0; i < parsedObj1.length; i++) {
            if (parsedObj1[i].productqty == 0) {
                deleteData(i)
            }
        }
        cartData();
    }

    function hapus_all() {
        localStorage.setItem("cart", '[]');
        cartData();
    }
</script>

</html>
