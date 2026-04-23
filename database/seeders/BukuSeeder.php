<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BukuSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('bukus')->insert([
            ['judul'=>'Laravel Dasar','penulis'=>'Ahmad','tahun_terbit'=>2020,'kategori_id'=>1,'stok'=>10],
            ['judul'=>'PHP OOP','penulis'=>'Budi','tahun_terbit'=>2019,'kategori_id'=>1,'stok'=>8],
            ['judul'=>'Jaringan Komputer','penulis'=>'Citra','tahun_terbit'=>2018,'kategori_id'=>2,'stok'=>5],
            ['judul'=>'Desain Grafis','penulis'=>'Dina','tahun_terbit'=>2021,'kategori_id'=>3,'stok'=>7],
            ['judul'=>'MySQL','penulis'=>'Eko','tahun_terbit'=>2022,'kategori_id'=>1,'stok'=>6]
        ]);
    }
}
