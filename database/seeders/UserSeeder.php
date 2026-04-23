<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'name'=>'Admin',
                'email'=>'admin@gmail.com',
                'password'=>bcrypt('123456'),
                'role'=>'admin',
                'created_at'=>now(),
                'updated_at'=>now()
            ],
            [
                'name'=>'Petugas',
                'email'=>'petugas@gmail.com',
                'password'=>bcrypt('123456'),
                'role'=>'petugas',
                'created_at'=>now(),
                'updated_at'=>now()
            ]
        ]);
    }
}
