<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class PesananModel extends Model
{
    use HasFactory;
    protected $table = 'pesanan';
    protected $primaryKey = 'id';
    protected $fillable = [
        'id', 'id_user', 'id_penjual', 'nomer_antrian', 'status_pesanan', 'status_pembayaran', 'jumlah_pesanan', 'total_harga', 'nomer_pesanan', 'id_menu'
    ];

    public function getNomerPesanan($param)
    {
        return DB::table('pesanan')->where('nomer_pesanan', $param)->join("daftar_menu", "daftar_menu.id", "=", "pesanan.id_menu")->get();
    }

    public function getUser()
    {
        return $this->belongsTo(User::class, 'id_user');
    }
}
