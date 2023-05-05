<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class master_masyarakat extends Model
{
    use HasFactory;
    protected $keyType = 'uuid';
    protected $table = 'master_masyarakats';
    protected $fillable = ['id_masyarakat', 'nik', 'nama_lengkap', 'jenis_kelamin', 'tempat_lahir',
    'tgl_lahir', 'agama', 'pendidikan', 'pekerjaan', 'golongan_darah', 'status_perkawinan', 'tgl_perkawinan',
    'status_keluarga', 'kewarganegaraan', 'no_paspor', 'no_kitap', 'nama_ayah', 'nama_ibu','id', 'created_at', 'updated_at'];
    // public function master_masyarakat(){
    // return $this->belongsTo(master_masyarakat::class);
    // }

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            if (empty($model->{$model->getKeyName()})) {
                $model->{$model->getKeyName()} = Str::uuid()->toString();
            }
        });
    }

    /**
     * Kita override getIncrementing method
     *
     * Menonaktifkan auto increment
     */
    public function getIncrementing()
    {
        return false;
    }

    /**
     * Kita override getKeyType method
     *
     * Memberi tahu laravel bahwa model ini menggunakan primary key bertipe string
     */
    public function getKeyType()
    {
        return 'string';
    }
    public function akun()
    {
        return $this->hasOne(master_akun::class, 'id_masyarakat', 'id_masyarakat');
    }

    public function kks()
    {
        return $this->hasOne(master_kks::class, 'id', 'id');
    }
    public function pengajuan_surats()
    {
    return $this->hasMany(pengajuan_surat::class, 'id_masyarakat', 'id_masyarakat');
    }
}