<!--
    Author : Nabiel Mada
    Sulungsoftdev
    Templating Print Struck Aug 2022
 -->

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Print Struck </title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <style type="text/css">
        @page {
            size: auto;
            margin: 5mm;
        }

        #text-resize {
            font-size: small;
        }

        .w-30 {
            max-width: 40%;
        }

        .img-resize {
            width: 25%;
            border-radius: 50%;
        }
    </style>

</head>

<body>
    @php
        $dayList = [
            'Sun' => 'Ming',
            'Mon' => 'Sen',
            'Tue' => 'Sel',
            'Wed' => 'Rab',
            'Thu' => 'Kam',
            'Fri' => 'Jum',
            'Sat' => 'Sab',
        ];
        $day_penjualan = date('D', strtotime($penjualan->tgl_transaksi));
        $tgl_penjualan = date('d F Y', strtotime($penjualan->tgl_transaksi));
        $jam_penjualan = date('H:i', strtotime($penjualan->created_at));
    @endphp
    <div id="text-resize" class="container w-30 mt-5 mb-5">
        <div class="d-flex flex-column align-items-center">
            @if ($struck->logo == '')
                <img src="https://ui-avatars.com/api?name={{ $struck->nama_outlet }}&color=7FCF5&background=EBF4FF"
                    class="img-resize" alt="logo-toko">
            @else
                <img src="{{ asset('assets/images/logo/struck') }}/{{ $struck->logo }}" class="img-resize"
                    alt="logo-toko">
            @endif
            <h5 class="mt-3"> {{ $struck->nama_outlet }} </h5>
            <span class="text-center mb-4"> {{ $struck->alamat }} <br />
                {{ $struck->kota . ', ' . $struck->kodepos }} </span>
        </div>

        <div class="d-flex">
            <div class="flex-fill bi bi-telephone"> {{ $struck->telp }} </div>
            <div class="bi bi-phone"> {{ $struck->nohp }} </div>
        </div>
        <hr />

        <!-- Sub Head -->
        <div class="row row-cols-2 g-1">
            <div class="col"> {{ $dayList[$day_penjualan] }}, {{ $tgl_penjualan }}</div>
            <div class="col text-end"> {{ $jam_penjualan }} </div>

            <div class="col">Nomor Bill</div>
            <div class="col text-end"> {{ $id_penjualan }} </div>

            <div class="col">Kasir</div>
            <div class="col text-end"> {{ $penjualan->tb_user->name }} </div>

            <div class="col">Pelanggan</div>
            <div class="col text-end"> Fahrezi Bayu </div>
        </div>

        <hr />

        <!-- Body -->
        <div class="row">
            @foreach ($detail_penjualan as $row)
                <div class="col-12 h6">
                    {{ $row->nama_barang }}
                </div>
                <div class="col-7 text-end">
                    {{ $row->qty }} x Rp.{{ number_format($row->harga_barang, 0, ',', '.') }}
                </div>
                <div class="col-5 text-end" style="font-size: 14px;">
                    Rp. {{ number_format($row->qty * $row->harga_barang, 0, ',', '.') }}
                </div>

                @if ($row->id_promo != null)
                    <!-- Modifier/Penambahan  -->
                    <!-- Modifier/Penambahan -->
                    @php
                        $promo = DB::table("tbl_promo")
                        ->join("tbl_detail_promo", "tbl_promo.id_promo", "=", "tbl_detail_promo.id_promo")
                        ->select(DB::raw("tbl_promo.*,tbl_detail_promo.*"))
                        ->where('tbl_detail_promo.id_promo',$row->id_promo)
                        ->where('tbl_detail_promo.id_barang',$row->id_barang)
                        ->get();
                    @endphp
                    @foreach ($promo as $row2)
                    <div class="d-flex flex-column mb-3">
                        <em>
                            <div class="d-flex">
                                @php
                                    if ($row2->tipe_promo == 'Diskon Nominal') {
                                        echo '<div class="flex-fill">' . $row2->nama_promo . '( Rp. ' . number_format($row2->nominal, 0, ',', '.') . ' ) </div>';
                                        $potongan = $row->qty * $row2->nominal;
                                    } else {
                                        echo '<div class="flex-fill">' . $row2->nama_promo . '( ' . $row2->persen . '% ) </div>';
                                        $potongan = $row->qty * (($row->harga_barang * $row2->persen) / 100);
                                    }
                                @endphp
                                ( Rp. -{{ number_format($potongan, 0, ',', '.') }} )
                            </div>
                        </em>
                    </div>
                    @endforeach
                @endif
            @endforeach
        </div>

        <hr />

        <!-- Body 2 -->
        <div class="row row-cols-2 g-1">
            <div class="col">Sub Total</div>
            <div class="col text-end"> Rp. {{ number_format($penjualan->subtotal, 0, ',', '.') }} </div>

            <div class="col">Pajak(10%)</div>
            <div class="col text-end"> Rp. {{ number_format($penjualan->ppn, 0, ',', '.') }} </div>
        </div>

        <hr />

        <!-- Body 2 -->
        <div class="row row-cols-2 g-1">

            <div class="col fs-6 fw-bold">Total</div>
            <div class="col text-end fs-6 fw-bold"> Rp. {{ number_format($penjualan->total, 0, ',', '.') }} </div>

            @if ($penjualan->jenis_pembayaran == 'Tunai')
                <div class="col">Bayar( Tunai )</div>
                <div class="col text-end"> Rp. {{ number_format($penjualan->bayar, 0, ',', '.') }} </div>
            @else
                <div class="col">Bayar( {{ $penjualan->edc->nama_edc }} )</div>
                <div class="col text-end"> Rp. {{ number_format($penjualan->bayar, 0, ',', '.') }} </div>
            @endif




            <div class="col">Kembalian</div>
            <div class="col text-end"> Rp. {{ number_format($penjualan->kembalian, 0, ',', '.') }} </div>

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

    <script>
        window.print();
    </script>
</body>


</html>
