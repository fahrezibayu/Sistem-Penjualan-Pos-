@extends('app')

@section('title', ' Laporan Mesin Edc ')

@section('content')
    <div class="row">
        <div class="col-12 col-lg-12">

            <div class="page-heading">
                <h3>
                    @yield('title')
                </h3>
                <span class="text-muted"> Dibawah ini adalah data mesin edc yang ditampilkan per-bulan. </span>
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
            <form action="{{ url('report/edc/search') }}" method="post">
                @csrf
                <div class="row g-3">
                    <div class="col-md-6 col-6">
                        <label> Dari </label>
                        <input type="text" name="date1" id="date" class="form-control">
                    </div>
                    <div class="col-md-6 col-6">
                        <label> Hingga </label>
                        <input type="text" name="date2" id="date2" class="form-control">
                    </div>
                    <div class="col-md-6 mb-4">
                        <a href="{{ url('report') }}">
                            <button class="btn btn-outline-primary btn-block" type="button"> <i
                                    class="fa fa-arrow-left"></i> Kembali
                            </button>
                        </a>
                    </div>
                    <div class="col-md-6 mb-4">
                        <button class="btn btn-primary btn-block" type="submit"> Tampilkan </button>
                    </div>
            </form>
            <div class="col-md-12 mt-2">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table nowrap" id="table1">
                                <thead>
                                    <tr>
                                        <th> No </th>
                                        <th> EDC </th>
                                        <th> Jumlah </th>
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
                                    @foreach ($edc as $row)
                                        <tr>
                                            <td> {{ $no++ }} </td>
                                            <td> {{ $row->edc->nama_edc }} </td>
                                            <td> Rp. {{ number_format($row->total_pendapatan, 0, ',', '.') }} </td>
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
