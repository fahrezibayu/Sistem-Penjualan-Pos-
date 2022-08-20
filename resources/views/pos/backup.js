// Author : Fahrezi Bayu Prabowo
// Sulungsoftdev

$.ajaxSetup({
    headers: {
        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
    },
});
localStorage.setItem('cart', '[]');
localStorage.setItem('data_promo', '[]');
cartData();

function formatRupiah(angka, prefix) {
    var number_string = angka.replace(/[^,\d]/g, '').toString(),
        split = number_string.split(','),
        sisa = split[0].length % 3,
        rupiah = split[0].substr(0, sisa),
        ribuan = split[0].substr(sisa).match(/\d{3}/gi);

    // tambahkan titik jika yang di input sudah menjadi angka ribuan
    if (ribuan) {
        separator = sisa ? '.' : '';
        rupiah += separator + ribuan.join('.');
    }

    rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
    return prefix == undefined ? rupiah : (rupiah ? 'Rp ' + rupiah : '');
}

function tambah_stok(id) {
    Swal.fire({
        title: 'Tambah stok barang',
        input: 'number',
        inputAttributes: {
            autocapitalize: 'off',
            autocomplete: 'off'

        },
        showCancelButton: true,
        cancelButtonText: 'Batal',
        confirmButtonText: 'Tambah',
        showLoaderOnConfirm: true,
        inputValidator: (value) => {
            if (!value) {
                return 'Input qty jangan sampai kosong!'
            }
            if (value <= 0) {
                return 'Qty tidak boleh kurang maupun sama dengan 0'
            }
        },
        preConfirm: (qty) => {
            $.ajax({
                url: 'merchandise/update_stock',
                data: {
                    qty: qty,
                    id: id
                },
                type: 'post',
                success: function(result) {
                    if (result == 'ok') {
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

                        Toast.fire({
                            icon: 'success',
                            title: 'Tambah qty berhasil !'
                        })
                    } else {
                        Swal.showValidationMessage(
                            `Tambah stok gagal.`
                        )
                    }
                }
            })
        },
        allowOutsideClick: () => !Swal.isLoading()
    })
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
                window.location = "/print/receipt/" + id_penjualan;
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

    if (parsedObj != null) {
        let html = '';
        let html2 = '';
        let html3 = '';
        let sno = 1;
        let subtotal = 0;
        let harga2 = 2000;
        let ppn = 0;
        let total = 0;
        for (let i = 0; i < parsedObj.length; i++) {
            let harga_barang = formatRupiah(parsedObj[i].harga_asli, "Rp. ");
            subtotal += parseInt(parsedObj[i].productqty) * parseInt(parsedObj[i].harga_akhir);
            ppn += parseInt(parsedObj[i].productqty) * parseInt(parsedObj[i].harga_akhir) * 10 / 100;
            total += (parseInt(parsedObj[i].productqty) * parseInt(parsedObj[i].harga_akhir)) + (parseInt(parsedObj[i].productqty) * parseInt(parsedObj[i].harga_akhir) * 10 / 100);

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
                <div class="row">
                <div class = "col-5 h6" style="font-size:14px;">
                    ${parsedObj[i].productname}
                </div>
                <div class = "col-4 text-end h6" style="font-size:14px;">
                <b> ${parsedObj[i].productqty} </b> 
                 x ${formatRupiah(`${parsedObj[i].harga_asli}`, "Rp ")}
                </div>
                <div class = "col-3 text-end h6" style="font-size:14px;">
                    ${formatRupiah(`${harga_per_barang}`, "Rp ")} <a href="javascript:void(0)" onclick="deleteData(${i})"> <i class="fa fa-times delete_item"></i> </a>
                </div>
                <div class = "d-flex flex-column mb-3">
                        <em>
                            <div class = "d-flex text-muted" style="font-size:12px;">
                                <div class ="flex-fill"> ${parsedObj[i].potongan == "" || parsedObj[i].potongan == 0 ? '' : parsedObj[i].nama_promo+'( potongan '+parsedObj[i].jml_potongan+' )'}  </div>
                                ${parsedObj[i].promo_type == "" ? '' : parsedObj[i].promo_type == "Diskon Persen" || parsedObj[i].promo_type == "Diskon Menu" ? '( - '+formatRupiah(`${parsedObj[i].productqty * (parsedObj[i].harga_asli * parsedObj[i].potongan / 100) * (-1)}`, "Rp. ")+' )' : '( '+formatRupiah(`${parsedObj[i].productqty * parsedObj[i].potongan}`, "Rp. ")+' )' }
                            </div>
                        </em>
                </div>
            </div>
                    `;
            sno++;
        }
        if (total_pesanan > 0) {
            html = html +
                `
                    <div>
                        <div class="hstack gap-3 h6" style="font-size:14px;">
                            <div> <b> Subtotal </b> </div>
                            <div class="ms-auto"> <b> ${formatRupiah(`${subtotal}`, "Rp ")} </b> </div>
                            <input type="hidden" name="subtotal" id="subtotal" value="${`${subtotal}`}">
                        </div> 
                    </div>
                    <div>
                        <div class="hstack gap-3 h6" style="font-size:14px;">
                            <div> <b> Pajak(10%)  </b> </div>
                            <div class="ms-auto"> <b> ${formatRupiah(`${ppn}`, "Rp ")} </b> </div>
                            <input type="hidden" name="ppn" id="ppn" value="${`${ppn}`}">
                        </div> 
                    </div>
                    <div>
                        <div class="hstack gap-3 h6" style="font-size:14px;">
                            <div> <b> Grandtotal </b> </div>
                            <div class="ms-auto"> <b> ${formatRupiah(`${total}`, "Rp ")} </b> </div>
                        </div> 
                    </div>
                `;
            document.getElementById("btn_park").style.display = "inline";
            html2 = html2 +
                `
                    <center>
                        <hr>
                    <p class="delete_all" onclick="hapus_all()" style="font-size:14px;"> Hapus keranjang </p>
                    <hr>    
                    </center>
                `
            html3 = html3 +
                `
                <div class="d-flex justify-content-center mb-5" style="margin-top:-30px;">
                    <button class="btn btn-primary btn-block" type="button" data-bs-toggle="modal"
                    data-bs-target="#exampleModalScrollable">
                        <div class="hstack gap-3" style="font-size:14px;">
                            <div class=""> <i class="fa fa-shopping-bag"></i> ${total_pesanan} Pesanan </div>
                            <div class="vr"></div>
                            <div class="ms-auto"> Pembayaran : ${formatRupiah(`${total}`, "Rp ")} </div>
                        </div>
                    </button>
                </div>
                `
        } else {
            document.getElementById("btn_park").style.display = "none";
        }
        // element.classList.add("mystyle");
        document.getElementById('cart').innerHTML = html;
        document.getElementById('hapus_semua').innerHTML = html2;
        document.getElementById('btn_pembayaran').innerHTML = html3;
        $(".harga1").html(formatRupiah(`${total}`, "Rp "));
        $(".harga2").html(formatRupiah(`${harga2}`, "Rp "));
        $(".harga_1").val(`${total}`);
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



$('#form_barang').submit(function (e) {
    // e.preventDefault();
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

    Toast.fire({
        icon: 'success',
        title: 'Tambah barang berhasil !'
    })
    $("#modal_barang").modal('hide');
});