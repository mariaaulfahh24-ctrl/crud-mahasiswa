<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mahasiswa extends Model
{
    // Karena NIM adalah Primary Key (bukan 'id') dan bertipe String
    protected $primaryKey = 'nim';
    public $incrementing = false;
    protected $keyType = 'string';

    // Kolom yang diizinkan untuk diisi
    protected $fillable = ['nim', 'nama', 'kelas', 'matakuliah', 'user_id'];
}