<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profesi extends Model
{
    use HasFactory;

    protected $table = 'tabel_profesi';
    protected $guarded = [];
    protected $fillable = [
        'kode',
        'nama_profesi',
    ];
}
