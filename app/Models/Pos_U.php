<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pos_U extends Model
{

    protected $table      = "tbl_penjualan";
    protected $fillable   =
    [
        'id_penjualan',
        'tgl_transaksi',
        'jenis_pembayaran',
        'id_edc',
        'subtotal',
        'ppn',
        'total',
        'bayar',
        'kembalian',
        'id_user',
        'created_at',
        'updated_at'
    ];

    public function tb_user ()
    {
        return $this->belongsTo(User::class,'id_user');
    }
    public function edc ()
    {
        return $this->belongsTo(Edc::class,'id_edc');
    }

}
