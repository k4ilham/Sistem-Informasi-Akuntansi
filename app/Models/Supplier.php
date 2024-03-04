<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    use HasFactory;

    protected $primaryKey = 'kd_supp';
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = false;
    protected $table = "supplier";
    protected $fillable=['kd_supp','nm_supp','alamat','telepon'];
    
}
