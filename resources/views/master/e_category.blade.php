@extends('app')

@section('title', 'Edit Kategori')

@section('content')
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-4 order-md-1 order-last">
                    <h3> Edit Kategori </h3>
                    <p class="text-subtitle text-muted">Disini Anda dapat merubah data kategori.
                    </p>
                </div>
                <div class="col-12 col-md-8 order-md-2 order-first">
                    <section class="section">
                        <div class="card">
                            <div class="card-body">
                                <form action="{{ url('/category/update')}}" method="post" autocomplete="off">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-12 col-12">
                                            <h6> Nama Kategori </h6>
                                            <div class="form-group">
                                                <input type="hidden" name="id_kategori"
                                                    value="{{ $category->id_kategori }}">
                                                <input type="text" name="nama_kategori" class="form-control"
                                                    value="{{ $category->nama_kategori }}" required>
                                            </div>
                                        </div>
                                    </div>
                            </div>

                            <div class="card-footer">
                                <div class="row">
                                    <div class="col-md-6 col-12">
                                        <a href="{{ url('/master/category')}} ">
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
