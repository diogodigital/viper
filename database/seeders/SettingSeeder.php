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
        \DB::table('settings')->insert([
            'software_name' => 'Nome do Software',
            'software_description' => 'Descrição do Software',
            'software_favicon' => 'favicon_path',
            'software_logo_white' => 'logo_white_path',
            'software_logo_black' => 'logo_dark_path',
            'storage' => 'public',

            'min_deposit' => 10,
            'max_deposit' => 1000,
            'min_withdrawal' => 20,
            'max_withdrawal' => 2000,
        ]);
    }
}
