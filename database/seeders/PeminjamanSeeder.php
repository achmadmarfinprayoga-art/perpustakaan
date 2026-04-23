<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PeminjamanSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('peminjamans')->insert([
            ['siswa_id'=>1,'buku_id'=>1,'user_id'=>1,'tanggal_pinjam'=>now(),'status'=>'dipinjam'],
            ['siswa_id'=>2,'buku_id'=>2,'user_id'=>2,'tanggal_pinjam'=>now(),'status'=>'dipinjam'],
            ['siswa_id'=>3,'buku_id'=>3,'user_id'=>1,'tanggal_pinjam'=>now(),'status'=>'dikembalikan','tanggal_kembali'=>now()],
            ['siswa_id'=>4,'buku_id'=>4,'user_id'=>2,'tanggal_pinjam'=>now(),'status'=>'dipinjam'],
            ['siswa_id'=>5,'buku_id'=>5,'user_id'=>1,'tanggal_pinjam'=>now(),'status'=>'dikembalikan','tanggal_kembali'=>now()]
        ]);
    }
}
