<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MobilHomeImage extends Model
{
    use HasFactory;

    protected $fillable = [
        'mobil_home_id',
        'image_path',
    ];

    public function mobilHome()
    {
        return $this->belongsTo(mobilHome::class);
    }
}
