<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Temp_pesan extends Model
{
    use HasFactory;

    protected $primaryKey = 'kd_brg';
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = false;
    protected $table = "view_temp_pesan";
    protected $fillable=['kd_brg','nm_brg','harga','stok'];
}
