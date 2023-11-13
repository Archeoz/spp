<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pembayaran extends Model
{
    use HasFactory;
    protected $fillable = [
        'id_petugas',
        'nisn',
        'tgl_bayar',
        'id_spp',
        'jumlah_bayar',
    ];
    use SoftDeletes;
}
