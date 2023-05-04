<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class PenjualModel extends Model
{
    use HasFactory;
    protected $table = 'penjual';
    protected $primaryKey = 'id';
    protected $fillable = [
        'id', 'id_penjual', 'nama', 'nama_warung', 'lokasi', 'nomer_telepon'
    ];


    public function getMenu($param)
    {
        return DB::table('daftar_menu')->where('id_penjual', $param)->get();
    }
    public function getMenuSearch($param, $param2)
    {
        return DB::table('daftar_menu')->where('name_menu', 'LIKE', '%' . $param . '%')->where('id_penjual', $param2)->get();
    }
}
