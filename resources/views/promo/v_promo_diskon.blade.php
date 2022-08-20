@extends('app')

@section('title', 'Promo Diskon')

@section('content')
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-4 order-md-1 order-last">
                    <h3> Promo Diskon </h3>
                    <p class="text-subtitle text-muted"> Disini Anda dapat menambah, merubah dan menghapus data promo diskon.
                    </p>
                </div>
                <div class="col-12 col-md-4 order-md-2 order-first">
                    <div class="form-group form-group-compose">
                        <!-- compose button  -->
                        <button type="button" class="btn btn-outline-primary btn-block my-4 compose-btn">
                            Riwayat
                        </button>
                    </div>
                </div>
                <div class="col-12 col-md-4 order-md-2 order-first">
                    <div class="form-group form-group-compose">
                        <!-- compose button  -->
                        <a href="{{ url('promo/diskon/tambah') }}">
                            <button type="button" class="btn btn-primary btn-block my-4 compose-btn">
                                Tambahkan Diskon
                            </button>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <hr>
        <section class="section">
            <div class="row" style="margin-top: 35px;">
                <div class="col-md-6">
                    <div class="hstack gap-2">
                        <h4> Berjalan </h4>
                        <p class="text-subtitle text-muted ms-auto" style="margin-top: 15px;"> {{ $count_active }} Berjalan
                        </p>
                    </div>
                    <div class="row">
                        @php
                            $date = date('Y-m-d');
                            function tanggal_indonesia($tanggal)
                            {
                                $bulan = [
                                    1 => 'Januari',
                                    'Februari',
                                    'Maret',
                                    'April',
                                    'Mei',
                                    'Juni',
                                    'Juli',
                                    'Agustus',
                                    'September',
                                    'Oktober',
                                    'November',
                                    'Desember',
                                ];
                                $tanggalan = explode('-', $tanggal);
                                return $tanggalan[2] . ' ' . $bulan[(int) $tanggalan[1]] . ' ' . $tanggalan[0];
                            }
                        @endphp
                        @foreach ($promo as $row)
                            @if ($date >= $row->periode_awal && $date <= $row->periode_akhir)
                                <div class="col-md-12">
                                    <div class="card">
                                        <div class="card-header">
                                            <div class="hstack gap-2">
                                                <h4> <b> {{ $row->nama_promo }} </b> </h4>
                                                <span class="badge bg-success ms-auto"> Aktif </span>
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <div class="hstack gap-3">
                                                <h6>
                                                    Periode <br>
                                                    <p class="text-subtitle text-muted">
                                                        {{ date('d', strtotime($row->periode_awal)) }} -
                                                        {{ tanggal_indonesia($row->periode_akhir) }} </p>
                                                </h6>
                                                <h6 class="mx-auto">
                                                    <b> Tipe </b> <br>
                                                    <p class="text-subtitle text-muted"> {{ $row->tipe_promo }} </p>
                                                </h6>
                                                <h6 class="ms-auto">
                                                    <b> Jumlah </b> <br>
                                                    @if ($row->tipe_promo == 'Diskon Nominal')
                                                        @if ($row->nominal == null || $row->persen != null)
                                                            <p class="text-subtitle text-muted"> {{ $row->persen }} % </p>
                                                        @endif
                                                        @if ($row->nominal != null || $row->persen == null)
                                                            <p class="text-subtitle text-muted"> Rp.
                                                                {{ number_format($row->nominal, 0, ',', '.') }} </p>
                                                        @endif
                                                    @else
                                                        <p class="text-subtitle text-muted"> {{ $row->total_menu }} Menu
                                                        </p>
                                                    @endif
                                                </h6>
                                            </div>
                                            <button class="btn btn-primary btn-block"> Detail </button>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="hstack gap-2">
                        <h4> Mendatang </h4>
                        <p class="text-subtitle text-muted ms-auto" style="margin-top: 15px;"> {{ $count_pending }}
                            Mendatang </p>
                    </div>
                    <div class="row">
                        @foreach ($promo as $row)
                            @if ($date < $row->periode_awal)
                                <div class="col-md-12">
                                    <div class="card">
                                        <div class="card-header">
                                            <div class="hstack gap-2">
                                                <h4> <b> {{ $row->nama_promo }} </b> </h4>
                                                <span class="badge bg-warning ms-auto"> Pending </span>
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <div class="hstack gap-3">
                                                <h6>
                                                    Periode <br>
                                                    <p class="text-subtitle text-muted">
                                                        {{ date('d', strtotime($row->periode_awal)) }} -
                                                        {{ tanggal_indonesia($row->periode_akhir) }} </p>
                                                </h6>
                                                <h6 class="mx-auto">
                                                    <b> Tipe </b> <br>
                                                    <p class="text-subtitle text-muted"> {{ $row->tipe_promo }} </p>
                                                </h6>
                                                <h6 class="ms-auto">
                                                    <b> Jumlah </b> <br>
                                                    @if ($row->tipe_promo == 'Diskon Nominal')
                                                        @if ($row->nominal == null || $row->persen != null)
                                                            <p class="text-subtitle text-muted"> {{ $row->persen }} % </p>
                                                        @endif
                                                        @if ($row->nominal != null || $row->persen == null)
                                                            <p class="text-subtitle text-muted"> Rp.
                                                                {{ number_format($row->nominal, 0, ',', '.') }} </p>
                                                        @endif
                                                    @else
                                                        <p class="text-subtitle text-muted"> {{ $row->total_menu }} Menu
                                                        </p>
                                                    @endif
                                                </h6>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <button class="btn btn-primary btn-block"> Detail </button>
                                                </div>
                                                <div class="col-md-6">
                                                    <button class="btn btn-outline-danger btn-block"> Batalkan </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                            @endif
                        @endforeach
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
