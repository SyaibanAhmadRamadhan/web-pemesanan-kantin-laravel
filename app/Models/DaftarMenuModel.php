<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class DaftarMenuModel extends Model
{
    use HasFactory;
    protected $table = 'daftar_menu';
    protected $primaryKey = 'id';
    protected $fillable = [
        'id', 'name_menu', 'price', 'picture', 'id_penjual', 'stock'
    ];

    public function getPenjual($param)
    {
        return DB::table('penjual')->where('id_penjual', $param)->first();
    }
}
