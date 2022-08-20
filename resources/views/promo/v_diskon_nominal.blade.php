@extends('app')

@section('title', 'Tambah Promo Diskon')

@section('content')
    <style>
        #partitioned {
            border: none;
            width: 7.4ch;
            background:
                repeating-linear-gradient(90deg,
                    #25396f 0,
                    #25396f 1ch,
                    transparent 0,
                    transparent 1.5ch) 0 100%/100% 2px no-repeat;
            color: dimgrey;
            font: 2.5ch Nunito;
            font-weight: bold;
            letter-spacing: .5ch;
        }

        #partitioned:focus {
            outline: none;
        }

        .harga_asli {
            text-decoration: line-through;
            font-size: 16px;
        }

        .form-check-input:hover {
            cursor: pointer;
        }

        .f1-steps {
            overflow: hidden;
            position: relative;
            margin-top: 20px;
            /* margin-left: 53px; */
        }

        .f1-progress {
            position: absolute;
            top: 24px;
            left: 0;
            width: 100%;
            height: 1px;
            background: #ddd;
        }

        .f1-progress-line {
            position: absolute;
            top: 0;
            left: 0;
            height: 1px;
            background: #435ebe;
        }

        .f1-step {
            position: relative;
            float: left;
            width: 50%;
            padding: 0 5px;
        }

        .f1-step-icon {
            display: inline-block;
            width: 40px;
            height: 40px;
            margin-top: 4px;
            background: #ddd;
            font-size: 16px;
            color: #fff;
            line-height: 40px;
            -moz-border-radius: 50%;
            -webkit-border-radius: 50%;
            border-radius: 50%;
            background: #435ebe;

        }

        .f1-step.activated .f1-step-icon {
            background: #fff;
            border: 1px solid #435ebe;
            color: #435ebe;
            line-height: 38px;
        }

        .f1-step.active .f1-step-icon {
            width: 48px;
            height: 48px;
            margin-top: 0;
            background: #435ebe;
            font-size: 22px;
            line-height: 48px;
        }

        .f1-step p {
            color: #25396f;
        }

        .f1-step.activated p {
            color: #25396f;
        }

        .f1-step.active p {
            color: #25396f;
        }

        .f1 fieldset {
            display: none;
            text-align: left;
        }

        .f1-buttons {
            text-align: right;
        }

        .f1 .input-error {
            border-color: #f35b3f;
        }
    </style>
    <div class="page-heading">
        <section class="section">
            <form class="f1" autocomplete="off">
                <!-- step 1 -->
                <fieldset>
                    <div class="row">
                        <div class="col-md-3"></div>
                        <div class="col-md-6">
                            <center>
                                <div class="f1-step-icon mb-3"><i class="fa fa-cutlery"></i></div>
                                <h6 class="text-muted text-subtitle mb-1"> Diskon Menu </h6>
                                <h4 class="mb-4"> Pilih Menu </h4>
                            </center>
                            <div class="form-group">
                            </div>
                            <h6> <b> Pencarian </b> </h6>
                            <div class="form-group position-relative has-icon-right mb-3">
                                <input type="text" name="search_menu" id="search_menu" class="form-control"
                                    placeholder="Search Menu">
                                <div class="form-control-icon">
                                    <i class="bi bi-search"></i>
                                </div>
                            </div>
                            <div id="list">
                                @foreach ($merchandise as $row)
                                    <div class="card" style="margin-bottom: 15px;">
                                        <div class="card-body">
                                            <div class="d-flex justify-content-between align-items-center items">
                                                <div class="d-flex flex-row"> <img
                                                        src="{{ asset('assets/images/product') }}/{{ $row->foto }}"
                                                        style="border-radius: 50px;" height="70" width="70">
                                                    <div style="margin-left:15px;">
                                                        <span class="h5"> <b class="nama_brg">
                                                                {{ $row->nama_barang }} </b>
                                                        </span>
                                                        <p class="text-subtitle text-muted" style="font-size: 18px;"> <b> Rp
                                                                {{ number_format($row->harga_barang) }}
                                                            </b>
                                                        </p>
                                                    </div>
                                                </div>
                                                <div class="d-flex flex-row align-items-center">
                                                    <div class="form-check">
                                                        <div class="custom-control custom-checkbox">
                                                            <input type="checkbox"
                                                                class="form-check-input form-check-primary"
                                                                name="customCheck[]" id="customColorCheck1"
                                                                id_barang="{{ $row->id_barang }}"
                                                                nama_barang="{{ $row->nama_barang }}"
                                                                harga_barang="{{ $row->harga_barang }}"
                                                                foto_barang="{{ $row->foto }}">
                                                            <label class="form-check-label" for="customColorCheck1"> Pilih
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <a href="{{ url('promo/diskon/tambah') }}">
                                        <button class="btn btn-outline-secondary btn-block" type="button"> Kembali
                                        </button>
                                    </a>
                                </div>
                                <div class="col-md-6">
                                    <button class="btn btn-primary btn-block btn-next" type="button"> Lanjut </button>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3"></div>
                    </div>
                </fieldset>
                <!-- step 2 -->
                <fieldset>
                    <center>
                        <div class="f1-step-icon mb-3"><i class="fa fa-gift"></i></div>
                        <h6 class="text-muted text-subtitle mb-1"> Diskon Menu </h6>
                        <h4 class="mb-4"> Terapkan Diskon </h4>
                    </center>
                    <div class="row">
                        <div class="col-md-3">
                        </div>
                        <div class="col-md-6">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group" style="margin-top:35px;">
                                        <h6> <b> Judul Promo </b> </h6>
                                        <input type="text" placeholder="Masukan judul promo" name="judul_promo"
                                            id="judul_promo" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group mt-6">
                                        <h6> <b> Dari </b> </h6>
                                        <input type="text" placeholder="tgl/bln/thn" name="dari" id="date"
                                            class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <h6> <b> Hinga </b> </h6>
                                        <input type="text" id="date2" placeholder="tgl/bln/thn" name="hingga"
                                            class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <h6> <b> Diskon Nominal(Rp) </b> </h6>
                                        <input type="text" id="potongan" placeholder="Masukan diskon nominal"
                                            name="potongan" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <button class="btn btn-outline-secondary btn-block btn-previous" type="button">
                                        Kembali </button>
                                </div>
                                <div class="col-md-6">
                                    <button class="btn btn-primary btn-block btn-submit" type="button"> Simpan </button>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3"></div>
                    </div>
                </fieldset>
            </form>
        </section>
    </div>
    <script>
        localStorage.setItem("list_menu", "[]");
        var input = document.getElementById("search_menu");
        input.addEventListener("input", myFunction);

        function myFunction(e) {
            var filter = e.target.value.toUpperCase();
            // alert(filter);
            var list = document.getElementById("list");
            var divs = list.getElementsByClassName("card");
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

        function selectData() {
            const str = localStorage.getItem("list_menu");

            const parsedObj = JSON.parse(str);
            // console.log(parsedObj);

            const total_pesanan = parsedObj.length;

            if (parsedObj != null) {
                let html = '';
                let sno = 1;
                for (let i = 0; i < parsedObj.length; i++) {
                    let harga_menu = formatRupiah(parsedObj[i].harga_menu, "Rp. ");
                    if (parsedObj[i].foto_menu == "") {
                        foto_gambar = "https://ui-avatars.com/api?name=" + `${parsedObj[i].nama_menu}` +
                            "&color=FFF&background=6C757D";
                    } else {
                        foto_gambar = "{{ url('assets/images/product') }}/" + parsedObj[i].foto_menu;
                    }
                    html = html +
                        `
                        <div class="card" style="margin-bottom: 15px;">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center items">
                                    <div class="d-flex flex-row" style="margin-top: 10px;"> <img
                                            src=${foto_gambar} style="border-radius: 50px;" height="70"
                                            width="70">
                                        <div style="margin-left:15px;">
                                            <span style="font-size: 20px; color:#25396f;"> <b> ${parsedObj[i].nama_menu} </b>
                                            </span>
                                            <p class="text-subtitle text-muted" style="font-size: 18px;margin-top:9px;">
                                                <b> <span class="${parsedObj[i].id_menu}">${harga_menu}</span> </b> <span style="margin-left: 10px; color:#25396f"> <b> <span class="potongan_${parsedObj[i].id_menu}"></span> </b> </span>
                                            </p>
                                        </div>
                                    </div>
                                    <div style="margin-top: -16px;">
                                        <div class="d-flex flex-row align-items-center">
                                            <span style="font-size: 20px; color:#25396f">
                                                <center> <b> Diskon % </b> </center>
                                            </span>
                                        </div>
                                        <div class="d-flex flex-row align-items-center">
                                            <input maxlength='3' kode_menu='${parsedObj[i].id_menu}' id="partitioned" harga_asli="${parsedObj[i].harga_menu}" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    `;
                    sno++;
                }
                document.getElementById('menu_promo').innerHTML = html;
            }
        }

        function scroll_to_class(element_class, removed_height) {
            var scroll_to = $(element_class).offset().top - removed_height;
            if ($(window).scrollTop() != scroll_to) {
                $('html, body').stop().animate({
                    scrollTop: scroll_to
                }, 0);
            }
        }

        function bar_progress(progress_line_object, direction) {
            var number_of_steps = progress_line_object.data('number-of-steps');
            var now_value = progress_line_object.data('now-value');
            var new_value = 0;
            if (direction == 'right') {
                new_value = now_value + (100 / number_of_steps);
            } else if (direction == 'left') {
                new_value = now_value - (100 / number_of_steps);
            }
            progress_line_object.attr('style', 'width: ' + new_value + '%;').data('now-value', new_value);
        }

        $(document).ready(function() {
            // Form
            $('.f1 fieldset:first').fadeIn('slow');

            $('.f1 input[type="checkbox"], .f1 input[type="password"], .f1 textarea').on('focus', function() {
                $(this).removeClass('input-error');
            });

            // step selanjutnya (ketika klik tombol selanjutnya)
            $('.f1 .btn-next').on('click', function() {
                var parent_fieldset = $(this).parents('fieldset');
                var next_step = true;
                // navigation steps / progress steps
                var current_active_step = $(this).parents('.f1').find('.f1-step.active');
                var progress_line = $(this).parents('.f1').find('.f1-progress-line');

                var check_menu = JSON.parse(localStorage.getItem("list_menu"));
                if (check_menu.length == 0) {
                    next_step = false;
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
                        icon: 'error',
                        title: 'Silahkan pilih menu terlebih dahulu !'
                    })
                }


                if (next_step) {
                    parent_fieldset.fadeOut(400, function() {
                        // change icons
                        current_active_step.removeClass('active').addClass('activated').next()
                            .addClass('active');
                        // progress bar
                        bar_progress(progress_line, 'right');
                        // show next step
                        $(this).next().fadeIn();
                        // scroll window to beginning of the form
                        scroll_to_class($('.f1'), 20);
                    });
                    selectData();
                }
            });

            // step sbelumnya (ketika klik tombol sebelumnya)
            $('.f1 .btn-previous').on('click', function() {
                // navigation steps / progress steps
                var current_active_step = $(this).parents('.f1').find('.f1-step.active');
                var progress_line = $(this).parents('.f1').find('.f1-progress-line');

                $(this).parents('fieldset').fadeOut(400, function() {
                    // change icons
                    current_active_step.removeClass('active').prev().removeClass('activated')
                        .addClass('active');
                    // progress bar
                    bar_progress(progress_line, 'left');
                    // show previous step
                    $(this).prev().fadeIn();
                    // scroll window to beginning of the form
                    scroll_to_class($('.f1'), 20);
                });
            });

            $('.f1 .btn-submit').on('click', function() {
                // validasi form
                if ($("#judul_promo").val() == "" || $("#date").val() == "" || $("#date2").val() == "") {
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
                        icon: 'error',
                        title: 'Silahkan lengkapi form terlebih dahulu !'
                    })
                } else {
                    const str = localStorage.getItem("list_menu");
                    const parsedObj = JSON.parse(str);
                    let judul_promo = $("#judul_promo").val();
                    let date1 = $("#date").val();
                    let date2 = $("#date2").val();
                    let potongan = $("#potongan").val();
                    $.ajax({
                        url: "{{ url('promo/diskon/diskon_nominal/save') }}",
                        data: {
                            list_menu: parsedObj,
                            judul_promo: judul_promo,
                            date1: date1,
                            date2: date2,
                            potongan: potongan
                        },
                        type: 'post',
                        success: function(result) {
                            const Toast = Swal.mixin({
                                toast: true,
                                position: 'top-end',
                                showConfirmButton: false,
                                timer: 3000,
                                timerProgressBar: true,
                                didOpen: (toast) => {
                                    toast.addEventListener(
                                        'mouseenter', Swal
                                        .stopTimer)
                                    toast.addEventListener(
                                        'mouseleave', Swal
                                        .resumeTimer)
                                }
                            })
                            Toast.fire({
                                icon: 'success',
                                title: 'Penambahan promo <b>' +
                                    judul_promo + "</b> berhasil"
                            });
                            setInterval(() => {
                                document.location =
                                    "{{ url('promo/diskon') }}";
                            }, 3000);
                        }
                    })
                }
            });
            // submit (ketika klik tombol submit diakhir wizard)
            // $('.f1').on('submit', function(e) {
            // });
        });
        $("body").on("click", "#customColorCheck1", function() {
            let checkbox = $(this).prop("checked");
            let id = $(this).attr("id_barang");
            let nama = $(this).attr("nama_barang");
            let harga = $(this).attr("harga_barang");
            let foto = $(this).attr("foto_barang");
            var list_menu = localStorage.getItem("list_menu");
            var pmenu = JSON.parse(list_menu) != null ? JSON.parse(list_menu) : [];
            let menu = document.getElementsByName("customCheck[]")
            if (checkbox == true) {
                $.ajax({
                    url: "{{ url('promo/diskon/data_detail_promo') }}",
                    dataType: 'json',
                    success: function(result) {
                        // console.log(result.data);
                        let data_promo = result.data;
                        var cek_barang = data_promo.findIndex(item => item.id_barang == id);
                        console.log(cek_barang);
                        console.log(data_promo);
                        if (cek_barang == -1) {
                            // alert('tidak ada');
                            var list = {
                                id_menu: id,
                                nama_menu: nama,
                                harga_menu: harga,
                                foto_menu: foto,
                                potongan: 0
                            };
                            pmenu.push(list);
                            localStorage.setItem("list_menu", JSON.stringify(pmenu));
                        } else {
                            $(this).prop('checked', false).removeAttr('checked');
                            const Toast = Swal.mixin({
                                toast: true,
                                position: 'top-end',
                                showConfirmButton: false,
                                timer: 3000,
                                timerProgressBar: true,
                                didOpen: (toast) => {
                                    toast.addEventListener(
                                        'mouseenter', Swal
                                        .stopTimer)
                                    toast.addEventListener(
                                        'mouseleave', Swal
                                        .resumeTimer)
                                }
                            })
                            Toast.fire({
                                icon: 'error',
                                title: 'Menu <b>' +
                                    nama + "</b> masih ada di dalam promo aktif !"
                            });
                        }

                    },
                    error: function(xhr, status, msg) {
                        console.log('status : ' + status + "\n" + msg);
                    }
                })
            } else {
                const detail_menu = JSON.parse(localStorage.getItem("list_menu"));
                var detail_barang = detail_menu.findIndex(item => item.id_menu == id);
                let hitung = 0;
                for (let i = 0; i < detail_menu.length; i++) {
                    if (detail_menu[i].id_menu == id) {
                        hitung += [i].length;
                    }
                }
                detail_menu.splice(detail_barang, hitung);
                localStorage.setItem('list_menu', JSON.stringify(detail_menu));
            }
        })
    </script>
@endsection
