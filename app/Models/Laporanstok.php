<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Laporanstok extends Model
{
    use HasFactory;

    protected $table = "lap_stok";
    protected $fillable = ['kd_brg','nm_brg','harga','stok','beli','retur'];
}
