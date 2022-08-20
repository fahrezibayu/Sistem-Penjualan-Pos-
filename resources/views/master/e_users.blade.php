@extends('app')

@section('title', 'Edit Pengguna')

@section('content')
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-4 order-md-1 order-last">
                    <h3> Edit Pengguna </h3>
                    <p class="text-subtitle text-muted">Disini Anda dapat merubah data pengguna.
                    </p>
                </div>
                <div class="col-12 col-md-8 order-md-2 order-first">
                    <section class="section">
                        <div class="card">
                            <div class="card-body">
                                <form action="{{ url('/users/update') }}" method="post" autocomplete="off">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-12 col-12">
                                            <h6> Level Pengguna </h6>
                                            <div class="form-group">
                                                <input type="hidden" name="id" value="{{ $users->id }}">
                                                <select class="choices form-select" name="role" required>
                                                    <option value=""> Silahkan pilih level pengguna </option>
                                                    @if ($users->role == 'Admin')
                                                        <option value="Admin" selected> Admin </option>
                                                        <option value="Kasir"> Kasir </option>
                                                    @else
                                                        <option value="Admin"> Admin </option>
                                                        <option value="Kasir" selected> Kasir </option>
                                                    @endif
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                            </div>

                            <div class="card-footer">
                                <div class="row">
                                    <div class="col-md-6 col-12">
                                        <a href="{{ url('/master/users') }} ">
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
