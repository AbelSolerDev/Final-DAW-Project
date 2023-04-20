<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Promotion extends Model
{
    use HasFactory;

    protected $fillable = [
        'mobil_home_id',
    ];

    public function mobilHome()
    {
        return $this->belongsTo(MobilHome::class);
    }
}
