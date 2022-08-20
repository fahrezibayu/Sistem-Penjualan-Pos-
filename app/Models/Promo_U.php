<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Promo_U extends Model
{

    protected $table      = "tbl_promo";
    protected $primaryKey = "id_promo";
    protected $fillable   =
    [
        'id_promo',
        'nama_promo',
        'tipe_promo',
        'periode_awal',
        'periode_akhir',
        'status',
        'id_user',
        'created_at',
        'updated_at'
    ];

    public function tb_user ()
    {
        return $this->belongsTo(User::class,'id_user');
    }

    public function detail_promo()
    {
        return $this->hasMany(Promo_D::class,'id_promo');
    }

}
