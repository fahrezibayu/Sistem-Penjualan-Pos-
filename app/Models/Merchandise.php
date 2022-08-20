<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Merchandise extends Model
{

    protected $table      = "tbl_barang";
    // protected $primaryKey = "id_barang";
    protected $fillable   =
    [
        'id_barang',
        'nama_barang',
        'harga_barang',
        'qty',
        'foto',
        'id_kategori',
        'foto',
        'id_user',
        'created_at',
        'updated_at'
    ];

    public function tb_user ()
    {
        return $this->belongsTo(User::class,'id_user');
    }

    public function category()
    {
        return $this->belongsTo(Category::class,'id_kategori');
    }

    public function merchandise()
    {
        return $this->hasMany(Pos_D::class,'id_barang');
    }

}
