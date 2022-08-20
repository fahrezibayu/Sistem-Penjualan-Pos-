<link rel="stylesheet" href="{{ asset('assets/css/pages/datatables.css') }}">
<table class="table nowrap" id="table1">
    <thead>
        <tr>
            <th> No </th>
            <th> Foto </th>
            <th> Id Barang </th>
            <th> Nama Barang </th>
            <th> Kategori </th>
            <th> Harga Barang </th>
            <th> Qty Barang </th>
            <th> Action </th>
        </tr>
    </thead>
    <tbody>
        @php
            $no = 1;
        @endphp
        @foreach ($merchandise as $row)
            <tr>
                <td> {{ $no++ }} </td>
                <td>
                    <div class="avatar avatar-xl">
                        @if ($row->foto == "")
                            <img src="https://ui-avatars.com/api?name={{ $row->nama_barang }}&color=FFF&background=6C757D" alt="">
                        @else
                            <img src="{{ asset('assets/images/product')}}/{{ $row->foto }}">
                        @endif
                    </div>
                </td>
                <td> {{ $row->id_barang }} </td>
                <td> {{ $row->nama_barang }} </td>
                <td> {{ $row->category->nama_kategori }} </td>
                <td> Rp. {{ number_format($row->harga_barang, 0, ',', '.') }} </td>
                @if ($row->qty <= 5)
                    <td>
                        <div style="color: red" onclick="tambah_stok('{{ $row->id_barang }}')"> Stok sisa
                            {{ $row->qty }}, silahkan update stok. </div>
                    </td>
                @else
                    <td> {{ $row->qty }} </td>
                @endif
                <td>
                    <a href="{{ url('/merchandise/delete', $row->id_barang) }}"
                        onclick="return confirm('Apakah anda yakin untuk menghapus data yang dipilih?')">
                        <button class="btn btn-sm btn-danger"><span class="bi bi-trash"></span></button>
                    </a>
                    <a href="{{ url('/master/merchandise/edit', $row->id_barang) }}">
                        <button class="btn btn-sm btn-primary"><span class="fa fa-edit"></span></button>
                    </a>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
<script src="{{ asset('assets/js/extensions/datatables.js') }}"></script>