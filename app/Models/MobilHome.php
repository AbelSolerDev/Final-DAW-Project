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

    public function images()
    {
        return $this->hasMany(MobilHomeImage::class);
    }

    public function sales()
    {
        return $this->hasMany(Sale::class);
    }

    public function promotions()
    {
        return $this->hasMany(Promotion::class);
    }

    public function userFavorites()
    {
        return $this->hasMany(UserFavorite::class);
    }

    public function administrators()
    {
        return $this->belongsToMany(Administrator::class, 'mobil_home_admin');
    }
}

