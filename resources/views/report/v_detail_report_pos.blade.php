@extends('app')

@section('title', ' Detail Laporan Penjualan')

@section('content')
    <style type="text/css">
        @page {
            size: auto;
            margin: 5mm;
        }

        #text-resize {
            font-size: small;
        }

        .w-30 {
            max-width: 110%;
        }

        .img-resize {
            width: 25%;
            border-radius: 50%;
        }
    </style>
    <div class="page-heading">
        <div class="page-title mb-5">
            <div class="row">
                <div class="col-12 col-md-12 order-md-1 order-last">
                    <a href="{{ url('report/pos') }}">
                        <h5> <i class="fa fa-arrow-left"></i> Kembali </h5>
                    </a>
                </div>
            </div>
        </div>
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
        <section class="section">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3> @yield('title') </h3>
                    <p class="text-subtitle text-muted"> Disini Anda dapat melihat @yield('title'). </p>
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12 mb-3">
                                    <h6> Nomor Bill </h6>
                                    <input type="text" readonly value="{{ $penjualan->id_penjualan }}" required
                                        class="form-control">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <h6> Tanggal Transaksi </h6>
                                    <input type="text" readonly
                                        value="{{ $dayList[$day_penjualan] }}, {{ $tgl_penjualan }}" required
                                        class="form-control">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <h6> Jam </h6>
                                    <input type="text" readonly
                                        value="{{ $jam_penjualan }}" required
                                        class="form-control">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <h6> Kasir </h6>
                                    <input type="text" readonly value="{{ $penjualan->tb_user->name }}" required
                                        class="form-control">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <h6> Jenis Pembayaran </h6>
                                    <input type="text" readonly value="{{ $penjualan->jenis_pembayaran }}"
                                        class="form-control">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <div class="card">
                        <div class="card-body">
                            <div id="text-resize" class="container w-30 mt-5 mb-5">
                                <div class="d-flex flex-column align-items-center">
                                    @if ($struck->logo == '')
                                        <img src="https://ui-avatars.com/api?name={{ $struck->nama_outlet }}&color=7FCF5&background=EBF4FF"
                                            class="img-resize" alt="logo-toko">
                                    @else
                                        <img src="{{ asset('assets/images/logo/struck') }}/{{ $struck->logo }}"
                                            class="img-resize" alt="logo-toko">
                                    @endif
                                    <h5 class="mt-3"> {{ $struck->nama_outlet }} </h5>
                                    <span class="text-center mb-4"> {{ $struck->alamat }} <br />
                                        {{ $struck->kota . ', ' . $struck->kodepos }} </span>
                                </div>
                                <br>
                                <div class="hstack gap-2">
                                    <div>
                                        <i class="bi bi-phone"> {{ $struck->nohp }} </i>
                                    </div>
                                    <div class="ms-auto">
                                        <i class="bi bi-telephone"> {{ $struck->telp }} </i>
                                    </div>
                                </div>
                                <hr />

                                <!-- Sub Head -->
                                <div class="row row-cols-2 g-1">
                                    <div class="col"> {{ $dayList[$day_penjualan] }}, {{ $tgl_penjualan }} </div>
                                    <div class="col text-end"> {{ $jam_penjualan }} </div>

                                    <div class="col">Nomor Bill</div>
                                    <div class="col text-end"> {{ $id_penjualan }} </div>

                                    <div class="col">Kasir</div>
                                    <div class="col text-end"> {{ $penjualan->tb_user->name }} </div>

                                    <div class="col">Pelanggan</div>
                                    <div class="col text-end">Fahrezi Bayu</div>
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

                                        @if ($row->promo_penjualan != null)
                                            <!-- Modifier/Penambahan  -->
                                            <div class="d-flex flex-column mb-3">
                                                <em>
                                                    <div class="d-flex">
                                                        @php
                                                            if ($row->tipe_promo == 'Diskon Nominal') {
                                                                echo '<div class="flex-fill">' . $row->nama_promo . '( Rp. ' . number_format($row->nominal, 0, ',', '.') . ' ) </div>';
                                                                $potongan = $row->qty * $row->nominal;
                                                            } else {
                                                                echo '<div class="flex-fill">' . $row->nama_promo . '( ' . $row->persen . '% ) </div>';
                                                                $potongan = $row->qty * (($row->harga_barang * $row->persen) / 100);
                                                            }
                                                        @endphp
                                                        (Rp. -{{ number_format($potongan, 0, ',', '.') }})
                                                    </div>
                                                </em>
                                            </div>
                                            <!-- Modifier/Penambahan -->
                                            {{-- @foreach ($promo as $row2)
                                            @endforeach --}}
                                        @endif
                                    @endforeach
                                </div>

                                <hr />

                                <!-- Body 2 -->
                                <div class="row row-cols-2 g-1">
                                    <div class="col">Sub Total</div>
                                    <div class="col text-end"> Rp. {{ number_format($penjualan->subtotal, 0, ',', '.') }}
                                    </div>

                                    <div class="col">Pajak(10%)</div>
                                    <div class="col text-end"> Rp. {{ number_format($penjualan->ppn, 0, ',', '.') }} </div>
                                </div>

                                <hr />

                                <!-- Body 2 -->
                                <div class="row row-cols-2 g-1">

                                    <div class="col fs-6 fw-bold">Total</div>
                                    <div class="col text-end fs-6 fw-bold"> Rp.
                                        {{ number_format($penjualan->total, 0, ',', '.') }} </div>


                                    @if ($penjualan->jenis_pembayaran == 'Tunai')
                                        <div class="col">Bayar( Tunai )</div>
                                        <div class="col text-end"> Rp. {{ number_format($penjualan->bayar, 0, ',', '.') }}
                                        </div>
                                    @else
                                        <div class="col">Bayar( {{ $penjualan->edc->nama_edc }} )</div>
                                        <div class="col text-end"> Rp. {{ number_format($penjualan->bayar, 0, ',', '.') }}
                                        </div>
                                    @endif


                                    <div class="col">Kembalian</div>
                                    <div class="col text-end"> Rp. {{ number_format($penjualan->kembalian, 0, ',', '.') }}
                                    </div>

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
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
