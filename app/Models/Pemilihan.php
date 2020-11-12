<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pemilihan extends Model
{
    use HasFactory;

    protected $table = 'pemilihan';

    protected $fillable = ['nama_pemilihan', 'deskripsi', 'pemilihan_dimulai', 'pemilihan_berakhir'];
}
