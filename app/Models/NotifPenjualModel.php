<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NotifPenjualModel extends Model
{
    use HasFactory;
    protected $table = 'notification_penjual';
    protected $primaryKey = 'id';
    protected $fillable = [
        'id', 'id_penjual', 'message', 'nomer_pesanan', 'status'
    ];
}
