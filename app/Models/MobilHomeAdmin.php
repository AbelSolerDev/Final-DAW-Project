<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MobilHomeAdmin extends Model
{
    use HasFactory;

    protected $table = 'mobil_home_admin';

    protected $fillable = [
        'mobil_home_id',
        'administrator_id',
    ];
}
