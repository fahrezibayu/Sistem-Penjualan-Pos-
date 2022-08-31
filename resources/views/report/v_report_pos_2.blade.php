@extends('app')

@section('title', ' Laporan Penjualan ')

@section('content')
    <div class="row">
        <div class="col-12 col-lg-12">

            <div class="page-heading">
                <h3>
                    @yield('title')
                </h3>
                <span class="text-muted"> Dibawah ini adalah data penjualan yang ditampilkan per-hari. </span>
            </div>
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
    <div class="page-content">
        <section>
            <div class="col-12 col-lg-4">
                <div class="card">
                    <div class="card-body px-3 py-4-5">
                        <div class="row">
                            <div class="col-4 col-md-4">
                                <div class="stats-icon blue">
                                    <i class="fa bi-cash"></i>
                                </div>
                            </div>
                            <div class="col-8 col-md-8">
                                <h6 class="text-muted font-semibold"> Total Tunai </h6>
                                <h6 class="font-extrabold mb-0"> Rp{{ singkat_angka($tunai->pendapatan) }}
                                </h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12 col-lg-4">
                <div class="card">
                    <div class="card-body px-3 py-4-5">
                        <div class="row">
                            <div class="col-4 col-md-4">
                                <div class="stats-icon purple">
                                    <i class="fa bi-credit-card-2-front"></i>
                                </div>
                            </div>
                            <div class="col-8 col-md-8">
                                <h6 class="text-muted font-semibold"> Total Non Tunai </h6>
                                <h6 class="font-extrabold mb-0"> Rp{{ singkat_angka($nontunai->pendapatan) }} </h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12 col-lg-4">
                <div class="card">
                    <div class="card-body px-3 py-4-5">
                        <div class="row">
                            <div class="col-4 col-md-4">
                                <div class="stats-icon green">
                                    <i class="fa bi-cash-stack"></i>
                                </div>
                            </div>
                            <div class="col-8 col-md-8">
                                <h6 class="text-muted font-semibold"> Total Penjualan </h6>
                                <h6 class="font-extrabold mb-0"> Rp{{ singkat_angka($all->pendapatan) }}
                                </h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12 mt-2">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table nowrap" id="table1">
                                <thead>
                                    <tr>
                                        <th> No </th>
                                        <th> Nomor Bill </th>
                                        <th> Tanggal </th>
                                        <th> Jam </th>
                                        <th> Kasir </th>
                                        <th> Jenis Pembayaran </th>
                                        <th> Subtotal </th>
                                        <th> PPN </th>
                                        <th> Total </th>
                                        <th> Bayar </th>
                                        <th> Kembalian </th>
                                        <th> Act </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $no = 1;
                                        $dayList = [
                                            'Sun' => 'Ming',
                                            'Mon' => 'Sen',
                                            'Tue' => 'Sel',
                                            'Wed' => 'Rab',
                                            'Thu' => 'Kam',
                                            'Fri' => 'Jum',
                                            'Sat' => 'Sab',
                                        ];
                                    @endphp
                                    @foreach ($pos as $row)
                                        @php
                                            $day_penjualan = date('D', strtotime($row->tgl_transaksi));
                                            $tgl_penjualan = date('d F Y', strtotime($row->tgl_transaksi));
                                            $jam_penjualan = date('H:i', strtotime($row->created_at));
                                        @endphp
                                        <tr>
                                            <td> {{ $no++ }} </td>
                                            <td> {{ $row->id_penjualan }} </td>
                                            <td> {{ $dayList[$day_penjualan] . ', ' . $tgl_penjualan }} </td>
                                            <td> {{ $jam_penjualan }} </td>
                                            <td> {{ $row->tb_user->name }} </td>
                                            @if ($row->jenis_pembayaran == 'Tunai')
                                                <td> <span class="badge bg-success"> Tunai </span> </td>
                                            @else
                                                <td> <span class="badge bg-danger"> Non-Tunai </span> </td>
                                            @endif
                                            <td> Rp. {{ number_format($row->subtotal, 0, ',', '.') }} </td>
                                            <td> Rp. {{ number_format($row->ppn, 0, ',', '.') }} </td>
                                            <td> Rp. {{ number_format($row->total, 0, ',', '.') }} </td>
                                            <td> Rp. {{ number_format($row->bayar, 0, ',', '.') }} </td>
                                            <td> Rp. {{ number_format($row->kembalian, 0, ',', '.') }} </td>
                                            <td>
                                                <a href="{{ url('/report/pos/detail', $row->id_penjualan) }}">
                                                    <button class="btn btn-info btn-sm" type="button"> <i
                                                            class="fa fa-info"></i> </button>
                                                </a>
                                                <a href="{{ url('/print/receipt', $row->id_penjualan) }}">
                                                    <button class="btn btn-success btn-sm" type="button"> <i
                                                            class="fa fa-print"></i> </button>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
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
