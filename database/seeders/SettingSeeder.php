<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \DB::table('settings')->updateOrInsert(
            ['key' => 'denda_harian'],
            ['value' => '5000', 'created_at' => now(), 'updated_at' => now()]
        );
    }
}
