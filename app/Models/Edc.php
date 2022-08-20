<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Edc extends Model
{
    protected $table      = "tbl_edc";
    protected $primaryKey = "id_edc";
    protected $fillable   =
    [
        'id_edc',
        'nama_edc',
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
        return $this->hasMany(Pos_U::class,'id_edc');
    }

}
