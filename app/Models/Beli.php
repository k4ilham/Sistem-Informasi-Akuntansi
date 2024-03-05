<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Beli extends Model
{
    use HasFactory;

    protected $primaryKey = 'no_pesan';
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = false;
    protected $table = "tampil_pemesanan";
    protected $fillable=['kd_brg','no_pesan','nm_brg','qty_pesan','sub_total'];
}
