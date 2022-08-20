@extends('app')

@section('title', 'Barang')

@section('content')
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3> Barang </h3>
                    <p class="text-subtitle text-muted">Dibawah adalah kelompok data barang.
                    </p>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <div class="form-group form-group-compose">
                        <!-- compose button  -->
                        <button type="button" class="btn btn-primary btn-block my-4 compose-btn" data-bs-toggle="modal"
                            data-bs-target="#modal_barang">
                            <i class="bi bi-plus"></i>
                            Tambah Barang
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <section class="section">
            <div class="card">
                <div class="card-body">
                    <div class="data_merchandise"></div>
                </div>
            </div>
        </section>
    </div>
    <!--scrolling content Modal -->
    <div class="modal fade" id="modal_barang" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalScrollableTitle">
                        Tambah Barang </h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <i data-feather="x"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="form_barang" method="post" action="{{ url('master/merchandise/save') }}" autocomplete="off" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-6 col-12">
                                <h6> Id Barang </h6>
                                <div class="form-group">
                                    <input type="text" readonly required name="id_barang" value="{{ $code }}"
                                        class="form-control" placeholder="Masukan id barang...">
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <h6> Nama Barang </h6>
                                <div class="form-group">
                                    <input type="text" required name="nama_barang" class="form-control"
                                        placeholder="Masukan nama barang...">
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <h6> Kategori </h6>
                                <div class="form-group">
                                    <select class="choices form-select" name="id_kategori" required>
                                        <option value=""> Silahkan pilih kategori </option>
                                        @foreach ($category as $row)
                                            <option value="{{ $row->id_kategori }}"> {{ $row->nama_kategori }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <h6> Harga Barang </h6>
                                <div class="form-group">
                                    <input type="number" required name="harga_barang" class="form-control"
                                        placeholder="Masukan harga barang...">
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <h6> Qty Barang </h6>
                                <div class="form-group">
                                    <input type="number" required name="qty" class="form-control"
                                        placeholder="Masukan qty barang...">
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <h6> Upload Photo </h6>
                                <div class="form-group">
                                    <input type="file" name="foto" id="foto" class="form-control">
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
        <script>
            setInterval(() => {
                $.ajax({
                    url : 'merchandise/data',
                    success:function (result){
                        $(".data_merchandise").html(result);
                    }
                })
            }, 1000);
        </script>
    @endsection
