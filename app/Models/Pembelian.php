<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pembelian extends Model
{
    use HasFactory;
    protected $primaryKey = 'no_beli';
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = false;
    protected $table = "pembelian";
    protected $fillable=['no_beli','tgl_beli','no_faktur','total_beli','no_pesan'];
}
