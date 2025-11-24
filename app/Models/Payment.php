<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Payment extends Model
{
    use HasFactory;

    protected $table = 'payments';

    protected $fillable = [
        'amount', 'method', 'payment_date', 'status'
    ];

    public function booking(): HasOne
    {
        return $this->hasOne(Booking::class, 'payment_id');
    }
}
