<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Airport extends Model
{
    use HasFactory;

    protected $table = 'airports';

    protected $fillable = [
        'name',
        'iata_code',
        'location',
        'image',
    ];

    public function arrivals(): HasMany
    {
        return $this->hasMany(Flight::class, 'arrival_airport_id');
    }

    public function departures(): HasMany
    {
        return $this->hasMany(Flight::class, 'departure_airport_id');
    }

    public function getImageUrlAttribute()
    {
        if ($this->image && $this->image !== 'img/loginsplash.jpeg') {
            return asset('storage/' . $this->image);
        }
        
        return asset($this->image ?? 'img/loginsplash.jpeg');
    }
}
