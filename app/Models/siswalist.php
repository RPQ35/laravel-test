<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class siswalist extends Model
{
    
    protected $table = 'siswa'; // fix table name

    protected $fillable = [
        'nama_siswa',
        'kelas',
    ];

}
