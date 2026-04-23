<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KategoriSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('kategoris')->insert([
            ['nama_kategori'=>'Pemrograman','keterangan'=>'Buku Coding','created_at'=>now(),'updated_at'=>now()],
            ['nama_kategori'=>'Jaringan','keterangan'=>'Buku Networking','created_at'=>now(),'updated_at'=>now()],
            ['nama_kategori'=>'Desain','keterangan'=>'Buku Desain','created_at'=>now(),'updated_at'=>now()]
        ]);
    }
}
