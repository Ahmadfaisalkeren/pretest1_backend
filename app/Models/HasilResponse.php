<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HasilResponse extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $table = 'hasil_response';
    protected $fillable = [
        'jenis_kelamin',
        'nama',
        'nama_jalan',
        'email',
        'angka_kurang',
        'angka_lebih',
        'profesi',
        'plain_json',
    ];

    public function gender()
    {
        return $this->belongsTo(JenisKelamin::class, 'jenis_kelamin', 'kode');
    }

    public function profesi()
    {
        return $this->belongsTo(Profesi::class, 'profesi', 'kode');
    }
}
