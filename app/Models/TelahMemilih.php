<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TelahMemilih extends Model
{
    use HasFactory;

    protected $table = 'telah_memilih';

    protected $fillable = ['id_siswa', 'id_pemilihan'];
}
