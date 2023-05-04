<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DaftarMenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 0; $i < 2; $i++) {
            DB::table('daftar_menu')->insert([
                'id_penjual' => 13,
                'name_menu' => 'penjual5 ' . $i,
                'price' => '200000',
                'picture' => '1670176520.jpg'
            ]);
        }
        for ($i = 0; $i < 1; $i++) {
            DB::table('daftar_menu')->insert([
                'id_penjual' => 14,
                'name_menu' => 'penjual6 ' . $i,
                'price' => '200000',
                'picture' => '1670176520.jpg'
            ]);
        }
        for ($i = 0; $i < 3; $i++) {
            DB::table('daftar_menu')->insert([
                'id_penjual' => 15,
                'name_menu' => 'penjual7 ' . $i,
                'price' => '200000',
                'picture' => '1670176520.jpg'
            ]);
        }
        for ($i = 0; $i < 4; $i++) {
            DB::table('daftar_menu')->insert([
                'id_penjual' => 16,
                'name_menu' => 'penjual8 ' . $i,
                'price' => '200000',
                'picture' => '1670176520.jpg'
            ]);
        }
        for ($i = 0; $i < 6; $i++) {
            DB::table('daftar_menu')->insert([
                'id_penjual' => 17,
                'name_menu' => 'penjual9 ' . $i,
                'price' => '200000',
                'picture' => '1670176520.jpg'
            ]);
        }
        for ($i = 0; $i < 1; $i++) {
            DB::table('daftar_menu')->insert([
                'id_penjual' => 18,
                'name_menu' => 'penjual10 ' . $i,
                'price' => '200000',
                'picture' => '1670176520.jpg'
            ]);
        }
        for ($i = 0; $i < 3; $i++) {
            DB::table('daftar_menu')->insert([
                'id_penjual' => 19,
                'name_menu' => 'penjual11 ' . $i,
                'price' => '200000',
                'picture' => '1670176520.jpg'
            ]);
        }
        for ($i = 0; $i < 2; $i++) {
            DB::table('daftar_menu')->insert([
                'id_penjual' => 20,
                'name_menu' => 'penjual12 ' . $i,
                'price' => '200000',
                'picture' => '1670176520.jpg'
            ]);
        }
        for ($i = 0; $i < 3; $i++) {
            DB::table('daftar_menu')->insert([
                'id_penjual' => 21,
                'name_menu' => 'penjual13 ' . $i,
                'price' => '200000',
                'picture' => '1670176520.jpg'
            ]);
        }
        for ($i = 0; $i < 8; $i++) {
            DB::table('daftar_menu')->insert([
                'id_penjual' => 22,
                'name_menu' => 'penjual14 ' . $i,
                'price' => '200000',
                'picture' => '1670176520.jpg'
            ]);
        }
    }
}
