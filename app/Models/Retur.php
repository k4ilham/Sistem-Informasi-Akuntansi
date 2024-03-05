<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Retur extends Model
{
    use HasFactory;

    protected $primaryKey = 'no_retur';
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = false;
    protected $table = "retur";
    protected $fillable=['no_retur','tgl_retur','total_retur'];
}
