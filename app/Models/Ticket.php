<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Ticket extends Model
{
    use HasFactory;

    protected $fillable = [
        'from_city_id',
        'to_city_id',
        'airline',
        'weight',
        'departure_date',
        'arrival_date',
        'duration_days',
        'duration_hours',
        'duration_minutes',
        'trip_type',
        'return_date',
        'return_arrival_date',
        'return_duration_days',
        'return_duration_hours',
        'return_duration_minutes',
        'number_of_adults',
        'number_of_children',
        'number_of_babies',
        'price',
        'description',
        'is_active'
    ];

    protected $casts = [
        'departure_date' => 'datetime',
        'arrival_date' => 'datetime',
        'return_date' => 'datetime',
        'return_arrival_date' => 'datetime',
        'price' => 'decimal:2',
        'is_active' => 'boolean',
    ];

    public function fromCity(): BelongsTo
    {
        return $this->belongsTo(City::class, 'from_city_id');
    }

    public function toCity(): BelongsTo
    {
        return $this->belongsTo(City::class, 'to_city_id');
    }

    public function getTotalPassengers()
    {
        return $this->number_of_adults + $this->number_of_children + $this->number_of_babies;
    }
}