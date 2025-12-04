<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Flight extends Model
{
    use HasFactory;

    protected $table = 'flights';

    protected $fillable = [
        'flight_number', 'scheduled_departure', 'scheduled_arrival', 'actual_departure', 'actual_arrival', 'status',
        'airline_id', 'departure_airport_id', 'arrival_airport_id', 'base_price', 'business_price', 'image'
    ];

    protected $casts = [
        'scheduled_departure' => 'datetime',
        'scheduled_arrival' => 'datetime',
        'actual_departure' => 'datetime',
        'actual_arrival' => 'datetime',
    ];

    protected $appends = ['formatted_flight_number'];

    public function airline(): BelongsTo
    {
        return $this->belongsTo(Airline::class, 'airline_id');
    }

    public function arrivalAirport(): BelongsTo
    {
        return $this->belongsTo(Airport::class, 'arrival_airport_id');
    }

    public function departureAirport(): BelongsTo
    {
        return $this->belongsTo(Airport::class, 'departure_airport_id');
    }

    public function bookings(): HasMany
    {
        return $this->hasMany(Booking::class, 'flight_id');
    }

    /**
     * Get the formatted flight number (Airline IATA Code + Flight ID)
     */
    public function getFlightNumberAttribute($value)
    {
        // Try to use airline code if relationship is loaded
        if ($this->relationLoaded('airline') && $this->airline && $this->airline->code) {
            return strtoupper($this->airline->code) . $this->id;
        }
        
        // Otherwise try to load it
        if (!$this->relationLoaded('airline') && $this->airline_id) {
            $airline = $this->airline;
            if ($airline && $airline->code) {
                return strtoupper($airline->code) . $this->id;
            }
        }
        
        // Fallback
        return $value ?? 'FL' . $this->id;
    }

    /**
     * Get the formatted flight number attribute
     */
    public function getFormattedFlightNumberAttribute()
    {
        return $this->flight_number;
    }
}
