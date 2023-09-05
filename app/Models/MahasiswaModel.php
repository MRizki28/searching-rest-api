<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MahasiswaModel extends Model
{
    use HasFactory;
    protected $table = 'tb_mahasiswa';
    protected $fillable = [
        'id' , 'nama_mahasiswa' , 'created_at' , 'updated_at'
    ];
}
