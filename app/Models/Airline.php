<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Airline extends Model
{
    use HasFactory;

    protected $table = 'airlines';

    protected $fillable = [
        'name',
        'code',
        'logo',
        'user_id',
    ];

    public function flights(): HasMany
    {
        return $this->hasMany(Flight::class, 'airline_id');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function getLogoUrlAttribute()
    {
        if ($this->logo && $this->logo !== 'img/loginsplash.jpeg') {
            return asset('storage/' . $this->logo);
        }
        
        return asset($this->logo ?? 'img/loginsplash.jpeg');
    }
}
