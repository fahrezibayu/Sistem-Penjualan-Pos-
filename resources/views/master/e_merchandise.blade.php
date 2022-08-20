@extends('app')

@section('title', 'Edit Barang')

@section('content')
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-4 order-md-1 order-last">
                    <h3> Edit Barang </h3>
                    <p class="text-subtitle text-muted">Disini Anda dapat merubah data barang.
                    </p>
                </div>
                <div class="col-12 col-md-8 order-md-2 order-first">
                    <section class="section">
                        <div class="card">
                            <div class="card-body">
                                <form action="{{ url('/merchandise/update') }}" method="post" autocomplete="off" enctype="multipart/form-data">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-6 col-12">
                                            <h6> Id Barang </h6>
                                            <div class="form-group">
                                                <input readonly type="text" name="id_barang" class="form-control"
                                                    value="{{ $merchandise->id_barang }}" required>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-12">
                                            <h6> Nama Barang </h6>
                                            <div class="form-group">
                                                <input type="text" name="nama_barang" class="form-control"
                                                    value="{{ $merchandise->nama_barang }}" required>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-12">
                                            <h6> Kategori </h6>
                                            <div class="form-group">
                                                <select class="choices form-select" name="id_kategori" required>
                                                    <option value=""> Silahkan pilih kategori </option>
                                                    @foreach ($category as $row)
                                                        @if ($row->id_kategori == $merchandise->category->id_kategori)
                                                            <option value="{{ $row->id_kategori }}" selected>
                                                                {{ $row->nama_kategori }} </option>
                                                        @else
                                                            <option value="{{ $row->id_kategori }}">
                                                                {{ $row->nama_kategori }} </option>
                                                        @endif
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-12">
                                            <h6> Harga Barang </h6>
                                            <div class="form-group">
                                                <input type="text" name="harga_barang" class="form-control"
                                                    value="{{ $merchandise->harga_barang }}" required>
                                            </div>
                                        </div>
                                        <div class="col-md-12 col-12">
                                            <h6> Foto Barang </h6>
                                            <div class="form-group">
                                                <input type="file" class="form-control" name="foto">
                                                <input type="hidden" class="form-control" name="foto_l"
                                                    value="{{ $merchandise->foto }}">
                                            </div>
                                        </div>
                                    </div>
                            </div>

                            <div class="card-footer">
                                <div class="row">
                                    <div class="col-md-6 col-12">
                                        <a href="{{ url('/master/merchandise') }} ">
                                            <button type="button" class="btn btn-outline-secondary btn-block"
                                                data-bs-dismiss="modal">
                                                <i class="bx bx-x d-block d-sm-none"></i>
                                                <span class="d-none d-sm-block"> Kembali</span>
                                            </button>
                                        </a>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <button type="submit" id="simpan" class="btn btn-primary btn-block">
                                            <i class="bx bx-check d-block d-sm-none"></i>
                                            <span class="d-none d-sm-block"> <i class="fa fa-save"></i> Update Data </span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                            </form>

                        </div>
                    </section>
                </div>
            </div>
        </div>
    </div>
@endsection
