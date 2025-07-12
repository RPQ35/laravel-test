<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class izin extends Model
{
    protected $table = 'user-izin'; // fix table name

    protected $fillable = [
        'nama_siswa',
        'kelas',
        'jenis_izin',
        'image_path',
    ];
}
