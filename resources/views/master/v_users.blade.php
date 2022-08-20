@extends('app')

@section('title', 'Pengguna')

@section('content')
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3> Pengguna </h3>
                    <p class="text-subtitle text-muted">Dibawah adalah kelompok data pengguna.
                    </p>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <div class="form-group form-group-compose">
                        <!-- compose button  -->
                        <button type="button" class="btn btn-primary btn-block my-4 compose-btn" data-bs-toggle="modal"
                            data-bs-target="#exampleModalScrollable">
                            <i class="bi bi-plus"></i>
                            Tambah Pengguna
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
                                <th> Foto </th>
                                <th> Nama </th>
                                <th> Username </th>
                                <th> Level </th>
                                <th> Action </th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $no = 1;
                            @endphp
                            @foreach ($users as $row)
                                <tr>
                                    <td> {{ $no++ }} </td>
                                    <td>
                                        <div class="avatar avatar-lg">

                                            @if ($row->foto == '')
                                                <img src='https://ui-avatars.com/api?name={{ $row->name }}&color=7FCF5&background=EBF4FF'
                                                    alt='avtar img holder'>
                                            @else
                                                <img src='{{ asset('assets/images/profile') }}/{{ $row->foto }}'
                                                    alt='avtar img holder'>
                                            @endif
                                        </div>
                                    </td>
                                    <td> {{ $row->name }} </td>
                                    <td> {{ $row->username }} </td>
                                    <td> {{ $row->role }} </td>
                                    <td>
                                        <a href="{{ url('/users/delete', $row->id) }}"
                                            onclick="return confirm('Apakah anda yakin untuk menghapus data yang dipilih?')">
                                            <button class="btn btn-sm btn-danger"><span class="bi bi-trash"></span></button>
                                        </a>
                                        <a href="{{ url('/master/users/edit', $row->id) }}">
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
        <div class="modal-dialog modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalScrollableTitle">
                        Tambah Pengguna </h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <i data-feather="x"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ url('users/save') }}" method="post" enctype="multipart/form-data"
                        autocomplete="off">
                        @csrf
                        <div class="row">
                            <div class="col-md-12">
                                <h6> Nama Pengguna </h6>
                                <div class="form-group">
                                    <input type="text" required name="name" class="form-control"
                                        placeholder="Masukkan nama pengguna...">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <h6> Username </h6>
                                <div class="form-group">
                                    <input type="text" required name="username" class="form-control"
                                        placeholder="Masukkan username...">
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <h6> Password <code> * Max 12 Digit </code> </h6>
                                <div class="form-group">
                                    <input type="password" required name="password" id="password" maxlength="12"
                                        class="form-control" placeholder="Masukkan password...">
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <h6> Ulangi Password </h6>
                                <div class="form-group">
                                    <input type="password" oninput="checkPassword()" required name="password2"
                                        id="password2" maxlength="12" class="form-control" placeholder="Ulangi password...">
                                </div>
                            </div>
                            <div class="col-md-12 col-12">
                                <h6> Level Pengguna </h6>
                                <div class="form-group">
                                    <select class="choices form-select" name="role" required>
                                        <optgroup label="Level">
                                            <option value="Admin">Admin</option>
                                            <option value="Kasir">Kasir</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-12 col-12">
                                <h6> Upload Photo </h6>
                                <div class="form-group">
                                    <input type="file" name="foto" class="form-control">
                                </div>
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
        function checkPassword() {
            $('#error_password2').text('');

            var password1 = $("#password").val();
            var password2 = $("#password2").val();
            var element = document.getElementById("password2");

            if (password1 != password2) {
                document.getElementById("simpan").disabled = true;
                element.classList.remove("is-valid");
                element.classList.add("is-invalid");
            } else {
                document.getElementById("simpan").disabled = false;
                element.classList.remove("is-invalid");
                element.classList.add("is-valid");
            }

        }
    </script>
@endsection
