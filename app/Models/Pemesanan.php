<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pemesanan extends Model
{
    use HasFactory;
    protected $primaryKey = 'no_pesan';
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = false;
    protected $table = "pemesanan";
    protected $fillable=['no_pesan','tgl_pesan','total','kd_supp'];
}
