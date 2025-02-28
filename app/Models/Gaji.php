<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gaji extends Model
{
    use HasFactory;
    protected $table = "gaji";
    protected $primaryKey = "id";
    protected $fillable = [
        'id',
        'tgl_gaji',
        'gaji_pokok',
        'gaji_lembur',
        'uang_makan',
        'pot_gaji',
        'total'
    ];
}
