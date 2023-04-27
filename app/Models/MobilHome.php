<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
/* modelo "MobilHome" con relación 
"uno a muchos" hacia la tabla "mobil_home_images"
 */
class MobilHome extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'price',
        'on_sale',
        'discounted_price',
        'discount_percentage',
        'featured',
        'favorite',
        'available',
        'image',
    ];
    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($mobilHome) {
            $mobilHome->images()->delete();
        });
    }
    public function images()
    {
        return $this->hasMany(MobilHomeImage::class);
    }

    public function sales()
    {
        return $this->hasMany(Sale::class);
    }

}

