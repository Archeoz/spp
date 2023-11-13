<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class KelasSpp extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = 'kelasspps';

    protected $fillable = [
        'id_kelas',
        'id_kompetensi',
        'id_spp',
    ];
}
