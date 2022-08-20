<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Promo_D extends Model
{

    protected $table      = "tbl_detail_promo";
    protected $primaryKey = "id";
    protected $fillable   =
    [
        'id_promo',
        'id_barang',
        'nominal',
        'persen'
    ];

    public $timestamps = false;
    public function detail_promo ()
    {
        return $this->belongsTo(Promo_U::class,'id_promo');
    }

    public function merchandise()
    {
        return $this->hasMany(Merchandise::class,'id_barang');
    }

}
