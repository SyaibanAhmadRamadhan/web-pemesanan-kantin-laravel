<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PembeliModel extends Model
{
    use HasFactory;
    protected $table = 'pembeli';
    protected $primaryKey = 'id';
    protected $fillable = [
        'id', 'id_pembeli', 'name', 'mobile_phone', 'jenis_kelamin', 'tanggal_lahir'
    ];

    
}
