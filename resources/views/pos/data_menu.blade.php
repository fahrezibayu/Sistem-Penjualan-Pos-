<style>
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
        color: black;
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
</style>

{{-- <div class="view_wrap list-view" style="display: none;">
    @foreach ($merchandise as $row2)
        <div class="view_item"
            onclick='addtocart("{{ $row2->id_barang }}","{{ $row2->nama_barang }}", "1","{{ $row2->harga_barang }}")'>
            <div class="vi_left">
                @if ($row2->foto == '')
                    <img src='https://ui-avatars.com/api?name={{ $row2->nama_barang }}&color=FFF&background=6C757D'
                        alt='avtar img holder' style="border-radius: 30%;">
                @else
                    <div class="avatar avatar-lg">
                        <img src="{{ asset('assets/imgaes/product') }}/{{ $row2->foto }}">
                    </div>
                @endif
            </div>
            <span class="title">
                {{ $row2->nama_barang }}
            </span>
            <span style="margin-left:250px;" class="badge bg-primary"> Rp.
                {{ number_format($row2->harga_barang, 0, ',', '.') }} </span>
        </div>
        <hr>
    @endforeach

</div> --}}
<h6 class="text-center mt-3" id="text_nothing" style="display: none"> Pencarian menu tidak ditemukan <i
        class="fa fa-search"></i> </h6>
<div class="view_wrap grid-view" id="grid_menu">
    <div class="row">
        @foreach ($merchandise as $row2)
            <div class="col-md-6 col-lg-3 col-4 col-xs-12 mt-3 product" style="margin-right: -15px"
                onclick='addtocart("{{ $row2->id_barang }}","{{ $row2->nama_barang }}", "1","{{ $row2->harga_barang }}","{{ $row2->foto }}")'>
                @if ($row2->foto == '')
                    <img src="https://ui-avatars.com/api?name={{ $row2->nama_barang }}&color=FFF&background=6C757D"
                        style="border-radius: 20px" height="200px" width="200px">
                @else
                    <img src="assets/images/product/{{ $row2->foto }}" style="border-radius: 20px" height="200px"
                        width="200px">
                @endif
                <h6 class="text-center"> {{ $row2->nama_barang }} </h6>
            </div>
        @endforeach
    </div>
</div>
<!--scrolling content Modal -->
<div class="modal fade" id="exampleModalScrollable" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <i class="fa fa-arrow-left" data-bs-dismiss="modal" style="cursor: pointer;font-size:20px;"></i>
                <center>
                    <h5 class="mt-3"> Total Bayar : <span class="grandtotal"></span> </h5>
                </center>
                <button class="btn btn-primary" onclick="transaksi()"> Bayar <i class="fa fa-money-bill-alt"></i>
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
                                                <button class="btn btn-outline-secondary btn-block cash type1"
                                                    onclick="change_tunai('1')">
                                                    <span class="harga1"></span> </button>
                                            </div>
                                            <div class="col-md-4">
                                                <button class="btn btn-outline-secondary btn-block cash type2"
                                                    onclick="change_tunai('2')">
                                                    <span class="harga2"></span> </button>
                                            </div>
                                            <div class="col-md-4">
                                                <button class="btn btn-outline-secondary btn-block cash type3"
                                                    onclick="change_tunai('3')">
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
                                            style="margin-right: 40px" id="option_cash"
                                            onfocus="option_cash(this.value)" class="form-control">
                                        <input type="hidden" name="total" id="total" class="form-control">
                                        <input type="hidden" name="kembalian" id="kembalian" value="0"
                                            class="form-control">
                                        <input type="hidden" name="bayar" id="bayar" class="form-control">
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
                                                    <button class="btn btn-outline-secondary btn-block edc"
                                                        onclick="change_card()">
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
<script>
    function change_tunai(value) {
        if (value == 1) {
            $(".type1").addClass("aktif");
            let harga = $(".harga_1").val();
            let bayar = $("#bayar").val(harga);
            let kembalian = parseInt(harga) - parseInt($("#total").val());
            $("#kembalian").val(kembalian);
        } else if (value == 2) {
            $(".type2").addClass("aktif");
            let harga = $(".harga_2").val();
            $("#bayar").val(harga);
            let kembalian = parseInt(harga) - parseInt($("#total").val());
            $("#kembalian").val(kembalian);
        } else if (value == 3) {
            $(".type3").addClass("aktif");
            let harga = $(".harga_3").val();
            $("#bayar").val(harga);
            let kembalian = parseInt(harga) - parseInt($("#total").val());
            $("#kembalian").val(kembalian);
        }
        $(".edc").removeClass("aktif_edc");
        $("#option_cash").val('');
    }

    function change_card() {
        $("#option_cash").val('');
        $(".cash").removeClass("aktif");
        $("#bayar").val($(".harga_1").val());
        let kembalian = parseInt($(".harga_1").val()) - parseInt($("#total").val());
        $("#kembalian").val(kembalian);
    }
    var row_kartu = document.getElementById("kartu");
    var list_edc = row_kartu.getElementsByClassName("edc");
    for (var a = 0; a < list_edc.length; a++) {
        list_edc[a].addEventListener("click", function() {
            $(".edc").removeClass("aktif_edc");
            this.className += " aktif_edc";
        });
    }
    var header = document.getElementById("harganya");
    var btns = header.getElementsByClassName("cash");
    for (var i = 0; i < btns.length; i++) {
        btns[i].addEventListener("click", function() {
            $(".cash").removeClass("aktif");
            this.className += " aktif";

        });
    }

    function option_cash(id) {
        $("#bayar").val('');
        $("#kembalian").val('0');
        $('.cash').removeClass('aktif');
        $(".edc").removeClass("aktif_edc");
    }
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
        let form_transaksi = $(".transaksi").serialize();
        $.ajax({
            url: 'pos/save',
            data: $('.transaksi').serialize() + "&data_json=parsedObj",
            type: 'post',
            success: function(result) {
                console.log(result);
            }
        })
    }

    // var li_links = document.querySelectorAll(".links span");
    // var view_wraps = document.querySelectorAll(".view_wrap");
    // var list_view = document.querySelector(".list-view");
    // var grid_view = document.querySelector(".grid-view");

    // li_links.forEach(function(link) {
    //     link.addEventListener("click", function() {
    //         li_links.forEach(function(link) {
    //             link.classList.remove("active");
    //         })

    //         link.classList.add("active");

    //         var li_view = link.getAttribute("data-view");

    //         view_wraps.forEach(function(view) {
    //             view.style.display = "none";
    //         })

    //         if (li_view == "grid-view") {
    //             grid_view.style.display = "block";
    //         } else {
    //             list_view.style.display = "block";
    //         }
    //     })
    // })
    selectData();

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
            if (present_or_not == -1 || present_or_not == null) {
                var actual_potongan = 0;
                var harga_akhir = parseInt(harga);
                var promo = "";
                var nm_promo = "";
                var jml_potongan = "";
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
                jml_potongan: jml_potongan
            };
            pcart.push(product);
            localStorage.setItem("cart", JSON.stringify(pcart));
            selectData();

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
        selectData();
    }

    function selectData() {
        const str = localStorage.getItem("cart");

        const parsedObj = JSON.parse(str);
        // console.log(parsedObj);

        const total_pesanan = parsedObj.length;

        if (parsedObj != null) {
            let html = '';
            let html2 = '';
            let html3 = '';
            let sno = 1;
            let subtotal = 0;
            let harga2 = 2000;
            for (let i = 0; i < parsedObj.length; i++) {
                let harga_barang = formatRupiah(parsedObj[i].harga_asli, "Rp. ");
                subtotal += parseInt(parsedObj[i].productqty) * parseInt(parsedObj[i].harga_akhir);
                harga2 += parseInt(parsedObj[i].productqty) * parseInt(parsedObj[i].harga_akhir);
                let total_harga = parseInt(parsedObj[i].productqty) * parseInt(parsedObj[i].harga_akhir);
                if (parsedObj[i].productphoto == "") {
                    foto_gambar = "https://ui-avatars.com/api?name=" + `${parsedObj[i].productname}` +
                        "&color=FFF&background=6C757D";
                } else {
                    foto_gambar = "assets/images/product/" + parsedObj[i].productphoto;
                }
                html = html +
                    `
                    <div class="product-details">
                    
                    <div class="d-flex justify-content-between align-items-center items">
                        <div class="d-flex flex-row">
                            <div style="margin-left:10px;">
                                <span class="font-weight-bold d-block name_product"> <b> ${parsedObj[i].productname} </b> </span>
                                <div class="price_product"> <b>  ${parsedObj[i].potongan == "" || parsedObj[i].potongan == 0 ? '' : parsedObj[i].nama_promo+'( potongan '+parsedObj[i].jml_potongan+' )'} </b> </div>
                                <span style="margin-top:10px;" class="price_product ${parsedObj[i].potongan == "" || parsedObj[i].potongan == 0 ? '' : 'coret_harga'}"> <b> ${harga_barang} </b> </span> <span class="price_akhir"> <b> ${parsedObj[i].potongan == "" || parsedObj[i].potongan == 0 ? '' : formatRupiah(`${parsedObj[i].harga_akhir}`, "Rp. ")} </b> </span>
                            </div>
                        </div>
                        <div class="d-flex flex-row align-items-center">
                            <span class="d-block"> 
                                <i class="fa fa-plus-circle update_qty" onclick="plus_qty('${parsedObj[i].productid}')" style="color:green;margin-right:15px;"></i>    
                                <b style="margin-right:10px;">                                     ${parsedObj[i].productqty} </b> 
                                <i class="fa fa-minus-circle update_qty" onclick="minus_qty('${parsedObj[i].productid}')" style="color:red;"></i> 
                            </span>
                            <span class="d-block font-weight-bold" style="margin-left:25px;"> <b> ${formatRupiah(`${total_harga}`, "Rp ")} </b> </span>
                           <a href="javascript:void(0)" onclick="deleteData(${i})"> <i class="fa fa-times delete_item" style="margin-left:10px;margin-right:5px;"></i> </a>
                        </div>
                    </div>
                </div>
                    `;
                sno++;
                // if (parsedObj[i].potongan == "" || parsedObj[i].potongan == 0) {
                //     $("#" + parsedObj[i].productid).removeClass("coret_harga");
                //     document.getElementById("price_akhir").innerHTML = "";
                // } else {
                //     $("#" + parsedObj[i].productid).addClass("coret_harga");
                //     $("#akhir_BRG001").html("coret_harga");

                // }

            }
            if (total_pesanan > 0) {
                html = html +
                    `
                    <div style="margin-bottom:10px;">
                        <div class="hstack gap-3">
                            <div style="margin-left:20px;color:black;"> <b> Subtotal </b> </div>
                            <div class="ms-auto" style="margin-right:35px;"> <b> ${formatRupiah(`${subtotal}`, "Rp ")} </b> </div>
                        </div> 
                    </div>
                    <div style="margin-bottom:10px;">
                        <div class="hstack gap-3">
                            <div style="margin-left:20px;color:black;"> <b> Total </b> </div>
                            <div class="ms-auto" style="margin-right:35px;"> <b> ${formatRupiah(`${subtotal}`, "Rp ")} </b> </div>
                        </div> 
                    </div>
                `;
                document.getElementById("btn_park").style.display = "inline";
                html2 = html2 +
                    `
                    <center>
                        <hr style="width:95%">
                    <p class="delete_all" onclick="hapus_all()"> Hapus keranjang </p>
                    <hr style="width:95%">    
                    </center>
                `
                html2 = html2 +
                    `
                    <center>
                        <button class="btn btn-primary btn-block" type="button" data-bs-toggle="modal"
                            data-bs-target="#exampleModalScrollable" style="width: 97%; ">
                            <div class="hstack gap-3">
                                <div class=""> <i class="fa fa-shopping-bag"></i> ${total_pesanan} Pesanan </div>
                                <div class="vr"></div>
                                <div class="ms-auto"> Pembayaran : ${formatRupiah(`${subtotal}`, "Rp ")} </div>
                            </div>
                        </button>
                    </center>
                `
            } else {
                html2 = html2 +
                    `
                <button class="btn btn-primary disabled btn-block" style="width: 100%; ">
                    <div class="hstack gap-3">
                        <div class=""> <i class="fa fa-shopping-bag"></i> ${total_pesanan} Pesanan </div>
                        <div class="vr"></div>
                        <div class="ms-auto"> Pembayaran : ${formatRupiah(`${subtotal}`, "Rp ")} </div>
                        </div>
                        </button>
                        `
                document.getElementById("btn_park").style.display = "none";
            }
            // element.classList.add("mystyle");
            document.getElementById('root').innerHTML = html;
            document.getElementById('hapus_semua').innerHTML = html2;
            $(".harga1").html(formatRupiah(`${subtotal}`, "Rp "));
            $(".harga2").html(formatRupiah(`${harga2}`, "Rp "));
            $(".harga_1").val(`${subtotal}`);
            $("#total").val(`${subtotal}`);
            $(".harga_2").val(`${harga2}`);
            $(".grandtotal").html(formatRupiah(`${subtotal}`, "Rp "));
            document.getElementsByName('option_cash')[0].placeholder = formatRupiah(`${subtotal}`, "RP ");

        }
    }

    function deleteData(rid) {
        let arr = getCrudData();
        arr.splice(rid, 1);
        setCrudData(arr);
        selectData();
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
        selectData();
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
        selectData();
    }

    function hapus_all() {
        localStorage.setItem("cart", '[]');
        selectData();
    }
</script>
