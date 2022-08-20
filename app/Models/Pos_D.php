<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pos_D extends Model
{

    protected $table      = "tbl_penjualan_trn";
    protected $fillable   =
    [
        'id',
        'id_penjualan',
        'id_barang',
        'qty',
        'harga_barang',
        'total',
        'id_promo'
    ];
    public $timestamps  = false;

    public function tb_pos ()
    {
        return $this->belongsTo(User::class,'id_penjualan');
    }

    public function merchandise ()
    {
        return $this->hasMany(Merchandise::class,'id_barang');
    }

}
