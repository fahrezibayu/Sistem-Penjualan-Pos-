@foreach ($merchandise as $row)
<div class="card" style="margin-bottom: 15px;">
    <div class="card-body">
        <div class="d-flex justify-content-between align-items-center items">
            <div class="d-flex flex-row"> <img
                    src="{{ asset('assets/images/product') }}/{{ $row->foto }}"
                    style="border-radius: 50px;" height="70" width="70">
                <div style="margin-left:15px;">
                    <span style="font-size: 20px; color:#25396f"> <b>
                            {{ $row->nama_barang }} </b>
                    </span>
                    <p class="text-subtitle text-muted" style="font-size: 18px;"> <b> Rp
                            {{ number_format($row->harga_barang) }}
                        </b>
                    </p>
                </div>
            </div>
            <div class="d-flex flex-row align-items-center">
                <div class="form-check">
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="form-check-input form-check-primary"
                            name="customCheck[]" id="customColorCheck1"
                            id_barang="{{ $row->id_barang }}"
                            nama_barang="{{ $row->nama_barang }}"
                            harga_barang="{{ $row->harga_barang }}"
                            foto_barang="{{ $row->foto }}">
                        <label class="form-check-label" for="customColorCheck1"> Pilih
                        </label>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endforeach