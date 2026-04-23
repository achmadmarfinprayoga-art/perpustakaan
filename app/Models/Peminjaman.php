<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Peminjaman extends Model
{
    use HasFactory;

    protected $table = 'peminjamans';

    protected $fillable = [
        'siswa_id',
        'buku_id',
        'user_id', // Assuming user_id is also fillable based on seeder
        'tanggal_pinjam',
        'batas_pengembalian',
        'tanggal_kembali',
        'status',
        'denda',
        'is_paid',
    ];

    public function siswa()
    {
        return $this->belongsTo(Siswa::class);
    }

    public function buku()
    {
        return $this->belongsTo(Buku::class);
    }
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
