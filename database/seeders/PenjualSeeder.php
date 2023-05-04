<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PenjualSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 5; $i < 15; $i++) {
            DB::table('users')->insert([
                'username' => 'penjual' . $i,
                'email' => 'penjual' . $i . '@gmail.com',
                'password' => bcrypt('123456'),
                'role' => 'penjual'
            ]);
        }
    }
}
