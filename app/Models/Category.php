<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    
    protected $table      = "tbl_kategori";
    protected $primaryKey = "id_kategori";
    protected $fillable   =
    [
        'id_kategori',
        'nama_kategori',
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
        return $this->hasMany(Merchandise::class,'id_kategori');
    }

}
