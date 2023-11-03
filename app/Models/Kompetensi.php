<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Kompetensi extends Model
{
    use HasFactory;
    protected $fillable = [
        'kompetensi_keahlian',
    ];
    use SoftDeletes;
}
