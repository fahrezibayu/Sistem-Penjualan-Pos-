// Author : Fahrezi Bayu Prabowo
// Sulungsoftdev

$.ajaxSetup({
    headers: {
        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
    },
});


function formatRupiah(angka, prefix) {
    var number_string = angka.replace(/[^,\d]/g, '').toString(),
        split = number_string.split(','),
        sisa = split[0].length % 3,
        rupiah = split[0].substr(0, sisa),
        ribuan = split[0].substr(sisa).match(/\d{3}/gi);

    // tambahkan titik jika yang di input sudah menjadi angka ribuan
    if (ribuan) {
        separator = sisa ? '.' : '';
        rupiah += separator + ribuan.join('.');
    }

    rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
    return prefix == undefined ? rupiah : (rupiah ? 'Rp ' + rupiah : '');
}

function tambah_stok(id) {
    Swal.fire({
        title: 'Tambah stok barang',
        input: 'number',
        inputAttributes: {
            autocapitalize: 'off',
            autocomplete: 'off'

        },
        showCancelButton: true,
        cancelButtonText: 'Batal',
        confirmButtonText: 'Tambah',
        showLoaderOnConfirm: true,
        inputValidator: (value) => {
            if (!value) {
                return 'Input qty jangan sampai kosong!'
            }
            if (value <= 0) {
                return 'Qty tidak boleh kurang maupun sama dengan 0'
            }
        },
        preConfirm: (qty) => {
            $.ajax({
                url: 'merchandise/update_stock',
                data: {
                    qty: qty,
                    id: id
                },
                type: 'post',
                success: function(result) {
                    if (result == 'ok') {
                        const Toast = Swal.mixin({
                            toast: true,
                            position: 'top-end',
                            showConfirmButton: false,
                            timer: 3000,
                            timerProgressBar: true,
                            didOpen: (toast) => {
                                toast.addEventListener('mouseenter', Swal
                                    .stopTimer)
                                toast.addEventListener('mouseleave', Swal
                                    .resumeTimer)
                            }
                        })

                        Toast.fire({
                            icon: 'success',
                            title: 'Tambah qty berhasil !'
                        })
                    } else {
                        Swal.showValidationMessage(
                            `Tambah stok gagal.`
                        )
                    }
                }
            })
        },
        allowOutsideClick: () => !Swal.isLoading()
    })
}