<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SiswaSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('siswas')->insert([
            ['nama'=>'Ahmad','kelas'=>'XII RPL 1','nis'=>'12345'],
            ['nama'=>'Budi','kelas'=>'XII RPL 2','nis'=>'12346'],
            ['nama'=>'Citra','kelas'=>'XII RPL 1','nis'=>'12347'],
            ['nama'=>'Dina','kelas'=>'XII RPL 2','nis'=>'12348'],
            ['nama'=>'Eko','kelas'=>'XII RPL 1','nis'=>'12349']
        ]);
    }
}

