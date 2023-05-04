<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PenjualProfileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('penjual')->insert([
            'id_penjual' => 13,
            'nama_warung' => 'penjual5',
            'lokasi' => 'univ',
            'nomer_telepon' => '123456'
        ]);
        DB::table('penjual')->insert([
            'id_penjual' => 14,
            'nama_warung' => 'penjual6',
            'lokasi' => 'univ',
            'nomer_telepon' => '123456'
        ]);
        DB::table('penjual')->insert([
            'id_penjual' => 15,
            'nama_warung' => 'penjual7',
            'lokasi' => 'univ',
            'nomer_telepon' => '123456'
        ]);
        DB::table('penjual')->insert([
            'id_penjual' => 16,
            'nama_warung' => 'penjual9',
            'lokasi' => 'univ',
            'nomer_telepon' => '123456'
        ]);
        DB::table('penjual')->insert([
            'id_penjual' => 17,
            'nama_warung' => 'penjual8',
            'lokasi' => 'univ',
            'nomer_telepon' => '123456'
        ]);
        DB::table('penjual')->insert([
            'id_penjual' => 18,
            'nama_warung' => 'penjual10',
            'lokasi' => 'univ',
            'nomer_telepon' => '123456'
        ]);
        DB::table('penjual')->insert([
            'id_penjual' => 19,
            'nama_warung' => 'penjual11',
            'lokasi' => 'univ',
            'nomer_telepon' => '123456'
        ]);
        DB::table('penjual')->insert([
            'id_penjual' => 20,
            'nama_warung' => 'penjual12',
            'lokasi' => 'univ',
            'nomer_telepon' => '123456'
        ]);
        DB::table('penjual')->insert([
            'id_penjual' => 21,
            'nama_warung' => 'penjual13',
            'lokasi' => 'univ',
            'nomer_telepon' => '123456'
        ]);
        DB::table('penjual')->insert([
            'id_penjual' => 22,
            'nama_warung' => 'penjual14',
            'lokasi' => 'univ',
            'nomer_telepon' => '123456'
        ]);
    }
}
