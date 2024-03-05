<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jurnal extends Model
{
    use HasFactory;
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = false;
    protected $table = "jurnal";
    protected $fillable=['no_jurnal','tgl_jurnal','keterangan','no_akun','debet','kredit'];
}
