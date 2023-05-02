<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class pengajuan_surat extends Model
{
    use HasFactory;
    protected $table = 'pengajuan_surats';
    protected $fillable = ['*'];    

public function akun()
{
    return $this->belongsTo(master_akun::class, 'id', 'id')->withDefault(function () {
        $model = new master_akun();
        $model->id = 'default_uuid'; // ID default yang digunakan jika tidak ditemukan di tabel master_akuns
        return $model;
    });
}

public function surat()
    {
        return $this->belongsTo(master_surat::class, 'id_surat', 'id_surat');
    }

}
