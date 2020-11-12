<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Calon extends Model
{
    use HasFactory;

    protected $table = 'calon';

    protected $fillable = ['nomor_calon', 'nama_calon', 'foto', 'id_pemilihan'];
}
