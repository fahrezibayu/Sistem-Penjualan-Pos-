@extends('app')

@section('title', 'Mesin Edc')

@section('content')
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3> Mesin Edc </h3>
                    <p class="text-subtitle text-muted">Dibawah adalah kelompok data mesin edc.
                    </p>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <div class="form-group form-group-compose">
                        <!-- compose button  -->
                        <button type="button" class="btn btn-primary btn-block my-4 compose-btn" data-bs-toggle="modal"
                            data-bs-target="#exampleModalScrollable">
                            <i class="bi bi-plus"></i>
                            Tambah Mesin Edc
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <section class="section">
            <div class="card">
                <div class="card-body">
                    <table class="table nowrap" id="table1">
                        <thead>
                            <tr>
                                <th> No </th>
                                <th> Nama Edc </th>
                                <th> Action </th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $no = 1;
                            @endphp
                            @foreach ($edc as $row)
                                <tr>
                                    <td> {{ $no++ }} </td>
                                    <td> {{ $row->nama_edc }} </td>
                                    <td>
                                        <a href="{{ url('/edc/delete',$row->id_edc) }}" onclick="return confirm('Apakah anda yakin untuk menghapus data yang dipilih?')">
                                            <button class="btn btn-sm btn-danger"><span class="bi bi-trash"></span></button>
                                        </a>
                                        <a href="{{ url('/master/edc/edit',$row->id_edc) }}">
                                            <button class="btn btn-sm btn-primary"><span class="fa fa-edit"></span></button>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </section>
    </div>
    <!--scrolling content Modal -->
    <div class="modal fade" id="exampleModalScrollable" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalScrollableTitle">
                        Tambah Mesin Edc </h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <i data-feather="x"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ url('/edc/save') }}" method="post" autocomplete="off">
                        @csrf
                        <div class="row">
                            <div class="col-md-12 col-12">
                                <h6> Nama Edc </h6>
                                <div class="form-group">
                                    <input type="text" required name="nama_edc" class="form-control"
                                        placeholder="Masukan nama edc...">
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-light-secondary" data-bs-dismiss="modal">
                                <i class="bx bx-x d-block d-sm-none"></i>
                                <span class="d-none d-sm-block">Tutup</span>
                            </button>
                            <button type="submit" id="simpan" class="btn btn-primary ml-1">
                                <i class="bx bx-check d-block d-sm-none"></i>
                                <span class="d-none d-sm-block"> <i class="fa fa-save"></i> Simpan </span>
                            </button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    @endsection
